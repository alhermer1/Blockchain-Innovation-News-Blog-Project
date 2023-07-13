<div class="tile">
  <div class="imgcent">
    <img class="dimensions" src="/public/uploads/clipart/<?php echo $article_id; ?>.svg"
      alt="<?php echo htmlspecialchars($tile_title); ?> logo">
    <a class = "from" href="<?php echo ($tile_citation); ?> "> <?php echo htmlspecialchars($tile_title); ?> Logo Found From Here</a>
  </div>

  <!-- Title -->
  <h1>
    <?php echo $tile_title; ?>
  </h1>

  <?php if ($show_link) { ?>
    <!-- Founder -->
    <p>
      Founder:
      <?php echo $tile_author; ?>
    </p>

    <!-- Date Founded -->
    <p>
      Date Founded:
      <?php echo $tile_date_a; ?>
    </p>
  <?php } ?>

  <p>
    <?php echo $tile_content; ?>
  </p>
  <?php if ($show_link) { ?>
    <a class = "learnMore" href="/fullArticle?id=<?php echo $article_id; ?>"> Learn More </a>
    <br>
    <br>
    <div class="taggers">
      <?php foreach ($tile_tags as $tag) { ?>
        <span class="tag">
          <?php echo htmlspecialchars($tag); ?>
        </span>
      <?php } ?>
    </div>
  <?php } ?>

</div>
