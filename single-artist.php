<?php get_header(); ?>
	
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<main>
		<h1 class="artistName"><?php the_title(); ?></h1>
		<section class="artistMain">
			<section class="artistsMainSide">
				<nav class="exhibtionNews artistsExhibtion">
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

				  <button class="exhibitionsOpen">Gallery Exhibitions</button>
				  <div id="exhibitionContentID">
				  <ul class="newsContent">
				    <?php while($connected->have_posts()) : $connected->the_post(); ?>
				      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				    <?php endwhile; ?>
				  </ul>
				  </div>
				   <?php wp_reset_postdata(); endif; ?>
				</nav>
				<nav class="exhibtionNews">
				        <?php
				  $connected = new WP_Query( array(
				    'connected_type' => 'post_to_artist',
				    'connected_items' => get_the_id(),
				    'posts_per_page' => -1
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
				  </div>
				   <?php wp_reset_postdata(); endif; ?>
				</nav>
				<?php 
					 $artistCV = get_field('cv_pdf');
				      if( $artistCV ) {; ?>

				   <a class="downloadCV" href="<?php the_field('cv_pdf'); ?>" target="_blank" ><img src="<?php bloginfo('template_directory'); ?>/images/cv_icon.svg"> Download CV</a>
				<?php }; ?>	
			</section>
			<section class="artistMainCenter">
				
				 <?php the_content(); ?>
	
				<section class="featuredVideo">
				  
				    <?php if( have_rows('related_featured_video') ): ?>
				    <?php while( have_rows('related_featured_video') ): the_row(); 
				     ?>
				     <button class="featuredVideoTitle"><img src="<?php bloginfo('template_directory'); ?>/images/movie_icon.svg"> <?php the_sub_field('video_text') ?></button> 
				     <div id="featuredVideoLink" class="video-responsive">
				       <?php the_sub_field('video_link'); ?>
				     </div>
				    <?php endwhile; ?>
				     <?php endif; ?>    
				 </section>
			</section>
		</section>
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

	</main>


	
		
	

	

	<?php endwhile; endif; ?>

<?php get_footer(); ?>