<?php get_header(); ?>
<main>
	<section class="exhibitionMain" id="pageTop">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<section class="exhibitionSide" id="exhibtionSideScroll">
				<div class="outer">
				  <a href="#pageTop">↑ Back to the Top</a>
				  <section class="outerArtworks">
				    <a href="#artworks">↓ Artworks</a>
				  </section>
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

					<?php
					$opening_closing_heading = get_field('opening__closing_heading');
					$opening_closing_reception = get_field('opening__closing_reception');

					// Check if the first field is filled out
					if (!empty($opening_closing_heading)) {
						// Display both fields wrapped in <h4> tags
						echo '<h4>' . $opening_closing_heading . '<br>'; 
					}; 
					echo $opening_closing_reception . '</h4>';
					?>

					

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
					<?php if( have_rows('artist_with_no_artist_page') ): ?>
					    <ul class="nonRepArtists">
					    <?php while( have_rows('artist_with_no_artist_page') ): the_row(); 
					        ?>
					        <li>
					            <?php the_sub_field('artist_name_noArtistPage'); ?>
					        </li>
					    <?php endwhile; ?>
					    </ul>
					<?php endif; ?>
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
		<section class="exhibitionContent text-area" >
			<?php the_content(); ?>
		</section>
		<button class="read-more-btn">+ Read More</button>
		<p class="artworksLink outerArtworks"><a href="#artworks">Artworks</a></p>
		<?php if( have_rows('additional_video_and_links') ): ?>
		    <?php while( have_rows('additional_video_and_links') ): the_row(); ?>
		        <?php if( get_row_layout() == 'add_video_additional' ): ?>
		          <?php if( have_rows('video_additionalMediaContent') ): ?>
		          <?php while( have_rows('video_additionalMediaContent') ): the_row(); 
		            $videoLink = get_sub_field('video_link_additionalMedia');
		            if( $videoLink ) {; ?>
		            <section class="featuredVideo">
		            <button class="featuredVideoTitle"><img src="<?php bloginfo('template_directory'); ?>/images/movie_icon.svg"> <?php echo get_sub_field('video_label_additionalMedia') ?></button> 
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
		 <?php if(get_field('carousel')): ?>
		 <section class="exhibitionImages">
		     <?php
		       $slides = get_field('carousel');
		       $slide_amount = count($slides);
		       foreach($slides as $slide):

		       ?>

		       <img class="exhibitionImgsLL" src="<?php echo $slide['sizes']['large']; ?>" alt="" id="<?php echo $slide['id'];?>"/>

		       <?php endforeach; ?>
		 </section>
		   <?php endif; ?>
	</section>
</section>
<?php render_artworks_section('art_to_art_fair'); ?>
	   
</section>
</main>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>