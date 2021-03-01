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
      <button id="readMore1" class="btn btn-info">Read more</button> 
      <p class="artworksLink outerArtworks"><a href="#artworks">Artworks</a></p>
        <?php if( have_rows('online_exhibition_link') ): ?>
        <?php while( have_rows('online_exhibition_link') ): the_row(); 
          $onlineLink = get_sub_field('link_label');
          if( $onlineLink ) {; ?>
          <section class="onlineExhibition">
            <a href="<?php the_sub_field('link_address'); ?>"><?php the_sub_field('link_label'); ?> <i class="fas fa-external-link-alt"></i></a>
          </section>
          <?php } ?> 
        <?php endwhile; ?>
         <?php endif; ?>  
      
           <?php if( have_rows('related_featured_video') ): ?>
           <?php while( have_rows('related_featured_video') ): the_row(); 
             $videoLink = get_sub_field('video_link');
             if( $videoLink ) {; ?>
             <section class="featuredVideo">
             <button class="featuredVideoTitle"><img src="<?php bloginfo('template_directory'); ?>/images/movie_icon.svg"> <?php the_sub_field('video_text') ?></button> 
             <div id="featuredVideoLink" class="video-responsive">
               <?php the_sub_field('video_link'); ?>
             </div>
             </section>
             <?php } ?> 
           <?php endwhile; ?>
            <?php endif; ?>   
       

      <?php if(get_field('carousel')): ?>
      <section class="exhibitionImages">
          <?php
            $slides = get_field('carousel');
            $slide_amount = count($slides);
            foreach($slides as $slide):

            ?>

            <img class="exhibitionImgsLL" src="<?php echo $slide['sizes']['large']; ?>" alt="" id="<?php echo $slide['id'];?>"/>

            <?php endforeach; ?>
      </section>
        <?php endif; ?>
      
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
              <?php echo get_the_post_thumbnail( get_the_id(), 'medium' ); ?>
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
<!--                 <div>I</div>
                  <div>n</div>
                  <div>f</div>
                  <div>o</div>
                  <div>r</div>
                  <div>m</div>
                  <div>a</div>
                  <div>t</div>
                  <div>i</div>
                  <div>o</div>
                  <div>n</div>
                                    
                  <div>&</div> -->
                   
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
            <section class="artworkItemInfoInnner">
            <section class="artworkItemInfoText">
              <div class="artworkInfoTextFixed">
              <p class="artworkInfoTitle"><?php echo get_field('title', $curr_id); ?><?php if(get_field('year', $curr_id)) { echo ', '.get_field('year', $curr_id).''; } ?></p>
              <p>
                <?php if(get_field('media', $curr_id)) { echo get_field('media', $curr_id).''; } ?>
              </p>
              <p><?php 
                if(get_field('edition', $curr_id)) { echo get_field('edition', $curr_id).''; }
               ?></p>
               <p>
                 <?php if(get_field('notes', $curr_id)) { echo get_field('notes', $curr_id).''; }
                  ?>
               </p>
               <p>
                 <?php if(get_field('inventory', $curr_id)) { echo get_field('inventory', $curr_id).''; }
                  ?>
               </p>

               <section class="dimentions">
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

                 

                 <form id="submit-inquiry" class="inquireFormFull">
                   <input type="text" name="name" placeholder="name">
                   <input type="email" name="email" placeholder="email">
                   <input type="text" name="phone" placeholder="phone">
                   <input type="hidden" name="subject" value="Website Inquiry: <?php echo get_the_title($curr_id); ?>">
                   <input type="text" name="message" value="" style="display:none;">
                   <input type="hidden" name="inquiry_message" value="<?php echo htmlspecialchars($inquiry_email); ?>" style="display:none;">
                   <input class="inquireSubmit" type="submit" value="inquire">
                 </form>
               </section>
             </div>
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
                        echo '<div class="galleryContainer">';
                  
                        foreach($gallery as $image) {

                          echo '<img class="" src="'.$image['sizes']['large'].'" />';

                          }
                          echo' </div>';
                      }

                      else {  
                          the_post_thumbnail('large');
                        }

                      ?>
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