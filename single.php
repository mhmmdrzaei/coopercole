<?php get_header(); ?>
<main>
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <section class="newsSide">
    <h1><?php the_title(); ?></h1>
    <h2><?php the_time('F j, Y'); ?></h2>
    <aside class="NewsTags">
            <?php coopercole_tags(); ?>
    </aside>
  </section>
  <section class="newsMain">
    <aside class="newsMainNav">
       <p class="nav-previous"><?php previous_post_link('%link', '&larr; %title'); ?></p>
        <p class="nav-next"><?php next_post_link('%link', '%title &rarr;'); ?></p>
    </aside>
    <aside class="video wrap-video">
      <?php the_field('video_link_news'); ?>
    </aside>
    <aside class="newsContentMain">
       <?php the_content(); ?>
    </aside>
    <?php if(has_post_thumbnail()): ?>
      <figure>
        <?php the_post_thumbnail( 'large' ); ?>
      </figure>
    <?php endif; ?>

  </section>
</main>

 <?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>