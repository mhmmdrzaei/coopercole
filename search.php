<?php get_header(); ?>
<div class="homepageFooter">
<main class="searchResultsPage">
	<?php if ( have_posts() ) : ?>
		<header class="searchHeader">
			<h1>Search Results</h1>
			<p>Results for <strong>"<?php echo esc_html( get_search_query() ); ?>"</strong></p>
		</header>
		<?php get_template_part( 'loop', 'search' ); ?>
		<?php else : ?>
			<section class="noResults">
				<figure>
					<img src="<?php bloginfo('template_directory'); ?>/images/noresults.png" alt="No search results illustration">
				</figure>

				<h1>No Search Results Found</h1>
				<p>Try a different keyword, or browse one of the main sections below.</p>
				<?php get_search_form(); ?>
				<p><a href="/artists">Artists</a> / <a href="/exhibitions">Exhibitions</a> / <a href="/news">News</a></p>
			</section>
		<?php endif; ?>

</main>

<?php get_footer(); ?>
</div>
