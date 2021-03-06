<?php //template name: News ?>
<?php get_header();  ?>

<main>

      <section class="news">
    
        <?php $args = array( 'post_type' => 'post', 'order' => 'DCS', 'posts_per_page' => 100 );
          query_posts( $args ); // hijack the main loop
          while ( have_posts() ) : the_post();
            ?>
  <article class="post"> 

        <?php  
          $videoLink = get_field('video_link_newsPage');
          $featuredImage = get_the_post_thumbnail();
          if( $videoLink ) {; ?>
<!--         <section class="newsTitle">
            <a href="<?php the_permalink(); ?>"><h1 class="title"><?php the_title(); ?></h1></a>          
            <aside class="date"><?php the_time('F j, Y'); ?></aside>
          </section>   -->
          <section class="featuredVideo">
            <div class="video-responsive">  
              <?php the_field('video_link_newsPage') ?>
            </div>
            </section>
         <?php } else if ( $featuredImage ) {; ?> 
          <section class="newsMainBody">
            <figure class="newsPostImage">
              <?php the_post_thumbnail('large'); ?>
            </figure>
            
          <?php }; ?>
         <?php 
          if ( (has_post_thumbnail()) && ($videoLink) ) {; ?>
            <section class="newsDetails">
              <section class="newsExcerpt">
                <?php the_excerpt(); ?>
              </section>
                  <?php coopercole_tags(); ?>
            </section>
         <?php } else if (has_post_thumbnail()) {; ?> 
            <section class="newsDetails withFI">
              <section class="newsTitle withFITitle">
                <a href="<?php the_permalink(); ?>"><h1 class="title"><?php the_title(); ?></h1></a>          
                <aside class="date"><?php the_time('F j, Y'); ?></aside>
              </section>  
              <section class="newsExcerpt">
                <?php the_excerpt(); ?>
              </section>
                  <?php coopercole_tags(); ?>
            </section>
          </section>
         <?php } else { ?>
          <section class="newsTitle">
            <a href="<?php the_permalink(); ?>"><h1 class="title"><?php the_title(); ?></h1></a>          
            <aside class="date"><?php the_time('F j, Y'); ?></aside>
          </section>  
            <section class="newsDetails">
              <section class="newsExcerpt">
                <?php the_excerpt(); ?>
              </section>

                  <?php coopercole_tags(); ?>

            </section>
        <?php }; ?>

    </article>
           <?php
          endwhile;
          ?>
          <?php
          wp_reset_query();
          ?> 

   

  

</main>

<?php get_footer(); ?>