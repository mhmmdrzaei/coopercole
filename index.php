<?php //template name: Home ?>
<?php get_header(); ?>

<div class="exhibitions container">

		<?php

		$today = current_time('Ymd');
		$category = get_field('exhibition_category', 'options');

		if($category == 'Current') {

			$args = array (
			    'post_type' => 'exhibition',
			    'meta_query' => array(
			    	'relation' => 'AND',
					'start_clause' => array(
				        'key'		=> 'start_date',
				        'compare'	=> '<=',
				        'value'		=> $today
				    ),
				    'end_clause' => array(
				        'key'		=> 'end_date',
				        'compare'	=> '>=',
				        'value'		=> $today
				    )
			    ),
					'orderby' => array(
							'meta_value_num' => 'asc',
							'post_date' => 'desc'
					)
			    // 'orderby' => 'meta_value_num',
			    // 'order' => 'asc'
			);

		}

		elseif($category == 'Upcoming') {

			$args = array(
				'post_type' => 'exhibition',
				'meta_query' => [
					[
						'key'     => 'start_date',
						'value'   => $today,
						'compare' => '>'
					]
				],
				'orderby' => array(
						'meta_value_num' => 'asc',
						'post_date' => 'desc'
				)
				// 'orderby' => 'meta_value_num',
			  //   'order' => 'asc'
			);

		}

		else {

			$args = array(
				'post_type' => 'exhibition',
				'meta_query' => [
					[
						'key'     => 'end_date',
						'value'   => $today,
						'compare' => '<'
					]
				],
				'orderby' => array(
						'meta_value_num' => 'desc',
						'post_date' => 'desc'
				)
				// 'orderby' => 'meta_value_num',
			  //   'order' => 'desc'
			);


		}


		$exhibitions = new Wp_Query( $args );

		if($exhibitions->have_posts()) : while($exhibitions->have_posts()) : $exhibitions->the_post();

			?>

		<?php	get_template_part('partials/repeater-exhibition'); ?>


		<?php endwhile; wp_reset_postdata(); ?>

	<?php else: ?>
	<?php
		$args = array(
			'post_type' => 'page',
			'name' => 'home-page-closed'
		);

		$the_query = new WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				?>

				<?php if(get_field('page_banner')): ?>
					<figure class="page-banner"><img src="<?php echo get_field('page_banner')['sizes']['large']; ?>"></figure>
				<?php endif; ?>

				<div class="page-header container">
					<?php if(get_field('page_subtitle')): ?>
						<h2><?php the_field('page_subtitle'); ?></h2>
					<?php
						if (get_the_content()):
							the_content();
						endif;
					?>
					<?php endif; ?>
				</div>
				<?php
				endwhile;
			/* Restore original Post Data */
			wp_reset_postdata();
		 else :
			// no posts found
		endif; ?>


		<?php endif; ?>

	</div>



<?php get_footer(); ?>