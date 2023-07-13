<?php
$title = 'contribute';
$nav_articles_class = 'active_page';


$form_values = array(
    'sname' => '',
    'author' => '',
    'date' => '',
    'summarizedBlog' => '',
    'fullBlog' => '',
    'source' => ''
);


define("MAX_FILE_SIZE", 1000000);

$upload_feedback = array(
    'general_error' => False,
    'too_large' => False
);

$upload_source = NULL;
$upload_file_name = NULL;
$upload_file_ext = NULL;



if (isset($_POST['submit-blog'])) {

    $form_values['sname'] = trim($_POST['sname']);
    $form_values['author'] = trim($_POST['author']);
    $form_values['date'] = trim($_POST['date']);
    $form_values['summarizedBlog'] = trim($_POST['summarizedBlog']);
    $form_values['fullBlog'] = trim($_POST['fullBlog']);
    $form_values['source'] = trim($_POST['source']);

    $upload_source = trim($_POST['source']);
    if (empty($upload_source)) {
        $upload_source = NULL;
    }

    $upload = $_FILES['svg-file'];

    $form_valid = True;


    if ($upload['error'] == UPLOAD_ERR_OK) {
        $upload_file_name = basename($upload['name']);
        $upload_file_ext = strtolower(pathinfo($upload_file_name, PATHINFO_EXTENSION));
        if (!in_array($upload_file_ext, array('svg'))) {
            $form_valid = False;
            $upload_feedback['general_error'] = True;
        }
    } else if (($upload['error'] == UPLOAD_ERR_INI_SIZE) || ($upload['error'] == UPLOAD_ERR_FORM_SIZE)) {
        $form_valid = False;
        $upload_feedback['too_large'] = True;
    } else {
        $form_valid = False;
        $upload_feedback['general_error'] = True;
    }

    if ($form_valid) {
        $result = exec_sql_query(
            $db,
            "INSERT INTO articles (company_name, author, date_a, summary, full_text, citation) VALUES (:company_name, :author, :date_a, :summary, :full_text, :citation);",
            array(
                ':company_name' => $form_values['sname'],
                ':author' => $form_values['author'],
                ':date_a' => $form_values['date'],
                ':summary' => $form_values['summarizedBlog'],
                ':full_text' => $form_values['fullBlog'],
                ':citation' => $form_values['source']
            )
        );

        $inserted_article_id = $db->lastInsertId();

        $upload_storage_file = $inserted_article_id . '.' . 'svg';
        $upload_storage_path = 'public/uploads/clipart/' . $upload_storage_file;

        if (move_uploaded_file($upload["tmp_name"], $upload_storage_path) == False) {
            error_log("Failed to permanently store the uploaded file on the file server. Please check that the server folder exists.");
        } else {
            $result = exec_sql_query(
                $db,
                "UPDATE articles SET temp_file_path = :temp_file_path WHERE id = :id;",
                array(
                    ':temp_file_path' => $upload_storage_file,
                    ':id' => $inserted_article_id
                )
            );
        }


        if (isset($_POST['tags'])) {
            foreach ($_POST['tags'] as $tag_id) {
                $result_arttags = exec_sql_query(
                    $db,
                    "INSERT INTO arttags (articles_id, tag_id) VALUES (:articles_id, :tag_id);",
                    array(
                        ':articles_id' => $inserted_article_id,
                        ':tag_id' => $tag_id,
                    )
                );
            }
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Contribution Page</title>
    <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <?php
    if (isset($_POST['submit-blog']) && $form_valid) {
        ?>
        <div class="submission-message">
            <p>Your message has been submitted!</p>
            <a href="/articles" class="view-submission-btn">View Your Submission</a>
        </div>
        <?php
    }
    ?>

    <?php if (!is_user_logged_in()) { ?>
        <div class="centralizeLogin">
            <h2>Contributors Please Sign In</h2>
            <?php echo login_form('/contribute', $session_messages); ?>
        </div>
    <?php } else { ?>
        <div class="logBack">
            <form method="post" class="logBacker" action="/contribute" enctype="multipart/form-data" novalidate>
                <h2>Please Input The Content For Your Blog Post</h2>
                <div class="stack">

                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>">
                    <br>

                    <?php if ($upload_feedback['too_large']) { ?>
                        <p class="feedback">We're sorry. The file failed to upload because it was too big. Please select a file
                            that&apos;s no larger than 1MB.</p>
                    <?php } ?>

                    <?php if ($upload_feedback['general_error']) { ?>
                        <p class="feedback">We're sorry. Something went wrong. Please select an SVG file to upload.</p>
                    <?php } ?>

                    <div class="label-input">
                        <label for="upload-file">SVG File:</label>
                        <input class="finput" id="upload-file" type="file" name="svg-file" accept=".svg,image/svg+xml">
                    </div>

                    <div class="label-input">
                        <label for="upload-source" class="optional">Source URL:</label>
                        <input class="finput" id='upload-source' type="url" name="source"
                            placeholder="URL where found. (optional)">
                    </div>



                    <label for="insert-sname">Startup Name:</label>
                    <input class="finput" type="text" name="sname" id="insert-sname">

                    <label for="insert-author">Founder Name:</label>
                    <input class="finput" type="text" name="author" id="insert-author">

                    <label for="insert-date">Date Founded:</label>
                    <input class="finput" type="text" name="date" id="insert-date">

                    <label for="insert-summarizedBlog">Summarized Version Of Post:</label>
                    <textarea class="finput" name="summarizedBlog" id="insert-summarizedBlog"></textarea>

                    <label for="insert-fullBlog">Entire Blog Post:</label>
                    <textarea class="finput" name="fullBlog" id="insert-fullBlog"></textarea>

                    <label>Tags (check all that apply):</label>
                    <div class="tagsform" id="insert-tags">

                        <?php

                        $tag_result = exec_sql_query($db, "SELECT * FROM tags;");
                        $tags = $tag_result->fetchAll();

                        foreach ($tags as $tag): ?>
                            <input type="checkbox" name="tags[]" id="tag_<?= htmlspecialchars($tag['tag_id']) ?>"
                                value="<?= htmlspecialchars($tag['tag_id']) ?>">
                            <label for="tag_<?= htmlspecialchars($tag['tag_id']) ?>"><?= htmlspecialchars($tag['tag_name']) ?></label>
                            <br>
                        <?php endforeach; ?>

                    </div>



                </div>
                <br>

                <div class="align-right">
                    <input type="submit" value="submit-blog" name="submit-blog">
                </div>

            </form>
        </div>
    <?php } ?>




</body>

</html>
