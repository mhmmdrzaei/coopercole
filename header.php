<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php // Load Meta ?>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php  wp_title('|', true, 'right'); ?></title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!-- stylesheets should be enqueued in functions.php -->
  <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

<header>

  

  <!-- <?php require 'partials/logoTwo.php'; ?> -->
  <!-- <?php require 'partials/logoThree.php'; ?> -->
   <!-- <?php require 'partials/logoFour.php'; ?> -->
  <main>
    <h3 class="Menu">Menu</h3>
    <nav class="primaryMenu">
          <?php wp_nav_menu( array(
      'container' => false,
      'theme_location' => 'primary_menu'
    )); ?>
    </nav>
    <section class="logo">
       <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name', 'display' ); ?>" rel="home">
        <?php require 'partials/logo.php'; ?>
      </a>
     
    </section>
    <nav class="languages">
                <?php wp_nav_menu( array(
      'container' => false,
      'theme_location' => 'languages_menu'
    )); ?>
    </nav>
    <section class="search">
      <?php get_search_form(); ?>
    </section>

  </main> <!-- /.container -->
</header><!--/.header-->

