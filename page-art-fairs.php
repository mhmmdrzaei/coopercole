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
	
	<div class="page-header container">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
		<?php endwhile; endif; ?>
	</div>

	<div class="exhibitions container">
		<div class="updates">
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
		      

		      <article class="exhibition">
		      	<div class="image">
		      		<a href="<?php the_permalink(); ?>">
		      			<?php the_post_thumbnail('large'); ?>	
		      		</a>
		      	</div>
		      	<div class="description">
		      		<div class="constrain">
		      			<h2>
		      				<a class="heading-link" href="<?php the_permalink(); ?>">
		      					<?php the_title(); ?>	
		      				</a>
		      			</h2>
		      			<div class="date"><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></div>
		      			<div class="location"><?php the_field('location'); ?></div>

		      			<?php
		      			add_filter( 'posts_orderby' , 'posts_orderby_lastname' );
		      				$connected = new WP_Query( array(
		      				  'connected_type' => 'art_fair_to_artist',
		      				  'connected_items' => get_the_id(),
		      				  'nopaging' => true,
		      				  		// 'order'				=> 'DESC',
		      				  		// 'orderby'    => array(
		      				  		// 	'title' => 'DESC'
		      				  		// ),

		      				) );
		      			
		      				// $connectedOrderedPosts = array();


		      				// foreach($connectedPosts as $iPos => $p){
		      				//     $connected = explode(' ', $p['post_title']);
		      				//     // cast the last name to lowercase and assign by reference the post
		      				//     $connectedOrderedPosts[strtolower($a[1])] =& $connectedPosts[$iPos];
		      				//     }

		      				// var_dump($connectedOrderedPosts);
		      				// perform a key sort
		      				// ksort($connectedOrderedPosts);
		      				// var_dump($connectedOrderedPosts);


		      				    // query_posts( $args ); // hijack the main loop

		      				if ( $connected->have_posts() ) :
		      					// foreach($connected->posts as $p) {
		      						
		      					// 	$lastname = explode(' ', $p->post_title);

		      					// 	if(sizeof($lastname) == 1) {
		      					// 		$p->lastname = $lastname[0];
		      					// 	}
		      					// 	if(sizeof($lastname) == 2) {
		      					// 		$p->lastname = $lastname[1];
		      					// 	}
		      					// 	if(sizeof($lastname) == 3) {
		      					// 		$p->lastname = $lastname[2];
		      					// 	}

		      					// }

		      					// // strcasecmp($connected->posts, 'cmp');

		      					// natcasesort($connected->posts, 'strnatcasecmp');
		      					// // usort($connected->posts, 'strnatcasecmp');

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
		      	</div>
		      </article>

		     <?php
		    endwhile;
		    ?>
		    <?php
		    wp_reset_query();
		    ?> 
		  </div> 


	</div>
	<?php get_footer(); ?>
	  