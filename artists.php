<?php //template name: Artists ?>

<?php get_header(); ?>

	<?php $artist_type = get_query_var( 'artist_type' ); ?>

	<?php if(!$artist_type) $artist_type = 'represented'; ?>

	<?php $artist_types = get_terms( 'artist_type', array('hide_empty' => true) ); ?>

	<main class="artistsMain">
		<h1>Artists:</h1>
		<section class="artists">

			<ul>

			<?php 

			$args = array('post_type' => 'artist', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'asc', 'artist_type' => $artist_type);

			$artists = new WP_Query( $args ); 

			foreach($artists->posts as $p) {
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

			usort($artists->posts, 'cmp');


			if($artists->have_posts()) : while($artists->have_posts()) : $artists->the_post();


			?>

				<li>
					<a class="rainbow" href="<?php the_permalink(); ?>">
						<?php the_title(); ?> . 
					</a>
				</li>
			

			<?php endwhile; wp_reset_postdata(); endif; ?>

			</ul>

		</section>
	</main>

	  
<?php get_footer(); ?>