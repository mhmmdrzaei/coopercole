<?php get_header(); ?>
<main>
  <section class="exhibitionMain">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <section class="exhibitionSide">
      <div class="exhibtionArtists">
            <?php
        $connected_artists = new WP_Query( array(
          'connected_type' => 'exhibition_to_artist',
          'connected_items' => get_the_id(),
          'nopaging' => true
        ) );

        foreach($connected_artists->posts as $p) {
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

        usort($connected_artists->posts, 'cmp');

        echo '<ul class="exhibitors">';

        if($connected_artists->have_posts()): while($connected_artists->have_posts()) : $connected_artists->the_post(); ?>

          <li><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>

        <?php
        endwhile; wp_reset_postdata(); endif;

        echo '</ul>';

        ?>
      </div>
      <h2><?php the_title(); ?></h2>
      <aside class="exhibitionDate">
        <?php
        $start_date = get_field('start_date', false, false);
        $start_date = new DateTime($start_date);

        if( get_field('end_date') ) {
          $end_date = get_field('end_date', false, false);
          $end_date = new DateTime($end_date);
        }
        ?>

        <h4><?php echo $start_date->format('F j'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></h4>
      </aside>
      <nav class="exhibtionNews">
              <?php
        $connected = new WP_Query( array(
          'connected_type' => 'post_to_exhibition',
          'connected_items' => get_the_id(),
          'posts_per_page' => -1
        ) );

        if($connected->have_posts()):

        ?>

        <h4 class="newsOpen">News</h4>
        <ul class="newsContent">
          <?php while($connected->have_posts()) : $connected->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; ?>
        </ul>
         <?php wp_reset_postdata(); endif; ?>
      </nav>
    </section>
    <section class="exhibitionCenter">
      <section class="exhibitionContent text-area" data-controller="#readMore1">
        <?php the_content(); ?>
        
      </section>
      <a id="readMore1" class="btn btn-info">Read more</a> 
      <?php if(get_field('carousel')): ?>
      <section class="exhibitionImages">
          <?php
            $slides = get_field('carousel');
            $slide_amount = count($slides);
            foreach($slides as $slide):

            ?>

            <img src="<?php echo $slide['sizes']['large']; ?>" alt="" id="<?php echo $slide['id'];?>"/>

            <?php endforeach; ?>
      </section>
        <?php endif; ?>
      
    </section>

  </section>
  <section class="artworksMain">
    <h3 id="Artworks">Artworks</h3>
    <?php

    $connected = new WP_Query( array(
      'connected_type' => 'art_to_exhibition',
      'connected_items' => get_the_id(),
      'nopaging' => true,
    ) );

    if ( $connected->have_posts() ) :

      echo '<section class="artworksOld">';

      while($connected->have_posts() ) : $connected->the_post(); ?>

        <div class="artworkItemEach">
          <a href="<?php the_permalink(); ?>" class="" data-id="<?php echo get_the_id(); ?>">
            <?php the_title ();?>
            <?php echo get_the_post_thumbnail( get_the_id(), 'large' ); ?>
          </a>
          <section class="artworkIteminfo">
                  <?php echo get_field('title', $curr_id); ?><?php if(get_field('year', $curr_id)) { echo ', '.get_field('year', $curr_id).'<br/>'; } ?>


                  <?php

                  if(get_field('media', $curr_id)) { echo get_field('media', $curr_id).'<br/>'; }

                  if(get_field('edition', $curr_id)) { echo get_field('edition', $curr_id).'<br/>'; }

                  if(get_field('notes', $curr_id)) { echo get_field('notes', $curr_id).'<br/>'; }




                  ?>
                  <?php 
                  $height = get_field('height', $curr_id);
                  $width = get_field('width', $curr_id);
                  $depth = get_field('depth', $curr_id);

                  if( $height && $width) {

                    $height_metric = convert_to_cm($height);
                    $width_metric = convert_to_cm($width);
            }
                    if($depth) {
                      $depth_metric = convert_to_cm($depth);
                      echo $height . '" X ' . $width . '" X ' . $depth .'"<br/>';

                      echo $height_metric . 'cm X ' . $width_metric .'cm X ' . $depth_metric .'cm<br/>';
                    }

                    else {
                      echo $height . 'in X ' . $width . 'in<br/>';

                      echo $height_metric . 'cm X ' . $width_metric . 'cm<br/>';
                    }




                   ?>
                </section>
                <section class="inquiry">
                  <?php

                  $inquiry_email  = '';
                  $inquiry_email .= '<p>Thanks for inquiring. We will be in touch shortly with more information.</p>';
                  $inquiry_email .= '<p>For a quicker response feel free to call us at +1.416.531.8000.</p>';
                  $inquiry_email .= get_the_post_thumbnail( $curr_id, 'medium' );
                  $inquiry_email .= '<p>';
                  $inquiry_email .= $artist_name.'<br/>';
                  $inquiry_email .= get_field('title', $curr_id).', '.get_field('year', $curr_id).'<br/>';
                  if(get_field('media', $curr_id)) {
                    $inquiry_email .= get_field('media', $curr_id).'<br/>';
                  }
                  if(
                    get_field('edition', $curr_id)) {$inquiry_email .= get_field('edition', $curr_id).'<br/>';
                  }
                  if( $height && $width) {
                    if($depth) {
                      $inquiry_email .= $height . '" X ' . $width .'" X ' . $depth.'"<br/>';
                      $inquiry_email .= 'cm X ' . $width_metric .'cm X ' . $depth_metric .'cm<br/>';
                    }
                    else {
                      $inquiry_email .= $height . '" X ' . $width . '"<br/>';
                      $inquiry_email .= $height_metric . 'cm X ' . $width_metric . 'cm<br/>';
                    }
                  }
                  $inquiry_email .= 'Website Link: <a href="'.get_permalink( $curr_id ).'">'.get_the_title($curr_id).'</a>';
                  $inquiry_email .= '</p>';

                  ?>

                  <form id="submit-inquiry" class="no-smoothState">
                    <input type="text" name="name" placeholder="name">
                    <input type="email" name="email" placeholder="email">
                    <input type="text" name="phone" placeholder="phone">
                    <input type="hidden" name="subject" value="Website Inquiry: <?php echo get_the_title($curr_id); ?>">
                    <input type="text" name="message" value="" style="display:none;">
                    <input type="hidden" name="inquiry_message" value="<?php echo htmlspecialchars($inquiry_email); ?>" style="display:none;">
                    <input type="submit" value="inquire">
                  </form>
                </section>
                 <?php if(have_rows('videos')){
                    while(have_rows('videos')) { the_row();
                        echo '<div class="wrap-video">';
                            the_sub_field('video');
                        echo '</div>';

                        }
                    } 
                     else if(get_field('gallery')){

                      $gallery = get_field('gallery');
                        echo '<div class="swiper-container">';
                        echo '<div class="swiper-wrapper">';

                        foreach($gallery as $image) {

                          echo '<img class="swiper-slide" src="'.$image['sizes']['large'].'" />';

                          }
                          echo' </div>';
                          echo'<div class="swiper-button-next"></div>
                          <div class="swiper-button-prev"></div>
                          </div>';
                      }

                      else {  
                          the_post_thumbnail('large');
                        }

                      ?>
          </div>
        

      <?php endwhile; 
        echo '</section>';
      wp_reset_postdata(); endif; ?>
        <?php
      $featured_posts = get_field('connected_art_1');
      if( $featured_posts ): 
        echo '<section class="artworksNew">';
        ?>
          
          <?php foreach( $featured_posts as $post ): 

              // Setup this post for WP functions (variable must be named $post).
              setup_postdata($post); ?>
              <div class="artworkItemEach">
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                  <?php the_post_thumbnail('large'); ?>
                </a>
                <section class="artworkIteminfo">
                        <?php echo get_field('title', $curr_id); ?><?php if(get_field('year', $curr_id)) { echo ', '.get_field('year', $curr_id).'<br/>'; } ?>


                        <?php

                        if(get_field('media', $curr_id)) { echo get_field('media', $curr_id).'<br/>'; }

                        if(get_field('edition', $curr_id)) { echo get_field('edition', $curr_id).'<br/>'; }

                        if(get_field('notes', $curr_id)) { echo get_field('notes', $curr_id).'<br/>'; }




                        ?>
                        <?php 
                        $height = get_field('height', $curr_id);
                        $width = get_field('width', $curr_id);
                        $depth = get_field('depth', $curr_id);

                        if( $height && $width) {

                          $height_metric = convert_to_cm($height);
                          $width_metric = convert_to_cm($width);
                  }
                          if($depth) {
                            $depth_metric = convert_to_cm($depth);
                            echo $height . '" X ' . $width . '" X ' . $depth .'"<br/>';

                            echo $height_metric . 'cm X ' . $width_metric .'cm X ' . $depth_metric .'cm<br/>';
                          }

                          else {
                            echo $height . 'in X ' . $width . 'in<br/>';

                            echo $height_metric . 'cm X ' . $width_metric . 'cm<br/>';
                          }




                         ?>
                      </section>
                      <section class="inquiry">
                        <?php

                        $inquiry_email  = '';
                        $inquiry_email .= '<p>Thanks for inquiring. We will be in touch shortly with more information.</p>';
                        $inquiry_email .= '<p>For a quicker response feel free to call us at +1.416.531.8000.</p>';
                        $inquiry_email .= get_the_post_thumbnail( $curr_id, 'medium' );
                        $inquiry_email .= '<p>';
                        $inquiry_email .= $artist_name.'<br/>';
                        $inquiry_email .= get_field('title', $curr_id).', '.get_field('year', $curr_id).'<br/>';
                        if(get_field('media', $curr_id)) {
                          $inquiry_email .= get_field('media', $curr_id).'<br/>';
                        }
                        if(
                          get_field('edition', $curr_id)) {$inquiry_email .= get_field('edition', $curr_id).'<br/>';
                        }
                        if( $height && $width) {
                          if($depth) {
                            $inquiry_email .= $height . '" X ' . $width .'" X ' . $depth.'"<br/>';
                            $inquiry_email .= 'cm X ' . $width_metric .'cm X ' . $depth_metric .'cm<br/>';
                          }
                          else {
                            $inquiry_email .= $height . '" X ' . $width . '"<br/>';
                            $inquiry_email .= $height_metric . 'cm X ' . $width_metric . 'cm<br/>';
                          }
                        }
                        $inquiry_email .= 'Website Link: <a href="'.get_permalink( $curr_id ).'">'.get_the_title($curr_id).'</a>';
                        $inquiry_email .= '</p>';

                        ?>

                        <form id="submit-inquiry" class="no-smoothState">
                          <input type="text" name="name" placeholder="name">
                          <input type="email" name="email" placeholder="email">
                          <input type="text" name="phone" placeholder="phone">
                          <input type="hidden" name="subject" value="Website Inquiry: <?php echo get_the_title($curr_id); ?>">
                          <input type="text" name="message" value="" style="display:none;">
                          <input type="hidden" name="inquiry_message" value="<?php echo htmlspecialchars($inquiry_email); ?>" style="display:none;">
                          <input type="submit" value="inquire">
                        </form>
                      </section>
                       <?php if(have_rows('videos')){
                          while(have_rows('videos')) { the_row();
                              echo '<div class="wrap-video">';
                                  the_sub_field('video');
                              echo '</div>';

                              }
                          } 
                           else if(get_field('gallery')){

                            $gallery = get_field('gallery');
                              echo '<div class="swiper-container">';
                              echo '<div class="swiper-wrapper">';

                              foreach($gallery as $image) {

                                echo '<img class="swiper-slide" src="'.$image['sizes']['large'].'" />';

                                }
                                echo' </div>';
                                echo'<div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                </div>';
                            }

                            else {  
                                the_post_thumbnail('large');
                              }

                            ?>
                     
              </div>
          <?php endforeach; ?>
          
          <?php 
          echo '</section>';
          // Reset the global post object so that the rest of the page works correctly.
          wp_reset_postdata(); ?>
      <?php endif; ?>


        <?php endwhile; endif; ?>
  </section>
</main>


<?php get_footer(); ?>