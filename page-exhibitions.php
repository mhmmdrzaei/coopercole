<?php
// template name: Exhibitions
get_header();
?>


<nav class="exhibitionYearsSide">
      <div class="exhibitionYearsSideInner">
         <button id="upClick">^</button>
        

         <?php
         // Query to get distinct years from exhibitions
         $year_query = new WP_Query(array(
            'post_type' => 'exhibition',
            'posts_per_page' => -1, // Get all posts
            'orderby' => 'meta_value',
            'meta_key' => 'start_date',
            'order' => 'DSC',
            'fields' => 'ids',
            'no_found_rows' => true,
         ));

         // Get distinct years from the query
         $years = array();
         foreach ($year_query->posts as $post_id) {
            $start_date = get_field('start_date', $post_id, false);
            $start_date = new DateTime($start_date);
            $years[] = $start_date->format('Y');
         }
         $years = array_unique($years);

         // Output the list of years as links
         if (!empty($years)) {
            echo '<ul id="menu-exhibition-years">';
            foreach ($years as $year) {
               echo '<li><a class="year-link" href="' . get_permalink() . '?exhibition_year=' . $year . '">' . $year . '</a></li>';
            }
            echo '</ul>';
         }
         wp_reset_postdata();
         ?>
		  <button id="downClick">^</button>
      </div>
   </nav>

   <section class="r">
      <?php
      $args = array(
         'post_type' => 'exhibition',
         'meta_key' => 'start_date',
         'orderby' => 'meta_value',
         'order' => 'DSC',
         'posts_per_page' => 20, // Number of exhibitions per page
         'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
      );

      // Check if a specific year is selected
      $selected_year = null;
      if (isset($_GET['exhibition_year'])) {
         $selected_year = $_GET['exhibition_year'];
         $args['meta_query'] = array(
            array(
               'key' => 'start_date',
               'value' => $selected_year . '-01-01',
               'compare' => '>=',
               'type' => 'DATE',
            ),
            array(
               'key' => 'start_date',
               'value' => ($selected_year + 1) . '-01-01',
               'compare' => '<',
               'type' => 'DATE',
            ),
         );
      }

      $exhibitions = new WP_Query($args);

      if ($selected_year) {
         echo '<h1 class="exhibitionYearTitle">Exhibitions: ' . $selected_year . '</h1>';
      }

      if ($exhibitions->have_posts()) :
         while ($exhibitions->have_posts()) : $exhibitions->the_post();
            // Your exhibition content here
            get_template_part('partials/repeater-exhibition');
         endwhile;
         wp_reset_postdata();
      else :
         echo '<p>No exhibitions found</p>';
      endif;
	  echo '<section class="pageNav">';
	  // Pagination
	  $big = 999999999; // need an unlikely integer
	  echo paginate_links(array(
		 'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		 'format' => '?paged=%#%',
		 'current' => max(1, get_query_var('paged')),
		 'total' => $exhibitions->max_num_pages,
		 'prev_text' => __('←', 'textdomain'),
		 'next_text' => __('→', 'textdomain'),
		 'mid_size' => 2, // Show a limited number of page numbers before and after the current page
		 'end_size' => 1, // Show a limited number of page numbers at the beginning and end
		 'prev_next' => true, // Whether to include the previous and next links in the list
		 'prev_next_before' => '<span class="prev-next">', // Add a span with a class before the previous and next links
		 'prev_next_after' => '</span>', // Close the span
	  ));
	  echo '</section>';
	  
      ?>

   </section>

<?php get_footer(); ?>
