<?php //template name: Home ?>
<?php get_header(); ?>

<?php

$today = current_time('Ymd');
$category = get_field('exhibition_category', 'options');

if ($category == 'Current'){
	$argTwo = array (
	    'post_type' => array('art-fair'),
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



else {

}
	;?>
<?php $currentArtF = new Wp_Query( $argTwo );

if($currentArtF->have_posts()) : while($currentArtF->have_posts()) : $currentArtF->the_post();

	?>
		<?php 		      
		$start_date = get_field('start_date', false, false);
		      $start_date = new DateTime($start_date);

		      if( get_field('end_date') ) {
		      	$end_date = get_field('end_date', false, false);
		      	$end_date = new DateTime($end_date);
		      } 
		?>
	<article class="artFairHome scroll-left" >
		<a href="<?php the_permalink(); ?>">
			
			<section class="title">Currently At: <?php the_title(); ?></section>
			<div class="dateLocationAF"><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?><br>
				<?php the_field('location'); ?>
			</div>
			
			<section class="moreInfo">
				More Information
			</section>

		</a>
		
	</article>
	

	


		      			
		      			

<?php endwhile; wp_reset_postdata(); ?>


<?php endif; ?>
<div class="exhibitions container">

		<?php

		$today = current_time('Ymd');
		$category = get_field('exhibition_category', 'options');

		if($category == 'Current') {

			$args = array (
			    'post_type' => array('exhibition'),
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
		elseif ($category == 'Current'){
			$argTwo = array (
			    'post_type' => array('art-fair'),
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
?>
		<?php $exhibitions = new Wp_Query( $args );

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