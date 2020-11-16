<?php get_header(); ?>

<div class="main">
  <div class="container">
  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <div class="page-header container">
    <strong><?php the_title(); ?></strong><br/>

              <?php
          $connected_artists = new WP_Query( array(
            'connected_type' => 'exhibition_to_artist',
            'connected_items' => get_the_id(),
            'nopaging' => true
          ) );

          foreach($connected_artists->posts as $p) {
            $lastname = explode(' ', $p->post_title);
            if(sizeof($lastname) == 1) {
              $p->lastname = $lastname[0];
            }
            if(sizeof($lastname) == 2) {
              $p->lastname = $lastname[1];
            }
            if(sizeof($lastname) == 3) {
              $p->lastname = $lastname[2];
            }
          }

          usort($connected_artists->posts, 'cmp');

          echo '<ul class="exhibitors">';

          if($connected_artists->have_posts()): while($connected_artists->have_posts()) : $connected_artists->the_post(); ?>

            <li><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></li>

          <?php
          endwhile; wp_reset_postdata(); endif;

          echo '</ul>';

          ?>

          

          <?php
          $start_date = get_field('start_date', false, false);
          $start_date = new DateTime($start_date);

          if( get_field('end_date') ) {
            $end_date = get_field('end_date', false, false);
            $end_date = new DateTime($end_date);
          }
          ?>

          <strong><?php echo $start_date->format('F j'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></strong>

                  <?php

        $connected = new WP_Query( array(
          'connected_type' => 'post_to_exhibition',
          'connected_items' => get_the_id(),
          'posts_per_page' => -1
        ) );

        if($connected->have_posts()):

        ?>

        <h6>News</h6>

        <ul>
          <?php while($connected->have_posts()) : $connected->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; ?>
        </ul>

        <hr>

        <?php wp_reset_postdata(); endif; ?>
   <section class="exhibitionContent">
     <?php the_content(); ?>
   </section>
  <?php if(get_field('carousel')): ?>
   <section class="exhibitionImages">
      <?php
        $slides = get_field('carousel');
        $slide_amount = count($slides);
        foreach($slides as $slide):

        ?>

        <img src="<?php echo $slide['sizes']['large']; ?>" alt="" id="<?php echo $slide['id'];?>"/>

        <?php endforeach; ?>
   </section>

    <?php endif; ?>

  <h3>featured Art</h3>

    <?php

    $connected = new WP_Query( array(
      'connected_type' => 'art_to_exhibition',
      'connected_items' => get_the_id(),
      'nopaging' => true,
    ) );

    if ( $connected->have_posts() ) :

      echo '<section class="container"><div class="masonry js-featured-works featured-works">';

      while($connected->have_posts() ) : $connected->the_post(); ?>

        <div class="masonry-item">
          <a href="<?php the_permalink(); ?>" class="no-smoothState" data-id="<?php echo get_the_id(); ?>">
            <?php the_title ();?>
            <?php echo get_the_post_thumbnail( get_the_id(), 'large' ); ?>
          </a>
        </div>

      <?php

      endwhile;

      wp_reset_postdata();

      echo '</div></section>';

    endif; ?>

  <?php
$featured_posts = get_field('connected_art_1');
if( $featured_posts ): ?>
    <ul>
    <?php foreach( $featured_posts as $post ): 

        // Setup this post for WP functions (variable must be named $post).
        setup_postdata($post); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php the_post_thumbnail(); ?>
            <span>A custom field from this post: <?php the_field( 'field_name' ); ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?>


  <?php endwhile; endif; ?>



  </div> <!-- /.container -->
</div> <!-- /.main -->

<?php get_footer(); ?>