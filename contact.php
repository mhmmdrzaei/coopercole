<?php //template name: Contact ?>
<?php get_header(); ?>

<main class="contactMain">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <section class="aboutContactContainer">
        <div class="contact_address">
            <aside>
                <a class="addressMap" href="#map" class="contactMapLink">
                    <?php the_field('gallery_address_footer','options') ?>
                </a>

            </aside>



        </div>
        <div class="contact_hours">
            <aside>
                <?php the_field('hours'); ?>
            </aside>
        </div>
        <div class="contact_contact">
            <aside>
                <a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a>

            </aside>
            <aside>
                <a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a>
            </aside>
        </div>
        <section class="Mailinglist ">
            <figure class="cc_contactImg">
                <img src="https://coopercolegallery.com/wp-content/themes/coopercole2020-Deploy/images/cc_Rainbow.svg"
                    alt="cooper cole abriviated CC logo in rainbow colors">
            </figure>

            <figure class="mailing-list-img" alt="sign up for our mailing list button">
                <?php require('images/mailing_list.svg');?>
            </figure>
            <figure class="rainbowimg"><img
                    src="https://coopercolegallery.com/wp-content/themes/coopercole2020-Deploy/images/rainbow.svg" />
            </figure>

        </section>
    </section>
    <div class="line"></div>

    <section class="aboutAdditional">
        <section class="galleryAdditionalInfo">
            <?php if( have_rows('flexible_additional_info') ): ?>
            <?php while( have_rows('flexible_additional_info') ): the_row(); ?>
            <?php if( get_row_layout() == 'link_dynamic_info_option' ): ?>
            <?php if( have_rows('link_dynamic_info') ): ?>
            <?php while( have_rows('link_dynamic_info') ): the_row(); 

			    	        ?>
            <a href="<?php the_sub_field('link_url_additional1'); ?>"
                class="<?php the_sub_field('link_style_additional1'); ?>"
                target="<?php the_sub_field('link_target_addional1'); ?>"><?php the_sub_field('link_label_additional1'); ?></a>

            <?php endwhile; ?>
            <?php endif; ?>


            <?php elseif( get_row_layout() == 'full_length_pargraph_option' ):

			            ?>
            <div class="paragraphFull">
                <?php the_sub_field('full_length_paragraph') ?>
            </div>


            <?php elseif( get_row_layout() == 'half_length_paragraph_option' ): 
			            ?>
            <div class="paragraphHalf">
                <?php the_sub_field('half_length_paragraph') ?>
            </div>

            <?php elseif( get_row_layout() == 'paragraph_header_option' ): 
			            ?>
            <?php if( have_rows('page_header_additional_info') ): ?>
            <?php while( have_rows('page_header_additional_info') ): the_row(); 

			                    ?>
            <<?php the_sub_field('header_level_header_title'); ?>>
                <?php the_sub_field('text_header_title'); ?>
            </<?php the_sub_field('header_level_header_title'); ?>>

            <?php endwhile; ?>
            <?php endif; ?>
            <?php elseif( get_row_layout() == 'dividing_line_Option' ): 
			            ?>
            <div class="line"></div>

            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>

        </section>



        <div class="acf-map-new" id="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2886.0038500065116!2d-79.44066602358289!3d43.66888975141553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b34f93e03f037%3A0xeaeab1674ab89658!2sCOOPER%20COLE!5e0!3m2!1sen!2sca!4v1707405042663!5m2!1sen!2sca&amp;markers=color:blue%7Clabel:A%7C43.66888975141553,-79.44066602358289"
                height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>



    </section>

</main>



<?php endwhile; endif; ?>

<?php get_footer(); ?>