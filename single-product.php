<?php get_header(); ?>
<main>
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section class=" productContainer">
    <h2 class="productTitle"><?php the_title(); ?></h2>
    <?php 
      $videoLink = get_field('video_link_newsPage');
      if( $videoLink ) {; ?>
      <section class="featuredVideo">
        <div class="video-responsive">  
          <?php echo $videoLink; ?>
        </div>
      </section>
      <?php } ?> 
  

       <?php the_content(); ?>
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
<!--     <?php if(has_post_thumbnail()): ?>
      <figure>
        <?php the_post_thumbnail( 'large' ); ?>
      </figure>
    <?php endif; ?> -->


  </section>
</main>

 <?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>