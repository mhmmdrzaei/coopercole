
<?php //template name: Artists ?>

<?php get_header();
$page_id = get_queried_object_id();
$page_bg = has_post_thumbnail($page_id)
    ? get_the_post_thumbnail_url($page_id, 'full')
    : '';
?>

	<?php $artist_type = get_query_var( 'artist_type' ); ?>

	<?php if(!$artist_type) $artist_type = 'represented'; ?>

	<?php $artist_types = get_terms( 'artist_type', array('hide_empty' => true) ); ?>

<div class="artist-bg"
  <?php if ($page_bg): ?>
    style="background-image: url('<?php echo esc_url($page_bg); ?>');"
  <?php endif; ?>
></div>





<main class="artistsMainPage">
  <section class="artists">
    <ul class="artistsNames">
    <?php
      // your existing args + query
      $artist_type = get_query_var('artist_type', 'represented');
      $args = [
        'post_type'      => 'artist',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'asc',
        'artist_type'    => $artist_type,
      ];
      $artists = new WP_Query($args);

      // your lastname logic & sorting
      foreach ($artists->posts as $p) {
        $parts = explode(' ', $p->post_title);
        $count = count($parts);
        if      ($count === 1) $p->lastname = $parts[0];
        elseif  ($count === 2) $p->lastname = $parts[1];
        elseif  ($count === 3) $p->lastname = $parts[2];
        elseif  ($count === 4 || $count === 5) $p->lastname = $parts[1];
      }
      usort($artists->posts, 'cmp');

      if ($artists->have_posts()):
        while ($artists->have_posts()): $artists->the_post();
          // grab each artist’s featured image URL
          $artist_bg = has_post_thumbnail(get_the_ID())
            ? get_the_post_thumbnail_url(get_the_ID(),'full')
            : '';
    ?>
      <li>
        <a class="rainbow artist-link"
           href="<?php the_permalink(); ?>"
           <?php if ($artist_bg): ?>
             data-bg="<?php echo esc_url($artist_bg); ?>"
           <?php endif; ?>
        >
          <?php the_title(); ?> <span style="color: white">.</span>
        </a>
      </li>
    <?php
        endwhile;
        wp_reset_postdata();
      endif;
    ?>
    </ul>
  </section>
</main>
	  
<?php get_footer(); ?>