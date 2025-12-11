<?php get_header(); ?>
<main>
	<section class="exhibitionMain" id="pageTop">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<section class="artfairHeader">
			<section class="description">
				<h2><?php the_title(); ?></h2>
				<div class="date">
				<?php
					$start_date = get_field('start_date', false, false);
					$start_date = new DateTime($start_date);

					if( get_field('end_date') ) {
						$end_date = get_field('end_date', false, false);
						$end_date = new DateTime($end_date);
					} 
					?>

					<p><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></p>

					<?php
					$opening_closing_heading = get_field('opening__closing_heading');
					$opening_closing_reception = get_field('opening__closing_reception');

					// Check if the first field is filled out
					if (!empty($opening_closing_heading)) {
						// Display both fields wrapped in <h4> tags
						echo '<p>' . $opening_closing_heading . '<br>'; 
					}; 
					echo $opening_closing_reception . '</p>';
					?>
					
					<div class="location"><?php the_field('location'); ?></div>
					<div class="artFairArtists">
					<?php
					
					$connected = new WP_Query( array(
					  'connected_type' => 'art_fair_to_artist',
					  'connected_items' => get_the_id(),
					  'nopaging' => true,
					) );

					if ( $connected->have_posts() ) :

					?>
					
					<ul class="artFairExhibitors">
						<?php while($connected->have_posts() ) : $connected->the_post(); ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
					</ul>

					<?php wp_reset_postdata(); endif; ?>
					<?php if( have_rows('artist_with_no_artist_page') ): ?>
					    <ul class="nonRep">
					    <?php while( have_rows('artist_with_no_artist_page') ): the_row(); 
					        ?>
					        <li>
					            <?php the_sub_field('artist_name_noArtistPage'); ?>
					        </li>
					    <?php endwhile; ?>
					    </ul>
					<?php endif; ?>
				</div>
				</div>
			</section>
			<figure>
                    <?php the_post_thumbnail('large'); ?>
            </figure>

		</section>
		<section class="exhibitionsNew">
        <section class="imagesMenu menuArtfair">
            <section class="imagesmenuInner">
              <a href="#artworks" class="artworksScroll outerArtworks">↓ Artworks</a>
              <button class="prToggle">Press Release</button>
            
              
                  <?php $connected = new WP_Query( array(
                  'connected_type' => 'post_to_art_fair',
                  'connected_items' => get_the_id(),
                  'posts_per_page' => -1
                  ) );

                if($connected->have_posts()):
                ?>
                <nav class="exhibtionNews">
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
                </nav>
                <?php wp_reset_postdata(); endif; ?>
              
              <button class="moreInfo">Request More Information</button>

            </section>
            <section class="imagesMenuExpand">
              <section class="pressRelease">
                  <?php the_content(); ?>
                  <?php if( have_rows('additional_video_and_links') ): ?>
                  <?php while( have_rows('additional_video_and_links') ): the_row(); ?>
                  <?php if( get_row_layout() == 'add_video_additional' ): ?>
                  <?php if( have_rows('video_additionalMediaContent') ): ?>
                  <?php while( have_rows('video_additionalMediaContent') ): the_row(); 
                    $videoLink = get_sub_field('video_link_additionalMedia');
                    if( $videoLink ) {; ?>
                  <section class="featuredVideo">
                      <button class="featuredVideoTitle">
                          <img src="<?php bloginfo('template_directory'); ?>/images/movie_icon.svg">
                          <?php the_sub_field('video_label_additionalMedia') ?>
                      </button>
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
                      <a href="<?php the_sub_field('actual_link_additionalMedia'); ?>"
                          target="_blank"><?php the_sub_field('link_label_additionalMedia'); ?> <i
                              class="fas fa-external-link-alt"></i></a>
                  </section>
                  <?php } ?>
                  <?php endwhile; ?>
                  <?php endif; ?>
                  <?php endif; ?>
                  <?php endwhile; ?>
                  <?php endif; ?>
              </section>
              <section class="exhibitionInquiry">
              <section class="closeInquiry">Close</section>
              <p>To learn more about this artfair, please provide your contact information.</p>
                <?php

                  $inquiry_email  = '';
                  $inquiry_email .= '<p>Thanks for inquiring about '.get_the_title($curr_id). '. We will be in touch shortly with more information.</p>';
                  $inquiry_email .= get_the_post_thumbnail( $curr_id, 'medium' );
                  $inquiry_email .= '<p> Art fair Details:</p>';
                  $inquiry_email .= '<ul>';
                  $inquiry_email .= '<li><strong> '.get_the_title($curr_id).'</strong></li>';
                  $inquiry_email .= '<li><strong>Date:</strong> ';
                  $start_date = get_field('start_date', false, false);
                  $start_date = new DateTime($start_date);
                  $end_date = get_field('end_date', false, false);
                  if( $end_date ) {
                      $end_date = new DateTime($end_date);
                      $inquiry_email .= $start_date->format('F j, Y').' - '.$end_date->format('F j, Y');
                  } else {
                      $inquiry_email .= $start_date->format('F j, Y');
                  }
                  $inquiry_email .= '</li>';
                  $inquiry_email .= '<li><strong>Location:</strong> '.get_field('location').'</li>';
                  $inquiry_email .= '</ul>';  
                  $inquiry_email .= '<p>For a quicker response feel free to call us at +1.416.531.8000.</p>';
                  $inquiry_email .= '<p>';
                  $inquiry_email .= 'Art Fair: <a href="'.get_permalink( $curr_id ).'">'.get_the_title($curr_id).'</a>';
                  $inquiry_email .= '</p>';

                  ?>

                <form id="submit-inquiry" class="inquireFormFull">
                    <input type="text" name="name" placeholder="name">
                    <input type="email" name="email" placeholder="email">
                    <input type="text" name="phone" placeholder="phone">
                    <input type="text" name="location" placeholder="location">
                    <textarea name="note" placeholder="Additional Notes"></textarea>
                    <input type="hidden" name="subject"
                        value="Art Fair Inquiry: <?php echo get_the_title($curr_id); ?>">
                    <input type="text" name="message" value="" style="display:none;">
                    <input type="hidden" name="inquiry_message"
                        value="<?php echo htmlspecialchars($inquiry_email); ?>" style="display:none;">
                    <input class="inquireSubmit" type="submit" value="Request More Information">
                </form>
              </section>
            </section>
        </section>
	
<section class="exhibitionImages" id="exhibitionImages">
	<!-- carousel -->
	<?php if(get_field('carousel')): ?>

	<?php
	  $slides = get_field('carousel');
	  $slide_amount = count($slides);
	  foreach($slides as $slide):

	  ?>
	<figure class="exhibitionImgs">
	<img class="exhibitionImgsLL" src="<?php echo $slide['url']; ?>" alt="" id="<?php echo $slide['id'];?>" />

	</figure>

	<?php endforeach; ?>

	<?php endif; ?>
	<!-- not embedded video -->
	<?php if(have_rows('not_embedded_video')){
	while(have_rows('not_embedded_video')) {
	the_row(); ?>
	<div class="videoContainer">
	<video controls>
		<source src="<?php echo get_sub_field('video_file')?>" type="video/mp4" controls
			controlsList="nodownload">
		Your browser does not support the video tag.
	</video>

	</div>

	<?php } }; ?>
</section>
</section>
</section>
<?php render_artworks_section('art_to_art_fair'); ?>
	   
</section>
</main>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>