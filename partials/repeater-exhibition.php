<?php

$event_status = "past";

if(get_query_var('event_status')) {
	$event_status = get_query_var( 'event_status' );
}


?>
<?php 
	$titleExhibit = get_the_title();
	$exhibitlocation = get_field('location');
	$start_date_raw = get_field('start_date', false, false);
	$end_date_raw = get_field('end_date', false, false);
	$opening_closing_heading = get_field('opening__closing_heading');
	$opening_closing_reception = get_field('opening__closing_reception');

 ?>
<?php 
	$exhibitionImage = get_the_post_thumbnail_url(null, 'full');

 ?>


<article class="exhibitionHome">
    <a href="<?php the_permalink(); ?>">
        <figure class="image">
            <img src="<?php echo $exhibitionImage ?>" alt="an image from the exhibtion <?php echo $titleExhibit ?>">
        </figure>

        <section class="exhibitionInfoDetail">
            <section class="artistNameExhibitionHome">

                <?php if( have_rows('artist_with_no_artist_page') ): ?>
                <ul class="nonRepArtists">
                    <?php while( have_rows('artist_with_no_artist_page') ): the_row(); 
		?>
                    <li>
                        <h3><?php the_sub_field('artist_name_noArtistPage'); ?></h3>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
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

			echo '<li><h3 class="artistnameH3">';

			echo get_the_title(get_the_id());


			echo '</h3></li>';

		endwhile;
		// echo "<section class='moreArtistNamesOpen'></section>";
		echo '</ul>';

 	endif;

	wp_reset_query($connected);?>
                <!-- <button class="moreArtistNamesOpen">More Artists</button> -->
            </section>
            <section class="exhibitionDetailsHome">
                <h2><?php echo $titleExhibit ?> </h2>
                <section class="otherinfo">

                    <?php

						if ($start_date_raw) {
							$start_date = new DateTime($start_date_raw);
							$start_year = $start_date->format('Y');
							
							if ($end_date_raw) {
								$end_date = new DateTime($end_date_raw);
								$end_year = $end_date->format('Y');
								
								if ($start_year === $end_year) {
									// Same year: show start without year, end with year
									echo '<p>' . $start_date->format('F j') . ' – ' . $end_date->format('F j, Y') . '</p>';
								} else {
									// Different years: show both with full format
									echo '<p>' . $start_date->format('F j, Y') . ' – ' . $end_date->format('F j, Y') . '</p>';
								}
							} else {
								// Only start date
								echo '<p>' . $start_date->format('F j, Y') . '</p>';
							}
						}
						?>

                    <?php

						// Check if the first field is filled out
						if (!empty($opening_closing_heading)) {
							// Display both fields wrapped in <h4> tags
							echo '<p>' . $opening_closing_heading . '<br>'; 
						}; 
						echo $opening_closing_reception . '</p>';
					?>

                    <p><?php echo $exhibitlocation ?></p>

                </section>

            </section>



        </section>
		<section class="exhibitionDetailsHomeMobile">
                <h2><?php echo $titleExhibit ?> </h2>
                <section class="otherinfo">

                    <?php

						if ($start_date_raw) {
							$start_date = new DateTime($start_date_raw);
							$start_year = $start_date->format('Y');
							
							if ($end_date_raw) {
								$end_date = new DateTime($end_date_raw);
								$end_year = $end_date->format('Y');
								
								if ($start_year === $end_year) {
									// Same year: show start without year, end with year
									echo '<p>' . $start_date->format('F j') . ' – ' . $end_date->format('F j, Y') . '</p>';
								} else {
									// Different years: show both with full format
									echo '<p>' . $start_date->format('F j, Y') . ' – ' . $end_date->format('F j, Y') . '</p>';
								}
							} else {
								// Only start date
								echo '<p>' . $start_date->format('F j, Y') . '</p>';
							}
						}
						?>

                    <?php

						// Check if the first field is filled out
						if (!empty($opening_closing_heading)) {
							// Display both fields wrapped in <h4> tags
							echo '<p>' . $opening_closing_heading . '<br>'; 
						}; 
						echo $opening_closing_reception . '</p>';
					?>

                    <p><?php echo $exhibitlocation ?></p>

                </section>

            </section>

    </a>


</article>