<?php //template name: News ?>
<?php get_header(); ?>
<button id="myBtn" title="Go to top">&#x2963;</button>

<main>

    <section class="news">

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'order' => 'DCS',
            'posts_per_page' => 10, // Adjust the number of posts per page as needed
            'paged' => $paged
        );
        query_posts($args);

        while (have_posts()) : the_post();
        ?>
            <article class="post">

                <?php
                $videoLink = get_field('video_link_newsPage');
                $featuredImage = get_the_post_thumbnail();

                if ($videoLink) :
                ?>
                <section class="newsMainBody">
                        <figure class="newsPostImage">
                            <?php the_post_thumbnail('large'); ?>
                        </figure>
                        <section class="newsDetails withFI">
                            <section class="newsTitle withFITitle">
                                <a href="<?php the_permalink(); ?>"><h1 class="title"><?php the_title(); ?></h1></a>
                                <aside class="date"><?php the_time('F j, Y'); ?></aside>
                            </section>
                            <section class="newsExcerpt">
                                <?php the_excerpt(); ?>
                            </section>
                            <?php coopercole_tags(); ?>
                        </section>
                        
                  </section>
                  <section class="featuredVideo">
                        <div class="video-responsive">
                            <?php the_field('video_link_newsPage') ?>
                        </div>
                    </section>

                <?php elseif ($featuredImage) : ?>
                    <section class="newsMainBody">
                        <figure class="newsPostImage">
                            <?php the_post_thumbnail('large'); ?>
                        </figure>
                        <section class="newsDetails withFI">
                            <section class="newsTitle withFITitle">
                                <a href="<?php the_permalink(); ?>"><h1 class="title"><?php the_title(); ?></h1></a>
                                <aside class="date"><?php the_time('F j, Y'); ?></aside>
                            </section>
                            <section class="newsExcerpt">
                                <?php the_excerpt(); ?>
                            </section>
                            <?php coopercole_tags(); ?>
                        </section>
                    </section>
                <?php else : ?>
                    <section class="newsTitle">
                        <a href="<?php the_permalink(); ?>"><h1 class="title"><?php the_title(); ?></h1></a>
                        <aside class="date"><?php the_time('F j, Y'); ?></aside>
                    </section>
                    <section class="newsDetails">
                        <section class="newsExcerpt">
                            <?php the_excerpt(); ?>
                        </section>
                        <?php coopercole_tags(); ?>
                    </section>
                <?php endif; ?>

            </article>
        <?php
        endwhile;
        ?>

        <?php
        echo '<section class="pageNav">';
        $big = 999999999; // need an unlikely integer
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, $paged),
            'total' => $wp_query->max_num_pages,
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

        <?php
        wp_reset_query();
        ?>

    </section>

</main>

<?php get_footer(); ?>
