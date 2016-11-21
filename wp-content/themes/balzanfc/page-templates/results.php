<?php
/**
 * Template Name: Balzan FC results
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
	.r1, .r2, .r3, .r4{
		width: 18%;
	}
	.team-logo
	{
		background-size: 60px 65px !important;
    	float: left;
    	height: 65px;
    	width: 60px;
	}
	@media screen and (max-width: 500px) {
		.team-logo
		{
			display: none;
		}
	}
</style>

	<div id="primary" class="site-content">
		<div id="content" role="main">	
			<?php while ( have_posts() ) : the_post(); ?>			
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			
			<div style="max-width:980px;margin:0 auto" class="results">
				<?php
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
					
					$header = '';
					$count = 0;
					$totalWrite = '';
					$currentTotal = '';
					foreach($results as $result) {
						if ($count++ > 0){
							$count2 = 0;
							$tds = explode('</TD>', $result);
							
							$date = '';
							$home = '';
							$score = '';
							$away = '';
							$ground = '';
							$day = '';
							$NH = '';
							
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
										$score = $theVar;
									}
									else if ($count2 == 5){
										$away = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 6){
										$ground = $theVar;
									}
									
									////////////////
									////////////////
								}
							}	
							
							if ($NH != $header){
								if ($currentTotal != ''){
									$currentTotal = "<div class='result-header'>" . $header . "</div>" . $currentTotal;							
								}
								$header = $NH;								
								$totalWrite = $currentTotal . $totalWrite;
								$currentTotal = '';
							}
							
							if ( trim($score) != '- <br/>' && trim($day) != ''){
								$currentTotal = "<div class='uday'>" . $day .  "</div>" .
									"<div class='complete'>" .
									"<div class='team-logo ". strtolower($home)  ."'></div>" .
									"<div class='r4'>" .
										"<div class='x1'>Home</div>" .
										"<div class='x2'>" . $home . "</div>" .
									"</div>" .
									"<div class='team-logo ". strtolower($away)  ."'></div>" .
									"<div class='r3'>" .
										"<div class='x1'>Away</div>" .
										"<div class='x2'>" . $away . "</div>" .
									"</div>" .
									"<div class='r2'>" .
										"<div class='x1'>Stadium</div>" .
										"<div class='x2'>" . $ground . "</div>" .
									"</div>" .
									"<div class='r1'>" .
										"<div class='score1'>Result</div>" .
										"<div class='score2'>" . $score . "</div>" .
									"</div>" .
									"</div>" . $currentTotal;
							}
						}
					}
					if ($currentTotal != ''){
						$currentTotal = "<div class='result-header'>" . $header . "</div>" . $currentTotal;	
						$totalWrite = $currentTotal . $totalWrite;
					}
					echo $totalWrite;
				?>
			</div>
			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>

