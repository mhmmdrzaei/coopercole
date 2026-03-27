<?php get_header(); ?>
<div class="searchpageFooter">
<div class="main">
  <section class="noResults">
  	<figure>
  		<img src="<?php bloginfo('template_directory'); ?>/images/noresults.png" alt="Page not found illustration">
  	</figure>

  	<h1>Page Not Found</h1>
    <p>The page you requested could not be found. Try a search, or head to one of the main sections below.</p>
    <p><a href="/artists">Artists</a> / <a href="/exhibitions">Exhibitions</a> / <a href="/news">News</a> / <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></p>

  </section>
</div> <!-- /.main -->

<?php get_footer(); ?>
</div>
