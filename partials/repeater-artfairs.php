<?php
$event_status = "past";

if (get_query_var('event_status')) {
    $event_status = get_query_var('event_status');
}

$start_date = get_field('start_date', false, false);
$start_date = new DateTime($start_date);

if (get_field('end_date')) {
    $end_date = get_field('end_date', false, false);
    $end_date = new DateTime($end_date);
}
?>

<?php
$titleArtFair = get_the_title();
$artFairLocation = get_field('location');
?>

<article class="artFairEach">
<figure>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
                </figure>
	      	
              <div class="description">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="date"><?php echo $start_date->format('F j, Y'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></div>
                    <div class="location"><?php the_field('location'); ?></div>
                    <?php if( have_rows('artist_with_no_artist_page') ): ?>
                        <ul class="nonRepArtists">
                        <?php while( have_rows('artist_with_no_artist_page') ): the_row(); 
                            ?>
                            <li>
                                <?php the_sub_field('artist_name_noArtistPage'); ?>
                            </li>
                        <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <?php

                        $connected = new WP_Query( array(
                          'connected_type' => 'art_fair_to_artist',
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
                            echo '<ul>';

                            while ( $connected->have_posts() ) : $connected->the_post();
                                echo '<li>';

                                if(get_the_content() !== '') {
                                    echo '<a href="'.get_permalink( get_the_id() ).'">';
                                }

                                echo get_the_title(get_the_id());

                                if(get_the_content() !== '') {
                                    echo '</a>';
                                }

                                echo '</li>';

                            endwhile;

                            echo '</ul>';

                            

                        endif;
                        wp_reset_query($connected);
                        

                    ?>
                </div>
        </article>