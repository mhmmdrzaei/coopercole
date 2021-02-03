
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
<?php 
	$exhibitionImage = get_the_post_thumbnail_url(null, 'full');

 ?>

<article id="<?php echo $start_date->format('Y'); ?>" class="exhibition">
	<a href="<?php the_permalink(); ?>">

	<section class="artistNameExhibition">
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
				echo "<section class='moreArtistNamesOpen'></section>";
				echo '</ul>';

		 endif;

			wp_reset_query($connected);

		?>
		<!-- <button class="moreArtistNamesOpen">More Artists</button> -->
	</section>
	<figure class="image">
			<img src="<?php echo $exhibitionImage ?>" alt="an image from the exhibtion <?php echo $titleExhibit ?>">
	</figure>
	<section class="exhibitionDetails">
		<h3><?php echo $titleExhibit ?>	</h3>
		<aside class="exhibitionDateLocation">
			<div class="date"><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></div>
			<div class="location"><?php echo $exhibitlocation ?></div>
		</aside>
	</section>
	<aside class="exhibitionDateLocationMobile">
		<div class="date"><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></div>
		<div class="location"><?php echo $exhibitlocation ?></div>
	</aside>


	</a>

</article>
