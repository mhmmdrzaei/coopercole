<?php get_header(); ?>
<main>
  <section class="exhibitionMain" id="pageTop">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <section class="exhibitionSide" id="exhibtionSideScroll">
      <!-- <section class="exhibitionsideInnner"> -->
      <div class="outer">
        <a href="#pageTop">↑ Back to the Top</a>
        <section class="outerArtworks">
          <a href="#artworks">↓ Artworks</a>
        </section>
      </div>
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

          <li><h1><a class="arrow" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></li>

        <?php
        endwhile; wp_reset_postdata(); endif;

        echo '</ul>';

        ?>
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
      <div class="exhibtionArtists">
        <h2 class="exhibitionTitle"><?php the_title(); ?></h2>
        <aside class="exhibitionDateLoca">
          <?php
          $start_date = get_field('start_date', false, false);
          $start_date = new DateTime($start_date);

          if( get_field('end_date') ) {
            $end_date = get_field('end_date', false, false);
            $end_date = new DateTime($end_date);
          }
          ?>

          <h4><?php echo $start_date->format('F j'); if($end_date) { echo ' - '.$end_date->format('F j, Y'); } ?></h4>
          <h4><em><?php the_field('location'); ?></em></h4>
          <br>
          <h4><?php the_field('opening__closing_reception'); ?></h4>
        </aside>
      </div>
      


        
      <nav class="exhibtionNews">
              <?php
        $connected = new WP_Query( array(
          'connected_type' => 'post_to_exhibition',
          'connected_items' => get_the_id(),
          'posts_per_page' => -1
        ) );

        if($connected->have_posts()):

        ?>

        <button class="newsOpen">News</button>
        <div id="newsContentID">
        <ul class="newsContent">
          <?php while($connected->have_posts()) : $connected->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; ?>
          <div class="moreNewsOpen">
            
          </div>
        </ul>
        </div>
         <?php wp_reset_postdata(); endif; ?>
      </nav>
    <!-- </section> -->
    </section>
    <section class="exhibitionCenter">
      <section class="exhibitionContent text-area" data-controller="#readMore1">
        <?php the_content(); ?>
        
      </section>
      <button id="readMore1" class="btn btn-info">+ Read More</button> 
      <p class="artworksLink outerArtworks"><a href="#artworks">Artworks</a></p>
      <?php if( have_rows('additional_video_and_links') ): ?>
          <?php while( have_rows('additional_video_and_links') ): the_row(); ?>
              <?php if( get_row_layout() == 'add_video_additional' ): ?>
                <?php if( have_rows('video_additionalMediaContent') ): ?>
                <?php while( have_rows('video_additionalMediaContent') ): the_row(); 
                  $videoLink = get_sub_field('video_link_additionalMedia');
                  if( $videoLink ) {; ?>
                  <section class="featuredVideo">
                  <button class="featuredVideoTitle"><img src="<?php bloginfo('template_directory'); ?>/images/movie_icon.svg"> <?php the_sub_field('video_label_additionalMedia') ?></button> 
                  <div id="featuredVideoLink" class="video-responsive">
                    <?php the_sub_field('video_link_additionalMedia'); ?>
                  </div>
                  </section>
                  <?php } ?> 
                <?php endwhile; ?>
                 <?php endif; ?>   
              <?php elseif( get_row_layout() == 'add_link_additional' ): ?>
                  <?php if( have_rows('outwardLink_additionalMediaContent') ): ?>
                  <?php while( have_rows('outwardLink_additionalMediaContent') ): the_row(); 
                    $onlineLink = get_sub_field('link_label_additionalMedia');
                    if( $onlineLink ) {; ?>
                    <section class="onlineExhibition">
                      <a href="<?php the_sub_field('actual_link_additionalMedia'); ?>" target="_blank"><?php the_sub_field('link_label_additionalMedia'); ?> <i class="fas fa-external-link-alt"></i></a>
                    </section>
                    <?php } ?> 
                  <?php endwhile; ?>
                   <?php endif; ?>  

              <?php endif; ?>
          <?php endwhile; ?>
      <?php endif; ?>


       

      <?php if(get_field('carousel')): ?>
      <section class="exhibitionImages">

          <?php
            $slides = get_field('carousel');
            $slide_amount = count($slides);
            foreach($slides as $slide):

            ?>

            <img class="exhibitionImgsLL" src="<?php echo $slide['url']; ?>" alt="" id="<?php echo $slide['id'];?>"/>

            <?php endforeach; ?>
            
      </section>
        <?php endif; ?>
         <?php if(have_rows('not_embedded_video')){
          while(have_rows('not_embedded_video')) {
          the_row(); ?>
          <video controls>
            <source src="<?php the_sub_field('video_file')?>" type="video/mp4" controls controlsList="nodownload">
            Your browser does not support the video tag. </video>
      <?php } }; ?>
    </section>

  </section>
  
    <?php

    $connected = new WP_Query( array(
      'connected_type' => 'art_to_exhibition',
      'connected_items' => get_the_id(),
      'nopaging' => true,
    ) );

    if ( $connected->have_posts() ) :

      echo '<section class="artworksMain">
    <h3 id="artworks">Artworks</h3>
    <section class="artworksOld" id="artworksPages">';

      while($connected->have_posts() ) : $connected->the_post(); ?>
        <div class="artworkItemEach" >
          <section class="toggleText">
            <figure>
              <?php echo get_the_post_thumbnail( get_the_id(), 'large' ); ?>
            </figure>
           
              <?php
              $title = get_the_title(); // This must be!, because this is the return - the_title would be echo
              $title_array = explode('&#8211;', $title);
              $first_word = $title_array[0];
              $second_word = $title_array[1];

              ?>
              <section class="titleToggle">
                <p class="toggleTextTitle"><?php echo $first_word; ?></p>
                <div class="line"></div>
                <p class="toggleTextWork"><?php echo $second_word; ?></p>
              </section>
              <section class="infoAnimated">
                   
                  <div>I</div>
                  <div>n</div>
                  <div>q</div>
                  <div>u</div>
                  <div>i</div>
                  <div>r</div>
                  <div>i</div>
                  <div>e</div>
                  <div>s</div>
                  <div>→</div>
              </section> 
          </section>
          <section class="artworkIteminfo" id="artworksOpenItem">
            <section class="closeInfo">
              Close
            </section>
            <section class="prevnext">
              <a href="#" class="previous">Previous</a> <span>/</span> <a href="#" class="next">Next</a>
            </section>
            <section class="artworkItemInfoInnner">
              <div class="galleryContainer">
              <?php if(have_rows('not_embedded_video')){
                    while(have_rows('not_embedded_video')) {
                    the_row(); ?>
                    <video controls>
                      <source src="<?php the_sub_field('video_file')?>" type="video/mp4" controls controlsList="nodownload">
                      Your browser does not support the video tag. </video>
                <?php } }; ?>

               <?php if(have_rows('videos')){
                  while(have_rows('videos')) { the_row();
                      echo '<div class="wrap-video">';
                          the_sub_field('video');
                      echo '</div>';

                      }
                  } 
                   else if(get_field('gallery')){

                    $gallery = get_field('gallery');
                      // echo '<div class="galleryContainer">';
                
                      foreach($gallery as $image) {

                        echo '<img class="" src="'.$image['sizes']['large'].'" />';

                        }
                        // echo' </div>';
                    }

                    else {  
                        the_post_thumbnail('large');
                      }

                    ?>
                    </div>
            
            <section class="artworkItemInfoText">
              <div class="artworkInfoTextFixed">
              <p class="artworkInfoTitle"><?php echo get_field('title', $curr_id); ?><?php if(get_field('year', $curr_id)) { echo ', '.get_field('year', $curr_id).''; } ?></p>
                <?php if(get_field('media', $curr_id)) { echo'<p>' .get_field('media', $curr_id).' </p>'; } ?>
              <?php 
                if(get_field('edition', $curr_id)) { echo '<p>'.get_field('edition', $curr_id).' </p>'; }
               ?>
                 <?php if(get_field('notes', $curr_id)) { echo '<p>'.get_field('notes', $curr_id).' </p>'; }
                  ?>
                 <?php if(get_field('inventory', $curr_id)) { echo '<p>'.get_field('inventory', $curr_id).' </p>'; }
                  ?>
               

               <section class="dimentions">
                       <?php 
                       $height = get_field('height', $curr_id);
                       $width = get_field('width', $curr_id);
                       $depth = get_field('depth', $curr_id);
                       $height_metric = convert_to_cm($height);
                        $width_metric = convert_to_cm($width);
                        $depth_metric = convert_to_cm($depth);

                        if($depth) {

                           echo $height . '" X ' . $width . '" X ' . $depth .'"<br/>';

                           echo $height_metric . 'cm X ' . $width_metric .'cm X ' . $depth_metric .'cm<br/>';
                         } else if ( $height && $width) {

                           echo $height . '" X ' . $width .'"<br/>';
                          echo $height_metric . 'cm X ' . $width_metric .'cm<br/>';

                         } else {
                          
                         }




                        ?>
               </section>

             </div>
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

               

               <form id="submit-inquiry" class="inquireFormFull">
                 <input type="text" name="name" placeholder="name">
                 <input type="email" name="email" placeholder="email">
                 <input type="text" name="phone" placeholder="phone">
                 <input type="text" name="location" placeholder="location">
                 <textarea name="note" placeholder="Additional Notes"></textarea>
                 <input type="hidden" name="subject" value="Website Inquiry: <?php echo get_the_title($curr_id); ?>">
                 <input type="text" name="message" value="" style="display:none;">
                 <input type="hidden" name="inquiry_message" value="<?php echo htmlspecialchars($inquiry_email); ?>" style="display:none;">
                 <input class="inquireSubmit" type="submit" value="inquire">
               </form>
             </section>
            </section>
                  

   
                </section>
              </section>
          </div>
        

      <?php endwhile; 
        echo '</section>';
      wp_reset_postdata(); endif; ?>


        <?php endwhile; endif; ?>
  </section>
</main>


<?php get_footer(); ?>