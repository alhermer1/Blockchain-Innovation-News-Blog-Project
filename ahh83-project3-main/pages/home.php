<?php
$title = 'Home';
$nav_home_class = 'active_page';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">
</head>

<body>

  <?php include 'includes/header.php'; ?>

  <div class="container">
    <div class="topWrap">
      <div class="mainTitle">
        <h1>The Top Blockchain New's Source</h1>
        <p>On this blog, you'll find exciting and informative posts about a range of blockchain projects, from
          decentralized finance (DeFi) to non-fungible tokens (NFTs) and beyond. I'll share my thoughts on the latest
          news, trends, and advancements in the blockchain world, and highlight some of the most promising projects that
          are making waves in the industry.</p>
      </div>

      <?php
      $result = exec_sql_query(
        $db,
        "SELECT
        articles.id AS 'articles.id',
        articles.company_name AS 'articles.company_name',
        articles.author AS 'articles.author',
        articles.date_a AS 'articles.date_a',
        articles.summary AS 'articles.summary',
        articles.citation AS 'articles.citation',
        articles.full_text AS 'articles.full_text',
        tags.tag_name AS 'tags.tag_name'
        FROM articles
        LEFT JOIN arttags ON articles.id = arttags.articles_id
        LEFT JOIN tags ON arttags.tag_id = tags.tag_id
        ORDER BY articles.id;"
      );
      $records = $result->fetchAll();
      $tiles = array();
      foreach ($records as $record) {
        $article_id = $record['articles.id'];
        $tile_title = $record['articles.company_name'];
        $tile_content = $record['articles.summary'];
        $tile_ext = 'svg';
        $tile_tag = $record['tags.tag_name'];
        $tile_citation = $record['articles.citation'];

        if (!isset($tiles[$article_id])) {
          $tiles[$article_id] = array('id' => $article_id, 'title' => $tile_title, 'content' => $tile_content, 'file_ext' => $tile_ext,  'citation' => $tile_citation, 'tags' => array());
        }

        if (!in_array($tile_tag, $tiles[$article_id]['tags'])) {
          $tiles[$article_id]['tags'][] = $tile_tag;
        }
      }
      ?>



      <div class="featcent">
        <h1>Featured Startups:</h1>
        <div class="carousel-wrapper">
          <div class="carousel">
            <?php
            $count = 0;
            foreach ($tiles as $article_id => $tile) {
              $tile_title = $tile['title'];
              $tile_content = $tile['content'];
              $tile_tags = $tile['tags'];
              $show_link = false;
              $tile_citation = $tile['citation'];
              include 'includes/tile.php';
              $count++;
            }
            ?>
          </div>
        </div>
        <br>
        <div class="buttonsYo">
          <button id="prevBtn" class="carousel-control">Prev</button>
          <button id="nextBtn" class="carousel-control">Next</button>
        </div>

        <br>
        <a class="relink" href="/articles">Read More</a>
        <br>
        <a class="startCitation" href="https://startupsavant.com/startups-to-watch/blockchain">All startups and descriptions
          taken from startupsavant.com</a>
      </div>

      <script>
        const carousel = document.querySelector(".carousel");
        const prevBtn = document.querySelector("#prevBtn");
        const nextBtn = document.querySelector("#nextBtn");

        let currentIndex = 0;
        const tiles = document.querySelectorAll(".tile");

        function updateCarousel() {
          const transformValue = -currentIndex * 100;
          carousel.style.transform = `translateX(${transformValue}%)`;
        }

        prevBtn.addEventListener("click", () => {
          currentIndex--;
          if (currentIndex < 0) {
            currentIndex = tiles.length - 1;
          }
          updateCarousel();
        });

        nextBtn.addEventListener("click", () => {
          currentIndex++;
          if (currentIndex >= tiles.length) {
            currentIndex = 0;
          }
          updateCarousel();
        });
      </script>




</body>
