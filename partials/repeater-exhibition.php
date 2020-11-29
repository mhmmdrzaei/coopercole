
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
<?php 
	$titleExhibit = get_the_title();
	$exhibitlocation = get_field('location');


 ?>


<article id="<?php echo $start_date->format('Y'); ?>" class="exhibition">
	<div class="image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('large'); ?>	

		</a>
	</div>

	<div class="description">
		<a href="<?php the_permalink(); ?>">
		<div class="constrainMohammad">
			<?php

				$connected = new WP_Query( array(
				  'connected_type' => 'exhibition_to_artist',
				  'connected_items' => get_the_id(),
				  'nopaging' => true,
				) );


				foreach($connected->posts as $p) {
					$lastname = explode(' ', $p->post_title);
					if(sizeof($lastname) == 1) {
						$p->lastname = $lastname[0];
					}
					if(sizeof($lastname) == 2) {
						$p->lastname = $lastname[1];
					}
					if(sizeof($lastname) == 3) {
						$p->lastname = $lastname[2];
					}
				}

				usort($connected->posts, 'cmp');

				if ( $connected->have_posts() ) :

					echo '<ul class="mohammadUl">';

					while ( $connected->have_posts() ) : $connected->the_post();

						echo '<li><h4>';

						echo get_the_title(get_the_id());


						echo '</h4></li>';

					endwhile;
					echo '</ul>';

			 endif;

				wp_reset_query($connected);

			?>
			<div class="nonartistsdesc" >
					<?php echo $titleExhibit ?>	

				<div class="date"><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></div>
				<div class="location"><?php echo $exhibitlocation ?></div>
			</div>
		</div>

		</a>
	</div>

</article>
