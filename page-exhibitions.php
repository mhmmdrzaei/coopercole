<?php
// Template Name: Exhibitions
get_header();
?>

<nav class="exhibitionYearsSide">
   <h4>Archives:</h4>

        <?php
        // Query to get distinct years from exhibitions
        $year_query = new WP_Query(array(
            'post_type'      => 'exhibition',
            'posts_per_page' => -1, // Get all posts
            'orderby'        => 'meta_value',
            'meta_key'       => 'start_date',
            'order'          => 'DESC',
            'fields'         => 'ids',
            'no_found_rows'  => true,
        ));

        // Extract unique years
        $years = array();
        foreach ($year_query->posts as $post_id) {
            $start_date = get_field('start_date', $post_id, false);
            $start_date = new DateTime($start_date);
            $years[] = $start_date->format('Y');
        }
        $years = array_unique($years);
        wp_reset_postdata();
        ?>

        <select id="exhibitionYearSelect" onchange="location = this.value;">
            <option value="<?php echo get_permalink(); ?>">Latest</option>
            <?php foreach ($years as $year) : ?>
                <option value="<?php echo get_permalink() . '?exhibition_year=' . $year; ?>"
                    <?php echo (isset($_GET['exhibition_year']) && $_GET['exhibition_year'] == $year) ? 'selected' : ''; ?>>
                    <?php echo $year; ?>
                </option>
            <?php endforeach; ?>
        </select>

</nav>

<section class="r">
    <?php
    $args = array(
        'post_type'      => 'exhibition',
        'meta_key'       => 'start_date',
        'orderby'        => 'meta_value',
        'order'          => 'DESC',
        'posts_per_page' => 20, // Default: Show the latest 20 exhibitions
    );

    // Check if a specific year is selected
    if (isset($_GET['exhibition_year'])) {
        $selected_year = $_GET['exhibition_year'];
        $args['meta_query'] = array(
            array(
                'key'     => 'start_date',
                'value'   => $selected_year . '-01-01',
                'compare' => '>=',
                'type'    => 'DATE',
            ),
            array(
                'key'     => 'start_date',
                'value'   => ($selected_year + 1) . '-01-01',
                'compare' => '<',
                'type'    => 'DATE',
            ),
        );
    }

    $exhibitions = new WP_Query($args);

    if ($exhibitions->have_posts()) :
        while ($exhibitions->have_posts()) : $exhibitions->the_post();
            get_template_part('partials/repeater-exhibition'); // Load the exhibition template
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No exhibitions found</p>';
    endif;
    ?>
</section>

<?php get_footer(); ?>
