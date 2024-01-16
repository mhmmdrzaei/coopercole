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
		    <?php

		    $connected = new WP_Query( array(
		      'connected_type' => 'art_to_artist',
		      'connected_items' => get_the_id(),
		      'nopaging' => true,
		    ) );

		    if ( $connected->have_posts() ) :

		      echo '<section class="artworksOld" id="artworksPages">';

		      while($connected->have_posts() ) : $connected->the_post(); ?>
		        <div class="artworkItemEach" >
		          <section class="toggleText">
		            <figure>
		              <?php echo get_the_post_thumbnail( get_the_id(), 'large' ); ?>
		            </figure>
		           
		              <?php
		              $title = get_the_title(); // This must be!, because this is the return - the_title would be echo
		              $title_array = explode('&#8211;', $title);
		              $first_word = $title_array[0];
		              $second_word = $title_array[1];

		              ?>
		              <section class="titleToggle">
		                <p class="toggleTextTitle"><?php echo $first_word; ?></p>
		                <div class="line"></div>
		                <p class="toggleTextWork"><?php echo $second_word; ?></p>
		              </section>
		              <section class="infoAnimated">

		                   
		                  <div>I</div>
		                  <div>n</div>
		                  <div>q</div>
		                  <div>u</div>
		                  <div>i</div>
		                  <div>r</div>
		                  <div>i</div>
		                  <div>e</div>
		                  <div>s</div>
		                  <div>→</div>
		              </section> 
		          </section>
		          <section class="artworkIteminfo" id="artworksOpenItem">
		            <section class="closeInfo">
		              Close
		            </section>
		            <section class="prevnext">
					<a href="#" class="previousItem">Previous</a> <span>/</span> <a href="#" class="nextItem">Next</a>
		            </section>
		            <section class="artworkItemInfoInnner">
					<section class="artworkItemInfoText">
		              <div class="artworkInfoTextFixed">
		              <p class="artworkInfoTitle"><?php echo the_title( $curr_id); ?><?php if(get_field('year', $curr_id)){ echo ', '.get_field('year', $curr_id).''; } ?></p>
		                <?php if(get_field('media', $curr_id)) { echo'<p>' .get_field('media', $curr_id).' </p>'; } ?>
		              <?php 
		                if(get_field('edition', $curr_id)) { echo '<p>'.get_field('edition', $curr_id).' </p>'; }
		               ?>
		                 <?php if(get_field('notes', $curr_id)) { echo '<p>'.get_field('notes', $curr_id).' </p>'; }
		                  ?>

		               <section class="dimentions">
		                       <?php 
		                       $height = get_field('height', $curr_id);
		                       $width = get_field('width', $curr_id);
		                       $depth = get_field('depth', $curr_id);
		                       $height_metric = convert_to_cm($height);
		                        $width_metric = convert_to_cm($width);
		                        $depth_metric = convert_to_cm($depth);

		                       if($depth) {
		                          echo $height . '" X ' . $width . '" X ' . $depth .'"<br/>';

		                          echo $height_metric . 'cm X ' . $width_metric .'cm X ' . $depth_metric .'cm<br/>';
		                        } else if ( $height && $width) {
		                          echo $height . '" X ' . $width .'"<br/>';
		                         echo $height_metric . 'cm X ' . $width_metric .'cm<br/>';

		                        } else {
		                         
		                        }




		                        ?>
		               </section>
					   <?php if(get_field('inventory', $curr_id)) { echo '<p>'.get_field('inventory', $curr_id).' </p>'; }
		                  ?>

		             </div>
		             <section class="inquiry">
		               <?php

		               $inquiry_email  = '';
		               $inquiry_email .= '<p>Thanks for inquiring. We will be in touch shortly with more information.</p>';
		               $inquiry_email .= '<p>For a quicker response feel free to call us at +1.416.531.8000.</p>';
		               $inquiry_email .= get_the_post_thumbnail( $curr_id, 'medium' );
		               $inquiry_email .= '<p>';
		               $inquiry_email .= $artist_name.'<br/>';
		               $inquiry_email .= get_field('title', $curr_id).', '.get_field('year', $curr_id).'<br/>';
		               if(get_field('media', $curr_id)) {
		                 $inquiry_email .= get_field('media', $curr_id).'<br/>';
		               }
		               if(
		                 get_field('edition', $curr_id)) {$inquiry_email .= get_field('edition', $curr_id).'<br/>';
		               }
		               if( $height && $width) {
		                 if($depth) {
		                   $inquiry_email .= $height . '" X ' . $width .'" X ' . $depth.'"<br/>';
		                   $inquiry_email .= 'cm X ' . $width_metric .'cm X ' . $depth_metric .'cm<br/>';
		                 }
		                 else {
		                   $inquiry_email .= $height . '" X ' . $width . '"<br/>';
		                   $inquiry_email .= $height_metric . 'cm X ' . $width_metric . 'cm<br/>';
		                 }
		               }
		               $inquiry_email .= 'Website Link: <a href="'.get_permalink( $curr_id ).'">'.get_the_title($curr_id).'</a>';
		               $inquiry_email .= '</p>';

		               ?>

		               <form id="submit-inquiry" class="no-smoothState">
		                 <input type="text" name="name" placeholder="name">
		                 <input type="email" name="email" placeholder="email">
		                 <input type="text" name="phone" placeholder="phone">
		                 <input type="text" name="location" placeholder="location">
		                 <textarea name="note" placeholder="Additional Notes"></textarea>
		                 <input type="hidden" name="subject" value="Website Inquiry: <?php echo get_the_title($curr_id); ?>">
		                 <input type="text" name="message" value="" style="display:none;">
		                 <input type="hidden" name="inquiry_message" value="<?php echo htmlspecialchars($inquiry_email); ?>" style="display:none;">
		                 <input class="inquireSubmit" type="submit" value="inquire">
		               </form>
		             </section>
		            </section>
		            					<div class="galleryContainer">
		            	         	<?php if(have_rows('not_embedded_video')){
		            	         	    while(have_rows('not_embedded_video')) {
		            	         	    the_row(); ?>
		            	         	    <div class="wrap-video">
		            	         	    <video controls>
		            	         	      <source src="<?php the_sub_field('video_file')?>" type="video/mp4" controls controlsList="nodownload">
		            	         	      Your browser does not support the video tag. </video></div>
		            	         	<?php } }; ?>

		            	              <?php if(have_rows('videos')){
		            	                 while(have_rows('videos')) { the_row();
		            	                     echo '<div class="wrap-video">';
		            	                         the_sub_field('video');
		            	                     echo '</div>';

		            	                     }
		            	                 } 
		            	                  else if(get_field('gallery')){

		            	                   $gallery = get_field('gallery');
		            	                     // echo '<div class="galleryContainer">';
		            	               
		            	                     foreach($gallery as $image) {

		            	                       echo '<img class="" src="'.$image['sizes']['large'].'" />';

		            	                       }
		            	                       // echo' </div>';
		            	                   }

		            	                   else {  
		            	                       the_post_thumbnail('large');
		            	                     }

		            	                   ?>
		            	                 </div>
		                  

		   				
		                </section>
		              </section>
		          </div>
		        

		      <?php endwhile; 
		        echo '</section>';
		      wp_reset_postdata(); endif; ?>
	</section>

	</main>


	
		
	

	

	<?php endwhile; endif; ?>

<?php get_footer(); ?>