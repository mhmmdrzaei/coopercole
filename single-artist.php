<?php get_header(); ?>
	
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<main>
		<h1 class="artistName"><?php the_title(); ?></h1>
		<section class="artistMain">
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

				<section class="artistBio">
					<button class="bioOpen">Artist Bio</button>
					<section class="artistbioContent">
						<?php the_content(); ?>
							<?php 
								$artistCV = get_field('cv_pdf');
								if( $artistCV ) {; ?>

							<a class="downloadCV" href="<?php the_field('cv_pdf'); ?>" target="_blank" ><img src="<?php bloginfo('template_directory'); ?>/images/cv_icon.svg"> Download CV</a>
						<?php }; ?>	
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
					</section>
				</section>
				<section class="exhbitionscont">
					<button class="exhibitionsOpen">Gallery Exhibitions</button>
						<div id="exhibitionContentID">
						<ul class="newsContent">
						<?php while($connected->have_posts()) : $connected->the_post(); ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
						</ul>
					</div>
					<?php wp_reset_postdata(); endif; ?>

				</section>

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
				    <div class="moreNewsOpen">
				    	
				    </div>
				  </ul>
				  </div>
				   <?php wp_reset_postdata(); endif; ?>
				</nav>
		</section>
		  <section class="artworksMainAritsts">
		  <?php render_artworks_section('art_to_artist'); ?>

	</section>

	</main>


	
		
	

	

	<?php endwhile; endif; ?>

<?php get_footer(); ?>