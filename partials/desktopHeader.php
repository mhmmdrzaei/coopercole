  <main class="headerMain">
    <input type="checkbox" id="menu__check">
    <div class="menu__hero">
      <nav class="menu__nav">
        <label class="menu__icon" for="menu__check">
         <h3 class="Menu">Close</h3>
        </label>
            <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'primary_menu'
      )); ?>
      </nav>
      
    </div>
    <label id="topMenu" class="menu__icon headerMainMenu" for="menu__check">
      <section class="ccLogo">
        <!-- <?php require 'partials/logoTwo.php'; ?>  -->
      </section>
     <h3 class="menuMain">Menu</h3>
    </label>

    <section class="logo">
       <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name', 'display' ); ?>" rel="home">
       <!--  <?php require 'partials/logo.php'; ?> -->
      </a>
     
    </section>
    <nav class="language">
       <button onclick="myFunction()" class="dropbtn">lang ▼</button>
                <?php wp_nav_menu( array(
      'container' => false,
      'theme_location' => 'languages_menu'
    )); ?>
    </nav>
    <section class="search">
      <?php get_search_form(); ?>
    </section>

  </main>