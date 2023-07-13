<?php
$title = 'articles';
$nav_home_class = 'active_page';

$selected_tags = isset($_GET['tag']) ? (is_array($_GET['tag']) ? $_GET['tag'] : array($_GET['tag'])) : array();


$query = "SELECT
            articles.id AS 'articles.id',
            articles.company_name AS 'articles.company_name',
            articles.author AS 'articles.author',
            articles.date_a AS 'articles.date_a',
            articles.summary AS 'articles.summary',
            articles.full_text AS 'articles.full_text',
            articles.citation AS 'articles.citation',
            tags.tag_name AS 'tags.tag_name'
        FROM articles
        LEFT JOIN arttags ON articles.id = arttags.articles_id
        LEFT JOIN tags ON arttags.tag_id = tags.tag_id";

if (!empty($selected_tags)) {
    $placeholders = implode(',', array_fill(0, count($selected_tags), '?'));
    $query .= " WHERE tags.tag_id IN ($placeholders)";
}

$query .= " ORDER BY articles.id";

$result = exec_sql_query($db, $query, $selected_tags);
$records3 = $result->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>About Us</title>
    <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <div class="container2">
        <div class="top2">
            <div class="ourArticles">
                <h1>Our Articles</h1>
                <p>Whether you're an experienced blockchain enthusiast or just starting to explore this fascinating
                    world, my blog is the perfect place to learn and stay informed. So, if you're as passionate about
                    blockchain as I am, join me on this exciting journey!</p>

            </div>

            <div class="ourArticles2">
                <div class="searchW">
                    <?php
                    $query_params = array();
                    if (!empty($selected_tags)) {
                        foreach ($selected_tags as $tag) {
                            $query_params[] = array('tag' => $tag);
                        }
                    }
                    $query_string = '';
                    foreach ($query_params as $param) {
                        $query_string .= (!empty($query_string) ? '&' : '') . http_build_query($param, '', '&', PHP_QUERY_RFC3986);
                    }
                    $action_url = "/articles" . (!empty($query_string) ? "/?" . $query_string : "");
                    ?>

                    <form method="GET" action="<?php echo htmlspecialchars($action_url); ?>">
                        <section>
                            <h3>Choose Tags:</h3>

                            <?php
                            $tags_query = "SELECT tags.tag_id, tags.tag_name FROM tags ORDER BY tags.tag_name";
                            $tags_result = exec_sql_query($db, $tags_query);

                            $all_tags = array();
                            while ($row = $tags_result->fetch()) {
                                $all_tags[] = array("id" => $row['tag_id'], "name" => $row['tag_name']);
                            }

                            foreach ($all_tags as $tag) {
                                $checked = in_array($tag["name"], $selected_tags) ? 'checked' : '';
                                echo "<label><input type='checkbox' name='tag_id' value='{$tag['id']}' $checked> {$tag['name']}</label>";
                            }
                            ?>
                        </section>
                        <button class="filterS" type="submit">Filter</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="bottom2">
            <?php
            $result = exec_sql_query(
                $db,
                "SELECT
        articles.id AS 'articles.id',
        articles.company_name AS 'articles.company_name',
        articles.author AS 'articles.author',
        articles.date_a AS 'articles.date_a',
        articles.summary AS 'articles.summary',
        articles.full_text AS 'articles.full_text',
        articles.citation AS 'articles.citation',
        tags.tag_name AS 'tags.tag_name'
        FROM articles
        LEFT JOIN arttags ON articles.id = arttags.articles_id
        LEFT JOIN tags ON arttags.tag_id = tags.tag_id
        ORDER BY articles.id;"
            );
            $records = $records3;

            $tiles = array();
            foreach ($records as $record) {
                $article_id = $record['articles.id'];
                $tile_title = $record['articles.company_name'];
                $tile_author = $record['articles.author'];
                $tile_date_a = $record['articles.date_a'];
                $tile_content = $record['articles.summary'];
                $tile_tag = $record['tags.tag_name'];
                $tile_citation = $record['articles.citation'];

                if (!isset($tiles[$article_id])) {
                    $tiles[$article_id] = array('title' => $tile_title, 'author' => $tile_author, 'date_a' => $tile_date_a, 'content' => $tile_content, 'citation' => $tile_citation, 'tags' => array());
                }

                if (!in_array($tile_tag, $tiles[$article_id]['tags'])) {
                    $tiles[$article_id]['tags'][] = $tile_tag;
                }
            }

            ?>

            <div class="columnsOrg">
                <?php foreach ($tiles as $article_id => $tile) { ?>
                    <?php
                    $tile_title = $tile['title'];
                    $tile_author = $tile['author'];
                    $tile_date_a = $tile['date_a'];
                    $tile_content = $tile['content'];
                    $tile_tags = $tile['tags'];
                    $tile_citation = $tile['citation'];
                    $show_link = true;
                    include 'includes/tile.php'; ?>
                <?php } ?>
            </div>

            <a class="" href="https://startupsavant.com/startups-to-watch/blockchain">All startups and descriptions
                taken from startupsavant.com</a>

        </div>
    </div>


</body>
