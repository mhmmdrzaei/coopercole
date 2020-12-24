<?php //template name: News ?>
<?php get_header();  ?>

<main>

      <section class="news">
    
        <?php $args = array( 'post_type' => 'post', 'order' => 'DCS', 'posts_per_page' => 25 );
          query_posts( $args ); // hijack the main loop
          while ( have_posts() ) : the_post();
            ?>
      <article class="post">

        <?php $post_id = get_the_id(); ?>

        <?php if(has_post_thumbnail()): ?>
          <figure>
            <?php the_post_thumbnail( 'large' ); ?>
          </figure>
        <?php endif; ?>

        <section class="newsTitle">
          <a href="<?php the_permalink(); ?>"><h1 class="title"><?php the_title(); ?></h1></a>          
          <aside class="date"><?php the_time('F j, Y'); ?></aside>
         </section>
         <section class="video wrap-video">
           <?php if( have_rows('related_featured_video') ): ?>
               <?php while( have_rows('related_featured_video') ): the_row(); 
                ?>;
                <?php the_sub_field('video_link'); ?>
               <?php endwhile; ?>
           <?php endif; ?>         </section>
        <section class="newsExcerpt">
          <?php the_excerpt(); ?>
        </section>
        <section class="NewsTags">
            <?php coopercole_tags(); ?>
        </section>
          

        </div>

      </article>
           <?php
          endwhile;
          ?>
          <?php
          wp_reset_query();
          ?> 

    </section>

  

</main>

<?php get_footer(); ?>