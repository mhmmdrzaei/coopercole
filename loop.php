<?php // If there are no posts to display, such as an empty archive page ?>

<?php if ( ! have_posts() ) : ?>

	<article id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Not Found</h1>
		<section class="entry-content">
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		</section><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; // end if there are no posts ?>

<?php // if there are posts, Start the Loop. ?>

<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php $post_type = get_post_type( $post->ID ); 
			if ($post_type == 'art-fair') echo '<h2>Art Fair > </h2>';
			if ($post_type == 'art') echo '<h2>Artwork > </h2>';
			if ($post_type == 'exhibition') echo '<h2>Exhibition > </h2>';
			if ($post_type == 'artist') echo '<h2>Artist > </h2>';
			if ($post_type == 'post') echo '<h2>News > </h2>';
			 ?>

			<h3 class="entry-title">
        	<a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
         		 <?php the_title(); ?>
        	</a>
      		</h3>


		</article>



<?php endwhile; // End the loop. Whew. ?>

