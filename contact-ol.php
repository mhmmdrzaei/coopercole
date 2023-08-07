<?php //template name: Contact ?>
<?php get_header(); ?>
<main class="contactMain">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<section class="contactContainer">
		<aside class="galleryAddress">
			<h1>Address</h1>
			<p><?php the_field('gallery_address_footer','options') ?></p>
			<a class="addressMap"href="#map" class="contactMapLink">Map</a>
			
		</aside>
		<aside class="galleryContact">
			<h1>Contact</h1>
			<a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a><br/>
			<a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a><br/>
		</aside>
		<aside class="galleryHours">
			<h1>Hours</h1>
			<?php the_field('hours'); ?>
		</aside>
	</section>
	<hr>
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
		<section class="Mailinglist">
		<h3 class="toggle-mailing-list">Sign up for our mailing list</h3>
		</section>
		<style type="text/css">
		.acf-map {
		    width: 100%;
		    height: 400px;
		    border: #ccc solid 1px;
		    margin: 20px 0;
		}

		// Fixes potential theme css conflict.
		.acf-map img {
		   max-width: inherit !important;
		}
		</style>
		<?php 
		$location = get_field('location');
		if( $location ): ?>
		    <div class="acf-map" data-zoom="16">
		        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
		    </div>
		<?php endif; ?>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDovfUJxvALAYE_sYRVM_VLGCeb63Wrgow"></script>
		<script type="text/javascript">
		(function( $ ) {

		/**
		 * initMap
		 *
		 * Renders a Google Map onto the selected jQuery element
		 *
		 * @date    22/10/19
		 * @since   5.8.6
		 *
		 * @param   jQuery $el The jQuery element.
		 * @return  object The map instance.
		 */
		function initMap( $el ) {


		    // Find marker elements within map.
		    var $markers = $el.find('.marker');

		    // Create gerenic map.
		    var mapArgs = {
		        zoom        : $el.data('zoom') || 16,
		        mapTypeId   : google.maps.MapTypeId.ROADMAP,
		        styles: [
    {
        "featureType": "all",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#008eff"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": "0"
            },
            {
                "lightness": "0"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            },
            {
                "saturation": "-60"
            },
            {
                "lightness": "-20"
            }
        ]
    }
]
		    };
		    var map = new google.maps.Map( $el[0], mapArgs );

		    // Add markers.
		    map.markers = [];
		    $markers.each(function(){
		        initMarker( $(this), map );
		    });

		    // Center map based on markers.
		    centerMap( map );

		    // Return map instance.
		    return map;
		}

		/**
		 * initMarker
		 *
		 * Creates a marker for the given jQuery element and map.
		 *
		 * @date    22/10/19
		 * @since   5.8.6
		 *
		 * @param   jQuery $el The jQuery element.
		 * @param   object The map instance.
		 * @return  object The marker instance.
		 */
		function initMarker( $marker, map ) {

		    // Get position from marker.
		    var lat = $marker.data('lat');
		    var lng = $marker.data('lng');
		    var latLng = {
		        lat: parseFloat( lat ),
		        lng: parseFloat( lng )
		    };

		    // Create marker instance.
		    var marker = new google.maps.Marker({
		        position : latLng,
		        map: map,
		        title:    'COOPER COLE',
		        icon:  '<?php bloginfo('template_directory'); ?>/images/ccsmallgreendropshadow.png'
		    });

		    // Append to reference for later use.
		    map.markers.push( marker );

		    // If marker contains HTML, add it to an infoWindow.
		    if( $marker.html() ){

		        // Create info window.
		        var infowindow = new google.maps.InfoWindow({
		            content: $marker.html()
		        });

		        // Show info window when marker is clicked.
		        google.maps.event.addListener(marker, 'click', function() {
		            infowindow.open( map, marker );
		        });
		    }
		}

		/**
		 * centerMap
		 *
		 * Centers the map showing all markers in view.
		 *
		 * @date    22/10/19
		 * @since   5.8.6
		 *
		 * @param   object The map instance.
		 * @return  void
		 */
		function centerMap( map ) {

		    // Create map boundaries from all map markers.
		    var bounds = new google.maps.LatLngBounds();
		    map.markers.forEach(function( marker ){
		        bounds.extend({
		            lat: marker.position.lat(),
		            lng: marker.position.lng()
		        });
		    });

		    // Case: Single marker.
		    if( map.markers.length == 1 ){
		        map.setCenter( bounds.getCenter() );

		    // Case: Multiple markers.
		    } else{
		        map.fitBounds( bounds );
		    }
		}

		// Render maps on page load.
		$(document).ready(function(){
		    $('.acf-map').each(function(){
		        var map = initMap( $(this) );
		    });
		});

		})(jQuery);
		</script>

		<div class="afc-map">
			<div id="map" data-lat="<?php echo get_field('location')['lat']; ?>" data-lng="<?php echo get_field('location')['lng']; ?>"></div>
		</div>

</main>



	<?php endwhile; endif; ?>
	  
<?php get_footer(); ?>