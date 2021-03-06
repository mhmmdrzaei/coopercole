<?php get_header(); ?>

<div class="main">
  <div class="container">
    <div class="content">


      <?php   $args = array (
              'post_type' => 'exhibition',
              'meta_key'      => 'start_date',
              // 'orderby'      => 'meta_value',
              'orderby'    => array(
                    'start_date' => 'DSC',
                    'post_date' => 'desc'
                  ),
              'order'       => 'DESC'
            );


       ?>



       ?>

      <h1>
        <?php if ( is_day() ) : ?>
          Daily Archives: <?php the_date(); ?>
        <?php elseif ( is_month() ) : ?>
          Monthly Archives: <?php the_date('F Y'); ?>
        <?php elseif ( is_year() ) : ?>
          Yearly Archives: <?php the_date('Y'); ?>
        <?php else : ?>
          Blog Archives
        <?php endif; ?>
      </h1>
 <?php 
        $exhibitions = new Wp_Query( $args );

        if($exhibitions->have_posts()) : while($exhibitions->have_posts()) : $exhibitions->the_post();

          ?>
      <?php
    	/* Since we called the_post() above, we need to
    	 * rewind the loop back to the beginning that way
    	 * we can run the loop properly, in full.
    	 */
    	rewind_posts();

    	/* Run the loop for the archives page to output the posts.
    	 * If you want to overload this in a child theme then include a file
    	 * called loop-archives.php and that will be used instead.
    	 */
      get_template_part( 'partials/repeater-exhibition', 'archive' );
      ?>

       <?php endwhile; wp_reset_postdata(); ?>

<?php endif; ?>

    </div><!--/content-->


  </div> <!-- /.container -->
</div> <!-- /.main -->

<?php get_footer(); ?>