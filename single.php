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
      <button class="newsOpen">Related News</button>
      <div id="newsContentID">
      <ul class="newsContent">
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
          <?php while($connectedTwo->have_posts()) : $connectedTwo->the_post(); 
           
            $title = get_the_title();
            
            ?>
            <?php 
            if ($postTitle != $title)
            { ?>

            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php } ?>  
             


          <?php endwhile; ?>
        
        <?php wp_reset_postdata(); endif; ?>
        

   
   <?php endwhile; ?>
  <?php wp_reset_postdata(); endif; ?>
  <div class="moreNewsOpen">
    
  </div>
  </ul>
  </div>
   </nav>
  </section>
  <section class="newsMain">

    <?php 
      $videoLink = get_field('video_link_newsPage');
      if( $videoLink ) {; ?>
      <section class="featuredVideo">
        <div class="video-responsive">  
          <?php echo $videoLink; ?>
        </div>
      </section>
      <?php } ?> 
  

    <aside class="newsContentMain">
      <?php if( have_rows('additional_video_and_links') ): ?>
          <?php while( have_rows('additional_video_and_links') ): the_row(); ?>
              <?php if( get_row_layout() == 'add_video_additional' ): ?>
                <?php if( have_rows('video_additionalMediaContent') ): ?>
                <?php while( have_rows('video_additionalMediaContent') ): the_row(); 
                  $videoLink = get_sub_field('video_link_additionalMedia');
                  if( $videoLink ) {; ?>
                  <section class="featuredVideo">
                  <button class="featuredVideoTitle"><img src="<?php bloginfo('template_directory'); ?>/images/movie_icon.svg"> <?php the_sub_field('video_label_additionalMedia') ?></button> 
                  <div id="featuredVideoLink" class="video-responsive">
                    <?php the_sub_field('video_link_additionalMedia'); ?>
                  </div>
                  </section>
                  <?php } ?> 
                <?php endwhile; ?>
                 <?php endif; ?>   
              <?php elseif( get_row_layout() == 'add_link_additional' ): ?>
                  <?php if( have_rows('outwardLink_additionalMediaContent') ): ?>
                  <?php while( have_rows('outwardLink_additionalMediaContent') ): the_row(); 
                    $onlineLink = get_sub_field('link_label_additionalMedia');
                    if( $onlineLink ) {; ?>
                    <section class="onlineExhibition">
                      <a href="<?php the_sub_field('actual_link_additionalMedia'); ?>"><?php the_sub_field('link_label_additionalMedia'); ?> <i class="fas fa-external-link-alt"></i></a>
                    </section>
                    <?php } ?> 
                  <?php endwhile; ?>
                   <?php endif; ?>  

              <?php endif; ?>
          <?php endwhile; ?>
      <?php endif; ?>
       <?php the_content(); ?>
    </aside>
<!--     <?php if(has_post_thumbnail()): ?>
      <figure>
        <?php the_post_thumbnail( 'large' ); ?>
      </figure>
    <?php endif; ?> -->

  </section>
  </section>
</main>

 <?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>