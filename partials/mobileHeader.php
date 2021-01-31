<main class="headerMobileMain">
  <section class="mobileMenu">
    <div class="menu-wrapper">
      <div class="hamburger-menu"></div>    
    </div>
        <div class="dropdown">
    <nav class="language">
       <button onclick="myFunction()" class="dropbtn">lang ▼</button>
                <?php wp_nav_menu( array(
      'container' => false,
      'theme_location' => 'languages_menu'
    )); ?>
    </nav>
    <?php wp_nav_menu( array(
      'container' => false,
      'theme_location' => 'mobile_menu'
    )); ?>
    <button class="mailing-list-open" alt="Opens Mailing List Subscription form">Mailing List</button>

    <section class="search">
      <?php get_search_form(); ?>
    </section>
  </div>
  </section>
  <?php require 'partials/logoTwo.php'; ?> 
  <?php require 'partials/logo.php'; ?>

</main> 