<?php //template name: Artists ?>

<?php get_header(); ?>

	<?php $artist_type = get_query_var( 'artist_type' ); ?>

	<?php if(!$artist_type) $artist_type = 'represented'; ?>

	<?php $artist_types = get_terms( 'artist_type', array('hide_empty' => true) ); ?>

	<div class="container">

		<div class="page-header">
			<h1>Artists</h1>
			<div class="filters">
				<?php foreach($artist_types as $type): ?>
					<a href="<?php the_permalink(); ?>?artist_type=<?php echo $type->slug; ?>" class="<?php echo ($artist_type == $type->slug ? 'active' : 'inactive'); ?>"><?php echo $type->name; ?></a>
				<?php endforeach; ?>
			</div>
		</div>

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

			// echo '<pre>';

			// 	var_dump($artists->posts);

			// echo '</pre>';

			if($artists->have_posts()) : while($artists->have_posts()) : $artists->the_post();

			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'artist-featured' );

			// var_dump($image);

			?>

				<li>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						<div class="artist-background-image" style="background-image:url(<?php echo $image[0]; ?>);"></div>
					</a>
				</li>
			

			<?php endwhile; wp_reset_postdata(); endif; ?>

			</ul>

		</section>

	</div>
	  
<?php get_footer(); ?>