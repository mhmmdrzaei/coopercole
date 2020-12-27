<?php get_header(); ?>
<main>
	<section class="exhibitionMain" id="pageTop">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<section class="exhibitionSide" id="exhibtionSideScroll">
				<div class="outer">
				  <a href="#pageTop">↑ Back to the Top</a>
				  <a href="#artworks">↓ Artworks</a>
				</div>
				<figure class="artFairLogo">
					<?php the_post_thumbnail('medium'); ?>
				</figure>
				<h2 class="artFairTitle">
					<?php the_title(); ?>
				</h2>
				<div class="artFairDates">

					<?php
					$start_date = get_field('start_date', false, false);
					$start_date = new DateTime($start_date);

					if( get_field('end_date') ) {
						$end_date = get_field('end_date', false, false);
						$end_date = new DateTime($end_date);
					} 
					?>

					<p><strong><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></strong></p>

					

				</div>
				<div class="artFairArtists">
					<?php
					
					$connected = new WP_Query( array(
					  'connected_type' => 'art_fair_to_artist',
					  'connected_items' => get_the_id(),
					  'nopaging' => true,
					) );

					if ( $connected->have_posts() ) :

					?>

					<h4>Exhibitiors</h4>
					
					<ul class="artFairExhibitors">
						<?php while($connected->have_posts() ) : $connected->the_post(); ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
					</ul>

					<?php wp_reset_postdata(); endif; ?>
				</div>
				<nav class="exhibtionNews">

					<?php

					$connected = new WP_Query( array(
					  'connected_type' => 'post_to_art_fair',
					  'connected_items' => get_the_id(),
					  'nopaging' => true
					) );

					if($connected->have_posts()):

					?>
					<button class="newsOpen">News</button>
					<div id="newsContentID">
					<ul class="newsContent">

						<?php while($connected->have_posts()) : $connected->the_post(); ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
					</ul>
					<?php wp_reset_postdata(); endif; ?>
					</div>
				</nav>

	</section>
	<section class="exhibitionCenter">
		<section class="exhibitionContent text-area" data-controller="#readMore1">
			<?php the_content(); ?>
		</section>
		<button id="readMore1" class="btn btn-info">Read more</button> 
		<p class="artworksLink"><a href="#artworks">Artworks</a></p>
		<section class="featuredVideo">
		  
		    <?php if( have_rows('related_featured_video') ): ?>
		    <?php while( have_rows('related_featured_video') ): the_row(); 
		     ?>
		     <button class="featuredVideoTitle"><?php the_sub_field('video_text') ?></button> 
		     <div id="featuredVideoLink" class="video-responsive">
		       <?php the_sub_field('video_link'); ?>
		     </div>
		    <?php endwhile; ?>
		     <?php endif; ?>    
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
	</section>
	<section class="artworksMain">
	  <h3 id="artworks">Artworks</h3>

	</section>
</main>

	
		<h1></h1>

		



			<div class="right-col">
				
				



			</div>

<p>Featured Artworks</p>

		<?php if(get_field('carousel')): ?>

		<section class="wrap-exhibition-carousel">
				
				<?php
				$slides = get_field('carousel');
				foreach($slides as $slide):
				?>

				<div class="slide">
					<img src="<?php echo $slide['sizes']['large']; ?>" alt="">
				</div>

				<?php endforeach; ?>


		</section>


		<?php endif; ?>
<section class="artArtFairs">
		<?php
	
		$connected = new WP_Query( array(
		  'connected_type' => 'art_to_art_fair',
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

		  <?php
		$featured_posts = get_field('connected_art');
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