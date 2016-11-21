<?php
/**
 * Template Name: Fixtures
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<style type="text/css">
		.team-logo{
			background-size: 50px 46px !important;
    		height: 50px !important;
    		width: 46px !important;
    		float: left;
    		margin-left: 20px;
    		margin-right: 20px;
    		margin-top: 7px; 
		}
	</style>
	<div id="primary" class="site-content">
		<div id="content" role="main">	
			<?php while ( have_posts() ) : the_post(); ?>			
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			
			<div style="max-width:980px;margin:0 auto" class="fixtures">
				<?php

					function GetMatchStartTimes(){
						$contentToGetTime = file_get_contents('http://s638673298.onlinehome.us/results-fixtures/premier-league/fixtures');
						$startToGetTime = strpos($contentToGetTime, '<td><b>Fixture</b></td>');
						$endToGetTime= strpos($contentToGetTime, '<table width="595" border="1">', $startToGetTime);
						$contentToGetTime = substr($contentToGetTime, $startToGetTime, $endToGetTime - $startToGetTime) . '</table>';
						$results = explode('</tr>', $contentToGetTime);

						$count = 0;
						$playTimes = array();
						foreach($results as $result) {
							if ($count++ > 0){
							}
							
							$resultInners = explode('</td>', $result);
							if (strpos($resultInners[3], 'Balzan') !== false){
								array_push($playTimes, $resultInners[1]);
							}
						}
						return $playTimes;
					}
					
					$playTimes = GetMatchStartTimes();

					$content = file_get_contents('http://www.maltafootball.info/tables/premier/team12.php');
					
					$start = strpos($content, '<TABLE WIDTH=600 CELLSPACING=0 CELLPADDING=0 BORDER=0>', 1);
					$end = strpos($content, '</TABLE>', $start);
					
					$content = substr($content, $start, $end - $start) . '</table>';
					$content = str_replace('ONMOUSEOVER="this.style.backgroundColor = \'#DFDFDF\';" ONMOUSEOUT = "this.style.backgroundColor = \'\';"', '', $content);
					$content = str_replace('<TD></TD>', '', $content);
					// Replace this so it does not break our html.
					$content = str_replace('<TABLE WIDTH=600 CELLSPACING=0 CELLPADDING=0 BORDER=0>',
						'<TABLE WIDTH="100%" CELLSPACING=0 CELLPADDING=0 BORDER=0>', $content);
						
					$results = explode('</TR>', $content);

					$resultInterator = 0;
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
							
							// Separates all the columns into data.
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
								}
							}	

							// This will only display matches that have no score.
							if (strlen($score) == 3){ 
								if ($NH != $header){
									$header = $NH;
									$toWrite = "<div class='fixture-header'>" . $header . "</div>";
								}
								echo $toWrite . //"<div class='uday'>" . $day . substr($contentToGetTime, $toGoFrom, $toGoLast - $toGoFrom).  "</div>" .
									"<div class='complete'>" .
									
									(
										(trim($home)  != 'Balzan') ? 

									"<div class='team-logo ". strtolower($home)  ."'></div>" .
									"<div class='r4'>" .
										"<div class='x1'>Opponent</div>" .
										"<div class='x2'>" . $home . "</div>" .
									"</div>" :
									"<div class='team-logo ". strtolower($away)  ."'></div>" .
									"<div class='r3'>" .
										"<div class='x1'>Opponent</div>" .
										"<div class='x2'>" . $away . "</div>" .

									"</div>") .
									"<div class='r2'>" .
										"<div class='x1'>Stadium</div>" .
										"<div class='x2'>" . $ground . "</div>" .
									"</div>" .
									"<div class='r2'>" .
										"<div class='x1'>Date</div>" .
										"<div class='x2'>" . date("m-d-Y", $date) . "</div>" .
									"</div>" .
									"<div class='r2'>" .
										"<div class='x1'>Time</div>" .
										"<div class='x2'>" . $playTimes[$resultInterator++] .  "</div>" .//substr($contentToGetTime, $toGoFrom, $toGoLast - $toGoFrom) . "</div>" .
									"</div>"  .
									"</div>";
							}
						}	
					}

				?>
			</div>
			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>

