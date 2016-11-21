<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<div style="margin:0 auto;text-align:center">
				<?php echo smlsubform(); ?>
			</div>

			<div style="text-align:center">
				<a target ="_blank" href="https://www.facebook.com/balzanfc/timeline"><img src="<?php echo get_site_url(); ?>/wp-content/uploads/social-facebook.jpg" /></a>
				<!--<img src="<?php echo get_site_url(); ?>/wp-content/uploads/social-twitter.jpg" />
				<img src="<?php echo get_site_url(); ?>/wp-content/uploads/social-google-plus.jpg" />-->
			</div>
			<div style="margin:0 auto; width:100%;text-align:center" id="footer-ads">
				<!--<img src="<?php echo get_site_url(); ?>/wp-content/uploads/Dove.jpg" width="250px"/>-->
				<!--
				<a href="#" target="_blank">
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2016/01/logo4.jpg" width="250px"/>
				</a>
				<a href="http://www.iml.com.au/IML/main/index.php" target="_blank">
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2016/01/logo1.png" width="250px"/>
				</a>
				<a href="http://www.hayatsu.com.tr/aboutus.html" target="_blank">
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2016/01/logo3.png" width="250px"/>
				</a>
				<a href="https://www3.bet90.com/en/" target="_blank">
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2016/04/bet90.png" width="250px"/>
				</a>-->
			</div>
			<table style="width:100%">
				<tr>
					<td>
						<h2>Club</h2>
					</td>
					<td>
						<h2>Team</h2>
					</td>
					<td>
						<h2>Fixtures & Results</h2>
					</td>
					<td>
						<h2>Academy</h2>
					</td>
					<td>
						<h2>News</h2>
					</td>
					<td>
						<h2>Contact</h2>
					</td>
				</tr>
				<tr>
					<td><a href="<?php echo get_site_url(); ?>/club/about-us">About us</a></td>
					<td><a href="<?php echo get_site_url(); ?>/team/senior-squad">Seniors</a></td>
					<td><a href="<?php echo get_site_url(); ?>/fixtures-results/fixtures">Fixtures</a></td>
					<td><a href="<?php echo get_site_url(); ?>/academy/about-us">About us</a></td>
					<td><a href="<?php echo get_site_url(); ?>/news">Latest News</a></td>
					<td><a href="<?php echo get_site_url(); ?>/contact-us/#Website">Website</a></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="<?php echo get_site_url(); ?>/team/technical">Technical</a></td>
					<td><a href="<?php echo get_site_url(); ?>/fixtures-results/results">Results</a></td>
					<td><a href="<?php echo get_site_url(); ?>/academy/administration">Administration</a></td>
					<td></td>
					<td><a href="<?php echo get_site_url(); ?>/contact-us/#Administration">Administration</a></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="<?php echo get_site_url(); ?>/team/under-19s">Under 19's</a></td>
					<td><a href="<?php echo get_site_url(); ?>/fixtures-results/league-standings">League Standings</a></td>
					<td><a href="<?php echo get_site_url(); ?>/academy/gallery">Gallery</a></td>
					<td></td>
					<td><a href="<?php echo get_site_url(); ?>/contact-us/#Technical">Technical Team</a></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td> </td>
					<td><a href="<?php echo get_site_url(); ?>/academy/contact">Contact</a></td>
					<td></td>
					<td><a href="<?php echo get_site_url(); ?>/contact-us/#Academy">Academy</a></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td> </td>
					<td></td>
					<td></td>
					<td><a href="<?php echo get_site_url(); ?>/contact-us/#PR">PR & Marketing</a></td>
				</tr>
			</table>
			<br/>
			<center>
				Copyright 2015. All rights reserved to Balzan Football Club.
			</center>			
			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<script type="text/javascript">
	$(document).ready(function(){
		//var $ = jQuery;
		if ($(".menu-toggle").is(":visible") ){
			//we are in mobile mode
			$("#menu-menu-1").height($(window).height() - 117);
		}

		$("#footer-ads").html($("#footer-ads-temp").html());
	});
	
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62448023-1', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>
</body>
</html>
