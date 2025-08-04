<?php //template name: Contact ?>
<?php get_header(); ?>
<button id="myBtn" title="Go to top">&#x2963;</button>

<main class="contactMain">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<section class="aboutContactContainer">
		<figure class="rainbowimg">
		<img  src="<?php bloginfo('template_directory'); ?>/images/rainbow.svg">

		</figure>
		
		<aside class="galleryAddress">
			<figure class="aboutimg" alt="address label">
			<?php require('images/address.svg');?>
			</figure>
			<p><?php the_field('gallery_address_footer','options') ?></p>
			
		</aside>
		<aside class="jumpToMap">
		<a class="addressMap"href="#map" class="contactMapLink"><?php require('images/map.svg');?></a>
		</aside>
		<aside class="galleryContact">
		<figure class="aboutimg"alt="contact label">
			<?php require('images/contact.svg');?>
			</figure>
			<section class="contactinfo">
			<a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a>
			<a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a>

			</section>

		</aside>
		<aside class="galleryHours">
		<figure class="aboutimg"alt="hours label">
			<?php require('images/hours.svg');?>
			</figure>
			<?php the_field('hours'); ?>
		</aside>

		<section class="Mailinglist ">
		<figure class="mailing-list-img"alt="sign up for our mailing list button">
			<?php require('images/mailing_list.svg');?>
			</figure>
	
		</section>
	</section>
	<section class="aboutAdditional">
	<section class="galleryAdditionalInfo">
			<?php if( have_rows('flexible_additional_info') ): ?>
			    <?php while( have_rows('flexible_additional_info') ): the_row(); ?>
			    	<?php if( get_row_layout() == 'link_dynamic_info_option' ): ?>
			    	<?php if( have_rows('link_dynamic_info') ): ?>
			    	    <?php while( have_rows('link_dynamic_info') ): the_row(); 

			    	        ?>
			    	        <a href="<?php the_sub_field('link_url_additional1'); ?>" class="<?php the_sub_field('link_style_additional1'); ?>"target="<?php the_sub_field('link_target_addional1'); ?>"><?php the_sub_field('link_label_additional1'); ?></a>

			    	    <?php endwhile; ?>
			    	<?php endif; ?>	
		

			        <?php elseif( get_row_layout() == 'full_length_pargraph_option' ):

			            ?>
			            <div class="paragraphFull">
			            	<?php the_sub_field('full_length_paragraph') ?>
			            </div>
			            

			        <?php elseif( get_row_layout() == 'half_length_paragraph_option' ): 
			            ?>
			            <div class="paragraphHalf">
			            	<?php the_sub_field('half_length_paragraph') ?>
			            </div>
			            
			        <?php elseif( get_row_layout() == 'paragraph_header_option' ): 
			            ?>
			            <?php if( have_rows('page_header_additional_info') ): ?>
			                <?php while( have_rows('page_header_additional_info') ): the_row(); 

			                    ?>
			                    <<?php the_sub_field('header_level_header_title'); ?>>
			                    <?php the_sub_field('text_header_title'); ?>
			                    </<?php the_sub_field('header_level_header_title'); ?>>

			                <?php endwhile; ?>
			            <?php endif; ?>	
			        <?php elseif( get_row_layout() == 'dividing_line_Option' ): 
			            ?>
			            <?php the_sub_field('dividing_line_contact'); ?>

			        <?php endif; ?>
			    <?php endwhile; ?>
			<?php endif; ?>

		</section>


		<!-- <?php 
		$location = get_field('location');
		if( $location ): ?>
		<div class="acf-map-container">
			<div class="acf-map" data-zoom="16">
		        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
		    </div>
			<div id="custom-place-card">
				<div class="place-name">COOPER COLE</div>
				<div class="address">1134 Dupont Street and, 1136 Dupont St, Toronto, ON M6H 2A2</div>
				<div class="navigate">
					<a href="https://maps.google.com/maps/dir//COOPER+COLE+1134+Dupont+Street+and+1136+Dupont+St+Toronto,+ON+M6H+2A2" target="_blank">Directions</a>
				</div>
				<div class="bottom-actions"> <div class="google-maps-link"> <a aria-label="View larger map" target="_blank" jstcache="31" href="https://maps.google.com/maps?ll=43.668886,-79.438091&amp;z=16&amp;t=m&amp;hl=en&amp;gl=CA&amp;mapclient=embed&amp;cid=16927537206618789464" jsaction="mouseup:placeCard.largerMap">View larger map</a> </div> </div>
			</div>
		</div>
		    
		<?php endif; ?>
		 -->

		<div class="acf-map-new">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2886.0038500065116!2d-79.44066602358289!3d43.66888975141553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b34f93e03f037%3A0xeaeab1674ab89658!2sCOOPER%20COLE!5e0!3m2!1sen!2sca!4v1707405042663!5m2!1sen!2sca&amp;markers=color:blue%7Clabel:A%7C43.66888975141553,-79.44066602358289" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

		</div>

		

	</section>

</main>



	<?php endwhile; endif; ?>
	  
<?php get_footer(); ?>