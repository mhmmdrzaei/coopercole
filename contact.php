<?php //template name: Contact ?>
<?php get_header(); ?>
<main>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<?php 
	$contactImage = get_the_post_thumbnail_url(null, 'full');?>
	<img src="<?php echo $contactImage ?>" alt="an image from the exhibtion <?php echo $titleExhibit ?>">	
	<section class="contactContainer">
		<aside class="galleryAddress">
			<h3><?php echo get_field('location')['address']; ?></h3>
			<a href="<?php the_field('location_link') ?>" target="_blank" class="contactMapLink">Map</a>
			
		</aside>
		<aside class="galleryContact">
			<a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a><br/>
			<a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a><br/>
		</aside>
		<aside class="galleryHours">
			<?php the_field('hours'); ?>
		</aside>
	</section>
	<section class="Mailinglist">
		<h3 class="toggle-mailing-list"><a href="#">Sign up for our mailing list</a></h3>
	</section>
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
			            <?php the_sub_field('full_length_paragraph') ?>

			        <?php elseif( get_row_layout() == 'half_length_paragraph_option' ): 
			            ?>
			            <?php the_sub_field('half_length_paragraph') ?>
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
			            <?php the_sub_field('dividing_line_additional'); ?>

			        <?php endif; ?>
			    <?php endwhile; ?>
			<?php endif; ?>

		</section>
		<div class="wrap-map">
			<div id="map" data-lat="<?php echo get_field('location')['lat']; ?>" data-lng="<?php echo get_field('location')['lng']; ?>"></div>
		</div>


</main>



	<?php endwhile; endif; ?>
	  
<?php get_footer(); ?>