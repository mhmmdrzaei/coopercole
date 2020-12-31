<footer>
	<div class="addressFooter">
		<p><?php the_field('gallery_address_footer', 'options'); ?></p>
	</div>
	
	<nav class="Footermenu">
		
		<?php wp_nav_menu( array(
		  'container' => false,
		  'theme_location' => 'footer_menu'
		)); ?>
		<button class="mailing-list-open" alt="Opens Mailing List Subscription form">Mailing List</button>
	</nav>


	<p class="copyright"><?php the_field('copyright_text', 'options'); ?></p>
	<form class="mailing-list" method="post" action="http://www.ymlp.com/subscribe.php?ymlpid=guqjmseg" >
		<p class="closelistML">x</p>
	    <div class="containerML">
	        <input type="email" class="span3 mlist_email" placeholder="Enter Email Address" name="YMLP0">
	        <button type="submit" class="subscribe-to-mailing-list">Subscribe</button>
	        
	    </div>
	</form>

</footer>

<script>
// scripts.js, plugins.js and jquery are enqueued in functions.php
/* Google Analytics! */
 var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]]; // Change UA-XXXXX-X to be your site's ID
 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
 g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
 s.parentNode.insertBefore(g,s)}(document,"script"));
</script>

<?php wp_footer(); ?>
</body>
</html>