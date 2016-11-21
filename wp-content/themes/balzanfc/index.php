<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<style type="text/css">
		.team-logo{
			margin-top: 10px
		}

		article article{
			text-align: left;
			width: 100%;
			border-bottom: 1px solid black;
		}
		article article:nth-child(2n){
			text-align: left;
		}

		.entry-title a{
			text-align: left !important;
		}
		
	</style>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<article>
				
					<header class="entry-header">
						<h1 class="entry-title">Latest News</h1>
					</header>
					
					<?php

				//this is to get the time of the next fixture
					$contentToGetTime = file_get_contents('http://www.maltafootball.com/results-fixtures/premier-league/fixtures/');
					$startToGetTime = strpos($contentToGetTime, '<td><b>Fixture</b></td>');
					$endToGetTime= strpos($contentToGetTime, '<table width="595" border="1">', $startToGetTime);
					$firstBalzanVs = strpos($contentToGetTime, '<td><b>Balzan vs', $startToGetTime);
					$firstVsBalzan = strpos($contentToGetTime, 'Balzan</b></td>', $startToGetTime);
					$toGoFrom = $firstBalzanVs > $firstVsBalzan ? $firstVsBalzan : $firstBalzanVs;
					//$toGoFrom	 will be the 'end' of the search so that the time will be before it...
					$toGoFrom = strrpos($contentToGetTime, '<p><TR align="center"', $toGoFrom);
					//$toGoFrom will now be the beginning of the part where Balzan is !
					$toGoFrom = strpos($contentToGetTime, '<TD>', $toGoFrom);
					$toGoFrom = strpos($contentToGetTime, '<td>', $toGoFrom);
					$toGoLast= strpos($contentToGetTime, '</td>', $toGoFrom);



					$content = file_get_contents('http://www.maltafootball.com/pre-wp/tables/premier/team12.php');
					
					$start = strpos($content, '<TABLE WIDTH=550 CELLSPACING=0 CELLPADDING=0 BORDER=0>', 1);
					$end = strpos($content, '</TABLE>', $start);
					
					$content = substr($content, $start, $end - $start) . '</table>';
					$content = str_replace('ONMOUSEOVER="this.style.backgroundColor = \'#DFDFDF\';" ONMOUSEOUT = "this.style.backgroundColor = \'\';"', '', $content);
					$content = str_replace('<TD></TD>', '', $content);
					$content = str_replace('<TABLE WIDTH=550 CELLSPACING=0 CELLPADDING=0 BORDER=0>',
						'<TABLE WIDTH="100%" CELLSPACING=0 CELLPADDING=0 BORDER=0>', $content);
						
					$results = explode('</TR>', $content);
					
					$header = '';
					$count = 0;
					$NH = '';
					foreach($results as $result) {
						if ($count++ > 0){
							$count2 = 0;
							$tds = explode('</TD>', $result);
							
							$date = '';
							$home = '';
							$score = '';
							$away = '';
							$ground = '';
							$toWrite = '';
							$day = '';
							
							foreach($tds as $td) {
								if ($count2++ > 0){
									$theVar = explode('>', 
										str_replace('</B>', '', str_replace('<B>', '', $td))
									)[1] . '<br/>';
									
									if ($count2 == 2){
										//$date = strtotime($theVar);
										if ( strpos($theVar, '/', 0) > -1)
										{
											$date = strtotime(
														str_replace('/', '-', 
															str_replace('\r', '', str_replace('<br/>', '', $theVar))
														)
													);
											$NH = date("F Y", $date);
											$day = date("D", $date) . "<br/><div class='day'>" . date("d  	", $date) . "</div	>";
										}
									}
									else if ($count2 == 3){
										$home = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 4){
										$score = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 5){
										$away = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 6){
										$ground = str_replace('<br/>', '', $theVar);
									}
									
									////////////////
									////////////////
								}
							}	
							
							/*if (strlen($score) == 4){
								$header = $NH;
								echo $toWrite . "<div class='next-fixture'>" .
									
									"<div style='float:left;text-decoration:underline'>NEXT FIXTURE</div>" .
									
									"<div style='text-align: left; width: 100%; clear:both;padding: 0 20 10px;font-size:12px'> Category: <b>Premier League</b></div>" .
									"<div style='text-align: left; width: 100%; clear:both;padding: 0 20 10px;font-size:12px'> Date: <b>" . date("Y-m-d", $date) . "</b></div>" .
									"<div style='text-align: left; width: 100%; clear:both;padding: 0 20 10px;font-size:12px'> Time: <b>" . 
									//substr($contentToGetTime, $toGoFrom, $toGoLast - $toGoFrom) . "</b></div>" .
									"18:00".
									"<div style='text-align: left; width: 100%; clear:both;padding: 0 20 10px;font-size:12px'> Venue: <b>" . $ground . "</b></div>" .
									

									"<div style='clear: both; float: left; width: 50%; text-align: center; padding: 0px;text-transform:uppercase'>" . 
										$home . 
										"<div class='team-logo ". strtolower($home)  ."'></div>" .
									"&nbsp;&nbsp;&nbsp;</div>" .
									"<div style='float: right; width: 50%; padding: 0px;text-align:center;text-transform:uppercase'>&nbsp;&nbsp;&nbsp;" .
										$away .
										"<div class='team-logo ". strtolower($away)  ."'></div>" .
									"</div>".
								"</div>";
								break;
							}*/
						}
					}?>
				<?php if ( have_posts() ) : ?>
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile; ?>

					<?php twentytwelve_content_nav( 'nav-below' ); ?>


				<?php else : ?>

					<article id="post-0" class="post no-results not-found">

					<?php if ( current_user_can( 'edit_posts' ) ) :
						// Show a different message to a logged-in user who can add posts.
					?>
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
						</header>

						<div class="entry-content">
							<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
						</div><!-- .entry-content -->

					<?php else :
						// Show the default message to everyone else.
					?>
						
					<?php endif; // end current_user_can() check ?>

					</article><!-- #post-0 -->

				<?php endif; // end have_posts() check ?>
			</article>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>