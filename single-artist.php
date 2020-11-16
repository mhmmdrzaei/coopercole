<?php get_header(); ?>
	
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<div class="container">

		<h1><?php the_title(); ?></h1>

		<?php the_post_thumbnail('large'); ?>

		<?php the_content(); ?>


	<section class="artistInformationNews">

		<?php

		$connected = new WP_Query( array(
		  'connected_type' => 'post_to_artist',
		  'connected_items' => get_the_id(),
		  'posts_per_page' => 6
		) );

		if($connected->have_posts()):

		?>

		<h6>News</h6>

		<ul>
			<?php while($connected->have_posts()) : $connected->the_post(); ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
		
	</section>
	<?php wp_reset_postdata(); endif; ?>
	<section class="artistInformationExhibition">
		<?php
		
		$connected = new WP_Query( array(
			'connected_type' => 'exhibition_to_artist',
			'connected_items' => get_the_id(),
			'nopaging' => true,
			'meta_key'	=> 'start_date',
			'orderby'	=> 'meta_value_num',
			'order'		=> 'DESC'
		) );

		if ( $connected->have_posts() ) :

		?>

		<h6>Exhibitions</h6>
		
		<ul>
			<?php while($connected->have_posts() ) : $connected->the_post(); ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
		
	</section>
	<?php wp_reset_postdata(); endif; ?>
	<?php if(get_field('artist_cv')): ?>

	<div class="cv">
		<div class="constrain">
			<h5>CV</h5>
			<?php the_field('artist_cv'); ?>
		</div>
	</div>
					
	<?php if(get_field('artist_cv')): ?>
	<form class="download-cv no-smoothState" action="" method="POST">
		<input type="hidden" name="dlcv" value="true">
		<input type="submit" name="submit" value="Download CV as PDF">
	</form>
	<?php endif; ?>
	<?php else: ?>
	<?php endif; ?>
	<section class="artistToArtOld">
		<?php
		
		$connected = new WP_Query( array(
		  'connected_type' => 'art_to_artist',
		  'connected_items' => get_the_id(),
		  'nopaging' => true,
		) );

		if ( $connected->have_posts() ) :

			echo '<section class="container"><div class="masonry featured-works js-featured-works">';

			while($connected->have_posts() ) : $connected->the_post(); ?>
			
				<div class="masonry-item">
					<a href="<?php the_permalink(); ?>" class="no-smoothState" data-id="<?php echo get_the_id(); ?>">
						<?php echo get_the_post_thumbnail( get_the_id(), 'large' ); ?>
					</a>
				</div>
			
			<?php

			endwhile;

			wp_reset_postdata(); 

			echo '</div></section>';

		endif; ?>
	</section>
	<section class="artToArtistNew">
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
		
	</section>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>