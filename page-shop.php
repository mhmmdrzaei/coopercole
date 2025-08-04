<?php get_header();  ?>

<div class="main pageShop">
  <div class="container">
    		<h1 class="shopTitle"><?php the_title(); ?></h1>


    <div class="content">
      <?php // Start the loop ?>
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>

      <?php endwhile; // end the loop?>
    </div> <!-- /,content -->


  </div> <!-- /.container -->
</div> <!-- /.main -->

<?php get_footer(); ?>