<?php
/**
 * Template Name: League Standings
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

<style>
.team-logo {
    background-size: 60px 65px !important;
    float: left;
    height: 65px;
    width: 60px;
}
</style>
	<div id="primary" class="site-content">
		<div id="content" role="main">	
			<?php while ( have_posts() ) : the_post(); ?>			
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			
			<div style="max-width:980px;margin:0 auto" class="standings">
				<?php
					$content = file_get_contents('http://www.maltafootball.info/tables/premier/tableoverall.php');
					$start = strpos($content, '<TABLE WIDTH=600 CELLSPACING=0 CELLPADDING=0 BORDER=0>', 1);
					$end = strpos($content, '</TABLE>', $start);

					$content = substr($content, $start, $end - $start) . '</TABLE>';
					$content = str_replace('ONMOUSEOVER="this.style.backgroundColor = \'#DFDFDF\';" ONMOUSEOUT = "this.style.backgroundColor = \'\';"', '', $content);
					$content = str_replace('<TD></TD>', '', $content);

					$results = explode('</TR>', $content);

					echo  "<TABLE WIDTH=100% CELLSPACING=0 CELLPADDING=0 BORDER=0><tbody>
					<tr>
					<td align='CENTER' width='28'></td>
					<td align='LEFT' width='141'></td>
					<td align='CENTER' width='35'>PLD</td>
					<td align='CENTER' width='30'>W</td>
					<td align='CENTER' width='30'>D</td>
					<td align='CENTER' width='30'>L</td>
					<td align='CENTER' width='40'>F</td>
					<td align='CENTER' width='40'>A</td>
					<td align='CENTER' width='40'>+/-</td>
					<td align='CENTER' width='35'>Pts</td>
					</tr>";

					$header = '';
					$count = 0;
					$NH = '';
					$standing = 0;
					foreach($results as $result) {
						if ($count++ > 0){
							$count2 = 0;
							$tds = explode('</TD>', $result);
							
							//$standing = '';
							$team = '';
							$played = '';
							$wins = '';
							$draws = '';
							$loses = '';
							$for = '';
							$against = '';
							$goalDifference = '';
							$points = '';
							
							foreach($tds as $td) {
								
								
									$theVar = $td;
									

									if ($count2 == 0){
										//$standing = str_replace('<br/>', '', $theVar);
										$standing++;
									}
									else if ($count2 == 1){
										$team = str_replace('<br/>', '', $theVar);
										$teamFirst = strpos($team, ".php", 1) + 6;
										$teamEnd = strpos($team, '</A>');
										$team = substr($team, $teamFirst, $teamEnd - $teamFirst) ;
									}
									else if ($count2 == 2){
										$played = $theVar;
									}
									else if ($count2 == 3){
										$wins = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 4){
										$draws = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 5){
										$loses = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 6){
										$for = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 7){
										$against = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 8){
										$goalDifference = str_replace('<br/>', '', $theVar);
									}
									else if ($count2 == 9){
										$points = str_replace('<br/>', '', $theVar);
									}
								$count2++;	
									////////////////
									////////////////
							}	
							
							//if (!( trim($score) != '- <br/>'))
							if ($count < 14 && $count2 > 3)
							{
								if ($NH != $header){
									$header = $NH;
									$toWrite = "<div class='fixture-header'>" . $header . "</div>";
								}
								$re = "/(<a[^href]*href=[\"']{2}[^>]*>)([^<>]*|.*)(<\\/a>)/m";
								$subst = "$2";

								echo "<tr>";
								$team = preg_replace($re, $subst, $team);
								echo  '<td width="28" align="CENTER">' . $standing .'</td>';
								echo  "<td align='LEFT' width='141'><div class='team-logo ". strtolower($team)  ."'></div><div style='float:left;margin-left:10px;'>" . $team . "</div></td>";
								echo  $played ;
								echo  $wins ;
								echo  $draws ;
								echo  $loses ;
								echo  $for ;
								echo  $against ;
								echo  $goalDifference ;
								echo  $points ;
								echo "</tr>";
							}
						}
					}	


					echo "</tbody></table>";
				?>
			</div>
			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>

