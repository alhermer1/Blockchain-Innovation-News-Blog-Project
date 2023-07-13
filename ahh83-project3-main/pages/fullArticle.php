<?php
$title = 'fullArticle';
$nav_articles_class = 'active_page';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = exec_sql_query(
        $db,
        "SELECT
        articles.id AS 'articles.id',
            articles.company_name AS 'articles.company_name',
            articles.author AS 'articles.author',
            articles.date_a AS 'articles.date_a',
            articles.summary AS 'articles.summary',
            articles.full_text AS 'articles.full_text',
            articles.citation AS 'articles.citation'
        FROM articles
        WHERE articles.id = :id",
        array(':id' => $id)
    );
    $record = $result->fetch();

    $tags_result = exec_sql_query(
        $db,
        "SELECT tags.tag_name AS 'tags.tag_name'
        FROM arttags
        JOIN tags ON arttags.tag_id = tags.tag_id
        WHERE arttags.articles_id = :id",
        array(':id' => $id)
    );
    $tile_tags = $tags_result->fetchAll(PDO::FETCH_COLUMN, 0);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Full Article</title>
    <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">
</head>

<body>

    <?php include 'includes/header.php'; ?>
    <div class="container2">
        <div class="top2">
            <div class="imgcent">
                <img class="dimensions" src="public/uploads/clipart/<?php echo $record['articles.id'] . '.' . 'svg'; ?>"
                    alt="<?php echo htmlspecialchars($record['articles.company_name']); ?> logo">
                <br>
            </div>
            <div class="ourArticles">
                <h1>
                    <?php echo $record['articles.company_name']; ?>
                </h1>

                <p>Founded By:
                    <?php echo $record['articles.author']; ?>
                </p>
                <p>Founded On:
                    <?php echo $record['articles.date_a']; ?>
                </p>
                <p>
                    <?php echo $record['articles.full_text']; ?>
                </p>
                <br>


            </div>
            <div class="taggers2">
                <h4>Tags:</h4>
                <div class="subtaggers">
                    <?php foreach ($tile_tags as $tag) { ?>
                        <span class="tag">
                            <?php echo htmlspecialchars($tag); ?>
                        </span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>


</body>

</html>
