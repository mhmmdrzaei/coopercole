<?php get_header(); ?>
<main>
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <section class="newsNavigation">

    <p class="nav-previous"><?php previous_post_link('%link', 'Previous News'); ?></p>
    <p class="nav-next"><?php next_post_link('%link', 'Next News'); ?></p>
  </section>
  <section class="newsBody">
  <section class="newsSide">
    <h2><?php the_title(); ?></h2>
    <h4><?php the_time('F j, Y'); ?></h4>
    <section class="NewsTags">
      <?php coopercole_inner_tags(); ?>
    </section>
    <nav class="exhibtionNews">
        <?php $postTitle = get_the_title(); 

        ?>

      <?php

      $connected = new WP_Query( array(
        'connected_type' => 'post_to_artist',
        'connected_items' => get_the_id(),
        'nopaging' => true
      ) );

      if($connected->have_posts()):

      ?>
      <?php while($connected->have_posts()) : $connected->the_post(); ?>
        <?php

        $connectedTwo = new WP_Query( array(
          'connected_type' => 'post_to_artist',
          'connected_items' => get_the_id(),
          'post_not_in'=> $postTitle,
          'nopaging' => true,
          // 'posts_per_page'=> 10
        ) );

        if($connectedTwo->have_posts()):

        ?>
        <button class="newsOpen">Related News</button>
        <div id="newsContentID">
        <ul class="newsContent">

          <?php while($connectedTwo->have_posts()) : $connectedTwo->the_post(); 
           
            $title = get_the_title();
            
            ?>
            <?php 
            if ($postTitle != $title)
            { ?>

            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php } ?>  
             


          <?php endwhile; ?>
        </ul>
        <?php wp_reset_postdata(); endif; ?>
        </div>

    </nav>
   <?php endwhile; ?>
  <?php wp_reset_postdata(); endif; ?>
  </section>
  <section class="newsMain">

    <?php if( have_rows('related_featured_video') ): ?>
    <?php while( have_rows('related_featured_video') ): the_row(); 
      $videoLink = get_sub_field('video_link');
      if( $videoLink ) {; ?>
      <section class="featuredVideo">
        <div class="video-responsive">  
          <?php echo $videoLink; ?>
        </div>
      </section>
      <?php } ?> 
    <?php endwhile; ?>
     <?php endif; ?> 

    <aside class="newsContentMain">
       <?php the_content(); ?>
    </aside>
    <?php if(has_post_thumbnail()): ?>
      <figure>
        <?php the_post_thumbnail( 'large' ); ?>
      </figure>
    <?php endif; ?>

  </section>
  </section>
</main>

 <?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>