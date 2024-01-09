<footer>
	<section class="footerInner">
		<a href="/index.php?page_id=70">Contact Us</a>
		<section class="buttonOuter">
			<button class="bookAnAppointment"><a href="https://www.instagram.com/coopercole/" target="_blank">Instagram</a></button>
		</section>

		<p class="copyright"><?php the_field('copyright_text', 'options'); ?></p>
		<section class="buttonOuter">
			<button class="mailing-list-open" alt="Opens Mailing List Subscription form">Mailing List</button>
		</section>
	</section>



	<form class="mailing-list" method="post" action="https://ymlp.com/subscribe.php?id=guqjmsegmgs" >
		<p class="closelistML">CLOSE</p>
	    <div class="containerML">
	        <input type="email" class="span3 mlist_email" placeholder="Enter Email Address" name="YMLP0">
	        <button type="submit" class="subscribe-to-mailing-list">Subscribe</button>
	        
	    </div>
	</form>

</footer>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-135534658-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-135534658-1');
</script>


<?php wp_footer(); ?>
</body>
</html>