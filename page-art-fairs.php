<?php //template name: Art Fairs ?>
<button id="myBtn" title="Go to top">&#x2963;</button>

<?php get_header(); ?>
<?php

$event_status = "past";

if (get_query_var('event_status')) {
    $event_status = get_query_var('event_status');
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Get the current page number

$args = array(
    'post_type' => 'art-fair',
    'meta_key' => 'start_date',
    'order' => 'DESC',
    'orderby' => array(
        'start_date' => 'DSC',
        'post_date' => 'desc'
    ),
    'posts_per_page' => 20,
    'paged' => $paged // Use the current page number
);

$query = new WP_Query($args);

if ($query->have_posts()) :
?>

<main>
    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php get_template_part('partials/repeater-artfairs'); ?>
    <?php endwhile; ?>
    <?php
    // Pagination
    echo '<section class="pageNav">';
    $big = 999999999; // need an unlikely integer
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, $paged),
        'total' => $query->max_num_pages,
        'prev_text' => __('←', 'textdomain'),
        'next_text' => __('→', 'textdomain'),
        'mid_size' => 2,
        'end_size' => 1,
        'prev_next' => true,
        'prev_next_before' => '<span class="prev-next">',
        'prev_next_after' => '</span>',
    ));
    echo '</section>';
    ?>

    <?php wp_reset_postdata(); ?>
</main>

<?php endif; ?>
<?php get_footer(); ?>
