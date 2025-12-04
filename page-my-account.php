<?php get_header();  ?>

<div class="main pageShop">
  <div class="container">
    <section class="pageTop">
          		<h1 class="shopTitle"><?php the_title(); ?></h1>
              <div class="controls">
              <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">Cart ( <?php echo WC()->cart->get_cart_contents_count() ?> Items) </a>

              </div>

    </section>



    <div class="content">
      <?php // Start the loop ?>
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>

      <?php endwhile; // end the loop?>
    </div> <!-- /,content -->


  </div> <!-- /.container -->
</div> <!-- /.main -->

<?php get_footer(); ?>