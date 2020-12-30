<?php //template name: Art Fairs ?>

<?php get_header(); ?>
<?php

$event_status = "past";

if(get_query_var('event_status')) {
	$event_status = get_query_var( 'event_status' );
}

$start_date = get_field('start_date', false, false);
$start_date = new DateTime($start_date);

if( get_field('end_date') ) {
	$end_date = get_field('end_date', false, false);
	$end_date = new DateTime($end_date);
}

?>
<main>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<?php endwhile; endif; ?>
	  <?php $args = array( 'post_type' => 'art-fair', 
	  						'meta_key'			=> 'start_date',
					// 'orderby'			=> 'meta_value',
							'order'				=> 'DESC',
					// 'orderby' => array(
					// 		'meta_value_num' => 'desc',
					// 		'post_date' => 'desc'
							'orderby'    => array(
								'start_date' => 'DSC',
								'post_date' => 'desc'
							),
	   						'posts_per_page' => -1 );
	    query_posts( $args ); // hijack the main loop
	    while ( have_posts() ) : the_post();
	      ?>
	      <?php

	      $event_status = "past";

	      if(get_query_var('event_status')) {
	      	$event_status = get_query_var( 'event_status' );
	      }

	      $start_date = get_field('start_date', false, false);
	      $start_date = new DateTime($start_date);

	      if( get_field('end_date') ) {
	      	$end_date = get_field('end_date', false, false);
	      	$end_date = new DateTime($end_date);
	      }

	      ?>
	      

	      <article class="artFairEach">
	      	
				<div class="description">
	      			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	      			<div class="date"><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></div>
	      			<div class="location"><?php the_field('location'); ?></div>

	      			<?php
	      			add_filter( 'posts_orderby' , 'posts_orderby_lastname' );
	      				$connected = new WP_Query( array(
	      				  'connected_type' => 'art_fair_to_artist',
	      				  'connected_items' => get_the_id(),
	      				  'nopaging' => true,

	      				) );
	      			

	      				if ( $connected->have_posts() ) :
	      					echo '<ul>';

	      					while ( $connected->have_posts() ) : $connected->the_post();
	      						echo '<li>';

	      						if(get_the_content() !== '') {
	      							echo '<a href="'.get_permalink( get_the_id() ).'">';
	      						}

	      						echo get_the_title(get_the_id());

	      						if(get_the_content() !== '') {
	      							echo '</a>';
	      						}

	      						echo '</li>';

	      					endwhile;

	      					echo '</ul>';

	      					wp_reset_postdata();

	      				endif;
	      				remove_filter( 'posts_orderby' , 'posts_orderby_lastname' );

	      			?>
		      	</div>
		      	<figure>
		      		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
		      	</figure>
	      </article>


		 

<?php endwhile;?>
<?php wp_reset_query();?> 
</main>
	<?php get_footer(); ?>
	  