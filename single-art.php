<?php get_header(); ?>
<main>

  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

    <?php $curr_id = get_the_id(); ?>
    <section class="singleArtFull">
      <section class="singleArtInfo">
      <p class="artworkInfoTitle">
      <?php echo the_title(); ?></p>
        <section class="connectedArtists">
          <?php

          $connected = new WP_Query( array(
            'connected_type' => 'art_to_artist',
            'connected_items' => get_the_id(),
            'nopaging' => true,
          ) );

          $artist_name = '';

          if ( $connected->have_posts() ) :

            while ( $connected->have_posts() ) : $connected->the_post();

            $artist_name = get_the_title();

          ?>


              <h2><a style="border:none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <?php

            endwhile;

            wp_reset_postdata();

          else:

            echo '<h2>'.get_field("artist_name", $curr_id).'</h2>';

          endif;

          ?>
          
        </section>
        <section class="connectedExhibition">
          <?php

          $connected = new WP_Query( array(
            'connected_type' => 'art_to_exhibition',
            'connected_items' => get_the_id(),
            'nopaging' => true,
          ) );

          $artist_name = '';

          if ( $connected->have_posts() ) :

            while ( $connected->have_posts() ) : $connected->the_post();

            $artist_name = get_the_title();

          ?>

              <p>Featured In:</p>
              <h2><a style="border:none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <?php

            endwhile;

            wp_reset_postdata();

          else:

            

          endif;

          ?>
          
        </section>
            <section class="artworkDetail">

              <?php if(get_field('year', $curr_id)) { echo get_field('year', $curr_id).'<br/>'; } ?>


              <?php

              if(get_field('media', $curr_id)) { echo get_field('media', $curr_id).'<br/>'; }

              if(get_field('edition', $curr_id)) { echo get_field('edition', $curr_id).'<br/>'; }

              if(get_field('notes', $curr_id)) { echo get_field('notes', $curr_id).'<br/>'; }




              ?>
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
          <input type="text" name="location" placeholder="location">
           <textarea name="note" placeholder="Additional Notes"></textarea>
          <input type="hidden" name="subject" value="Website Inquiry: <?php echo get_the_title($curr_id); ?>">
          <input type="text" name="message" value="" style="display:none;">
          <input type="hidden" name="inquiry_message" value="<?php echo htmlspecialchars($inquiry_email); ?>" style="display:none;">
          <input class="inquireSubmit" type="submit" value="inquire">
        </form>
      </section>
      <section class="singleArtImages">
           <?php if(have_rows('not_embedded_video')){
            while(have_rows('not_embedded_video')) {
            the_row(); ?>
            <video controls>
              <source src="<?php the_sub_field('video_file')?>" type="video/mp4" controls controlsList="nodownload">
              Your browser does not support the video tag. </video></div>
        <?php } }; ?>
        <?php


               if(have_rows('videos')){

                 while(have_rows('videos')) { the_row();

                   echo '<div class="wrap-video">';
                     the_sub_field('video');
                   echo '</div>';

                 }

               } else if(get_field('gallery')){

                 $gallery = get_field('gallery');

                 foreach($gallery as $image) {

                   echo '<img src="'.$image['sizes']['large'].'" />';

                 }

               } else {

                 the_post_thumbnail('large');

               }

               ?>
      </section>
    </section>
  </main>
    










  <?php endwhile; endif; ?>

<?php get_footer(); ?>
