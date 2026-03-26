<?php //template name: Artists ?>
<?php
get_header();

$artist_type = get_query_var( 'artist_type' );
if ( ! $artist_type ) {
	$artist_type = 'represented';
}

$args = array(
	'post_type'      => 'artist',
	'posts_per_page' => -1,
	'orderby'        => 'title',
	'order'          => 'asc',
	'artist_type'    => $artist_type,
);

$artists_query = new WP_Query( $args );

foreach ( $artists_query->posts as $artist_post ) {
	$parts = explode( ' ', $artist_post->post_title );
	$count = count( $parts );

	if ( 1 === $count ) {
		$artist_post->lastname = $parts[0];
	} elseif ( 2 === $count ) {
		$artist_post->lastname = $parts[1];
	} elseif ( 3 === $count ) {
		$artist_post->lastname = $parts[2];
	} elseif ( 4 === $count || 5 === $count ) {
		$artist_post->lastname = $parts[1];
	} else {
		$artist_post->lastname = $artist_post->post_title;
	}
}

usort( $artists_query->posts, 'cmp' );

$artist_items = array();

foreach ( $artists_query->posts as $artist_post ) {
	$thumbnail_id = get_post_thumbnail_id( $artist_post->ID );
	$artist_items[] = array(
		'id'    => $artist_post->ID,
		'title' => get_the_title( $artist_post->ID ),
		'url'   => get_permalink( $artist_post->ID ),
		'image' => $thumbnail_id ? get_the_post_thumbnail_url( $artist_post->ID, 'large' ) : '',
		'alt'   => $thumbnail_id ? coopercole_get_attachment_alt_text( $thumbnail_id, $artist_post->ID, 'artist' ) : get_the_title( $artist_post->ID ),
	);
}

$preview_artist = ! empty( $artist_items ) ? $artist_items[0] : null;
?>

<main class="artistsDirectory" data-view="grid">
	<header class="artistsDirectory__header">
		<h1 class="artistsDirectory__title"><?php the_title(); ?></h1>
		<div class="artistsDirectory__controls" aria-label="Artist view toggle">
			<button class="artistsDirectory__toggle is-active" type="button" data-view-target="grid">Grid</button>
			<button class="artistsDirectory__toggle" type="button" data-view-target="list">List</button>
		</div>
	</header>

	<section class="artistsDirectory__panel artistsDirectory__panel--grid is-active" data-view-panel="grid">
		<div class="artistsDirectory__grid">
			<?php foreach ( $artist_items as $artist_item ) : ?>
				<article class="artistsDirectory__card">
					<a class="artistsDirectory__cardLink" href="<?php echo esc_url( $artist_item['url'] ); ?>">
						<?php if ( $artist_item['image'] ) : ?>
							<img
								class="artistsDirectory__cardImage"
								src="<?php echo esc_url( $artist_item['image'] ); ?>"
								alt="<?php echo esc_attr( $artist_item['alt'] ); ?>"
							/>
						<?php endif; ?>
						<h2 class="artistsDirectory__cardTitle"><?php echo esc_html( $artist_item['title'] ); ?></h2>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="artistsDirectory__panel artistsDirectory__panel--list" data-view-panel="list" hidden>
		<div class="artistsDirectory__listLayout">
			<div class="artistsDirectory__listColumn">
				<ul class="artistsDirectory__list">
					<?php foreach ( $artist_items as $index => $artist_item ) : ?>
						<li class="artistsDirectory__listItem">
							<a
								class="artistsDirectory__listLink<?php echo 0 === $index ? ' is-active' : ''; ?>"
								href="<?php echo esc_url( $artist_item['url'] ); ?>"
								data-preview-title="<?php echo esc_attr( $artist_item['title'] ); ?>"
								data-preview-image="<?php echo esc_url( $artist_item['image'] ); ?>"
								data-preview-alt="<?php echo esc_attr( $artist_item['alt'] ); ?>"
							>
								<?php echo esc_html( $artist_item['title'] ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="artistsDirectory__preview" <?php echo empty( $preview_artist ) ? 'hidden' : ''; ?>>
				<?php if ( $preview_artist ) : ?>
					<div class="artistsDirectory__previewMedia">
						<?php if ( $preview_artist['image'] ) : ?>
							<img
								class="artistsDirectory__previewImage"
								src="<?php echo esc_url( $preview_artist['image'] ); ?>"
								alt="<?php echo esc_attr( $preview_artist['alt'] ); ?>"
								/>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const directory = document.querySelector(".artistsDirectory");
  if (!directory) return;

  const toggleButtons = directory.querySelectorAll("[data-view-target]");
  const panels = directory.querySelectorAll("[data-view-panel]");
  const listLinks = directory.querySelectorAll(".artistsDirectory__listLink");
  const preview = directory.querySelector(".artistsDirectory__preview");
  const previewImage = directory.querySelector(".artistsDirectory__previewImage");
  const previewTitle = directory.querySelector(".artistsDirectory__previewTitle");

  const setView = (view) => {
    directory.dataset.view = view;

    toggleButtons.forEach((button) => {
      button.classList.toggle("is-active", button.dataset.viewTarget === view);
    });

    panels.forEach((panel) => {
      const isActive = panel.dataset.viewPanel === view;
      panel.hidden = !isActive;
      panel.classList.toggle("is-active", isActive);
    });
  };

  const setPreview = (link) => {
    if (!preview || !previewImage) return;

    const image = link.dataset.previewImage || "";
    const alt = link.dataset.previewAlt || link.dataset.previewTitle || "";
    if (image) {
      previewImage.src = image;
      previewImage.alt = alt;
      preview.hidden = false;
    }

    listLinks.forEach((item) => item.classList.remove("is-active"));
    link.classList.add("is-active");
  };

  toggleButtons.forEach((button) => {
    button.addEventListener("click", () => {
      setView(button.dataset.viewTarget);
    });
  });

  listLinks.forEach((link) => {
    ["mouseenter", "focus", "touchstart"].forEach((eventName) => {
      link.addEventListener(eventName, () => setPreview(link), { passive: true });
    });
  });

  setView("grid");
});
</script>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
