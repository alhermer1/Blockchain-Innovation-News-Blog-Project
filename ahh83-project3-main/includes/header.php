<header>

    <div class="straighter">
        <h1 class="mtitle"> BlockSource</h1>
        <nav class="menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/articles">Articles</a></li>
                <li><a href="/contribute">Contribute</a></li>
                <li><a href="/aboutUs">About Us</a></li>

                <?php if (is_user_logged_in()) { ?>
                    <li class="float-right"><a href="<?php echo logout_url(); ?>">Sign Out</a></li>
                <?php } ?>


            </ul>
        </nav>
    </div>

</header>
