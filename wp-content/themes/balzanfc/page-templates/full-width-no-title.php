<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript">
    </script>
<?php
/**
 * Template Name: Full-width Page Template, No Sidebar, No Title [homepage]
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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=153200338086434";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<style type="text/css">
	.entry-header {
    margin-bottom: 13px !important;
}
.entry-header .entry-title a {
    font-weight: bold;
    text-decoration: underline;
}

.blog article article:last-of-type{
	border: none;
}

article .entry-header{
margin-top: 22px;
}

footer[role="contentinfo"]{
	border:none!important;
}
article .entry-header {
    margin-top: 0;
}
	.blog article .entry-title {
    font-size: 18px;
    margin-bottom: 12px;
    text-transform: none;
}
.read-more{
	margin-top: 27px !important;
}
.next-fixture div{
	padding: 0px
}
.entry-content p, .entry-summary p, .comment-content p, .mu_register p {
    font-size: 13px;
    line-height: 15px;
    margin: 0 0 11px;
}
.next-fixture-outer, .standings-outer{
	padding-left: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
}

.next-fixture .team-logo {
    background-position: center center;
    background-size: 60px auto;
    height: 70px;
    width: 70px;
}

		article article{
			text-align: left;
			width: 100%;
			border-bottom: 1px solid black;

		}
		article article:nth-child(2n){
			text-align: left;
		}

		.site-content article{
			padding-bottom: 35px;
    		padding-top: 20px;
		}

		.entry-title a{
			text-align: left !important;
		}

		.standings table tr:nth-child(1) {
    		background: none repeat scroll 0 0 black;
    		color: white;
		}

		.standings table tr:nth-child(1) td:nth-child(1){
			border: none;
		}

		.standings table tr:nth-child(1) td {
    		border: none;
		}

		.standings table tr:nth-child(1) td:nth-child(2):before {
		}

		.standings{
			float: right;
		    /*height: 345px;*/
		    overflow: hidden;
		    width: 64%;
		}
		table .team-logo{
			width:60px;
			height: 65px;
			background-size: 100% auto;
			float: left;
		}
		.banner { position: relative; overflow: auto; }
    	.banner li { list-style: none; }
       .banner ul li {
    display: block;
    float: left;
}
        .banner ul {  list-style: outside none none; height: auto; }
        .banner {
    color: rgba(255, 255, 255, 0.6);
    font-size: 18px;
    line-height: 24px;
    overflow: auto;
    position: relative;
    text-align: center;
    width: 100%;
}

.banner li img
{ 
	display: block; width: 100%; height: auto; 
}

.banner ul{
	width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
}
.banner{
	margin: 0px;
}
/*
 table tr td:nth-child(1){
 	text-align: center;
 	}*/
 	footer table td {
 		font-size: 12px;
 		line-height: 24px;
 	}
 	table#League td {
 		font-size: 12px;
 		line-height: 0px;
 	}
 	footer table{
 		line-height: 24px;
 		 margin-top: 20px;
 	}
	</style>

	<div class="banner">

		<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/12/homepageBanner.jpg" style="width: 100%; margin-top: -35px;"/>
	    <!--<ul style="margin-left: -40px; margin-top: 0;">
	        <li><img src="../wp-content/uploads/MainBanner1.jpg" style="width:100%"/></li>
	        <li><img src="../wp-content/uploads/MainBanner2.jpg" style="width:100%"/></li>
	        <li><img src="../wp-content/uploads/MainBanner3.jpg" style="width:100%"/></li>
	        <li><img src="../wp-content/uploads/MainBanner4.jpg" style="width:100%"/></li>
	    </ul>-->
	</div>
	<div style="height:50px;width:100%;background:#CF2227;float:left;margin-bottom:10px;margin-top:-6px;">
	</div>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			

			<div style="max-width:1050px;margin:0 auto">
				<div class="next-fixture-outer" style="float: left; width:279px;margin-left:20px;margin-right:20px;">
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
					

					

					$content = file_get_contents('http://www.maltafootball.info/tables/premier/team12.php');
					
					$start = strpos($content, '<TABLE WIDTH=600 CELLSPACING=0 CELLPADDING=0 BORDER=0>', 1);
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
										$score = str_replace('<br/>', '', $theVar);;
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
							
							if (strlen($score) == 3){
								$header = $NH;
								echo $toWrite . "<div class='next-fixture' style='height:auto;padding-bottom:9px;overflow:hidden;border: 1px solid black;'>" .
									"<div style='width: 100%; background: none repeat scroll 0% 0% black; color: white; height: 38px; line-height: 38px; padding-left: 10px;padding-bottom: 0;padding-left: 10px !important;padding-right: 0;padding-top: 0;'>Next Fixture</div>".
									"<br/>".
									"<div style='text-align: left; width: 100%; clear:both;padding: 0 20 10px;font-size:12px'> Category: <b>Premier League</b></div>" .
									"<div style='text-align: left; width: 100%; clear:both;padding: 0 20 10px;font-size:12px'> Date: <b>" . date("Y-m-d", $date) . "</b></div>" .
									"<div style='text-align: left; width: 100%; clear:both;padding: 0 20 10px;font-size:12px'> Time: <b>" . 
									//substr($contentToGetTime, $toGoFrom, $toGoLast - $toGoFrom) 
									$playTimes[0]
									. "</b></div>" .
									"<div style='text-align: left; width: 100%; clear:both;padding: 0 20 10px;font-size:12px'> Venue: <b>" . $ground . "</b></div>" .
									"<br/>" .
									
									"<div style='clear: both; float: left; width: 40%; text-align: center; padding: 0px;text-transform:uppercase'>" . 
										$home . 
										"<div class='team-logo ". strtolower($home)  ."'></div>" .
									"&nbsp;&nbsp;&nbsp;</div>" .
									"<div style='clear: none; float: left; width: 20%; text-align: center; padding: 0px;text-transform:uppercase;padding-top:35px;'>VS</div>" .
									"<div style='float: right; width: 40%; padding: 0px;text-align:center;text-transform:uppercase'>" .
										$away .
										"<div class='team-logo ". strtolower($away)  ."'></div>" .
									"</div><br/>".
									"<a style='float: left; text-align: center;width: 100%;' class='read-more-front' href='" . get_site_url() . "/Fixtures'><strong><div>See More Fixtures</div></strong></a>" .
								"</div>";
								break;
							}
						}
					}	
				?>

				<div style="width:100%;float:left; clear: both; border: 1px solid black;padding-bottom:10px">

					<?php
					$content = file_get_contents('http://www.maltafootball.info/tables/premier/tableoverall.php');
					
					//$start = strpos($content, '<table border="0" cellpadding="0" cellspacing="0" width="550">', 1);
					$start = strpos($content, '<TABLE WIDTH=600 CELLSPACING=0 CELLPADDING=0 BORDER=0>', 1);
					//$end = strpos($content, '</table>', $start);
					$end = strpos($content, '</TABLE>', $start);

					$content = substr($content, $start, $end - $start) . '</TABLE>';
					$content = str_replace('onmouseover="this.style.backgroundColor = \'#DFDFDF\';" onmouseout="this.style.backgroundColor = \'\';"', '', $content);
					$content = str_replace('<TD></TD>', '', $content);
					//$content = str_replace('<TABLE WIDTH=550 CELLSPACING=0 CELLPADDING=0 BORDER=0>',
					//	'<TABLE WIDTH="100%" CELLSPACING=0 CELLPADDING=0 BORDER=0>', $content);

					$results = explode('</TR>', $content);

					echo  "<TABLE id='League' style='margin-bottom:0px;' WIDTH=100% CELLSPACING=0 CELLPADDING=0 BORDER=0><tbody>
					<tr style='border: 1px solid black;background: none repeat scroll 0% 0% black; color: white; height: 38px;'>
					<td align='LEFT' colspan='3' style='text-align: left; padding-left: 10px;font-size:14px;'  width='100%'>Premier League Standings</td>
					</tr>
					<tr style=\"color:#B6B7B8;text-decoration:underline\"><td width=\"141\" align=\"LEFT\"><div style=\"float:left;margin:10px;\"><u>TEAM</u></div></td>
					<td style=\"border:none\" width=\"35\" align=\"CENTER\">
					PLD
					</td><td style=\"border:none\" width=\"35\" align=\"CENTER\">
					PTS</td></tr>";

					$header = '';
					$count = 0;
					$NH = '';
					foreach($results as $result) {
						if ($count++ > 0){
							$count2 = 0;
							$tds = explode('</TD>', $result);
							
							$standing = '';
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
								
								
									$theVar = $td;//explode('>', str_replace('</B>', '', str_replace('<B>', '', $td)))[1] . '<br/>';
									

									if ($count2 == 0){
										$standing = str_replace('<br/>', '', $theVar);
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
							if ($count < 14)
							{
								if ($NH != $header){
									$header = $NH;
									$toWrite = "<div class='fixture-header'>" . $header . "</div>";
								}
								$re = "/(<a[^href]*href=[\"']{2}[^>]*>)([^<>]*|.*)(<\\/a>)/m";
								$subst = "$2";

								echo "<tr>";
								$team = preg_replace($re, $subst, $team);
								//echo  $standing ;
								echo  "<td align='LEFT' width='141'><div style='float:left;margin:10px;'>" . $team . "</div></td>";
								echo  $played ;
								echo  $points ;
								echo "</tr>";
								//.
									//"<div class='team-logo ". strtolower($team)  ."'></div>" .
									//"<div class='r4'>" . $team . "</div>" ;
							}
						}
					}	


					echo "</tbody></table>";
				?>

				</div>

				
	<?php
		$meta = get_post_meta(873, 'special_offers', true);
		$special_offers = json_decode($meta);
		$special_offers_cnt = sizeof($special_offers);
	?>

	<?php
		if($special_offers_cnt > 0) {
			?>

			<div style="float: left; border: 1px solid black;margin-top:20px;width:100%">
				<div style="width: 100%; background: none repeat scroll 0% 0% black; color: white; height: 38px; line-height: 38px;">
					<div style="padding-left: 10px">Last Match Results</div></div>
						<div style="padding:20px;">
				<?php
			for($i=0; $i < $special_offers_cnt; $i++) { ?>

						<span style="color:#DB7276;text-transform:uppercase"><?=$special_offers[$i]->title?></span>
						<div style="margin-top: 10px;">
							<b><?=$special_offers[$i]->text?></b>
							<span style="float:right">
								<b><?=$special_offers[$i]->result?></b>
							</span>
						</div>
						<hr style="margin:10px 0;"/>
				<?php
			}
				?>
					</div>
				</div>
	<?php
		}
	?>


	<?php
		$meta = get_post_meta(878, 'special_offers', true);
		$special_offers = json_decode($meta);
		$special_offers_cnt = sizeof($special_offers);
	?>

	<?php
		if($special_offers_cnt > 0) {
			?>

			<div style="float: left; border: 1px solid black;margin-top:20px;width:100%">
				<div style="width: 100%; background: none repeat scroll 0% 0% black; color: white; height: 38px; line-height: 38px;">
					<div style="padding-left: 10px">Academy Next Matches</div></div>
						<div style="padding:20px;">
				<?php
			for($i=0; $i < $special_offers_cnt; $i++) { ?>

						<span style="color:#DB7276;text-transform:uppercase"><?=$special_offers[$i]->league?></span>
						<div style="margin-top: 10px;">
							<!--<div style="float: left; background: rgb(177, 30, 35) none repeat scroll 0% 0%; color: white; width: 36px; padding: 5px; text-align: center; margin-right: 10px;">
								date
							</div>-->
							<div style="float: left; width: 180px;">
								<b><?=$special_offers[$i]->team?></b>
								<?php /*<br style="margin: 4px"/>
								<span style="color:#78797A;">
									Date: <?=$special_offers[$i]->date?>
								</span>
								<br style="margin: 4px"/>
								<span style="color:#78797A;">
									Time: <?=$special_offers[$i]->time?>
								</span>
								<br style="margin: 4px"/>
								<span style="color:#78797A">
									Venue: <?=$special_offers[$i]->stadium?>
								</span>
								<br style="margin: 4px"/> */?>

								<div style='text-align: left; width: 100%; clear:both;padding: 10px 0 0 0;font-size:12px'> Date: <b> <?=$special_offers[$i]->date?> </b></div>
								<div style='text-align: left; width: 100%; clear:both;padding: 10px 0 0 0;font-size:12px'> Time: <b> <?=$special_offers[$i]->time?> </b></div>
								<div style='text-align: left; width: 100%; clear:both;padding: 10px 0;font-size:12px'> Venue: <b>  <?=$special_offers[$i]->stadium?></b></div>
							</div>
						</div>
						<hr style="margin-left: 0px; margin-right: 0px; clear: both; margin-top: 50px;"/>
				<?php
			}
				?>
					</div>
				</div>
	<?php
		}
	?>

			</div>
			<div class="standings-outer" style="width:450px;float:left;">
				<div class="standings" style="border: 1px solid black;margin-bottom:20px;float:left;width:100%">
					

					<div style="width: 100%; background: none repeat scroll 0% 0% black; color: white; height: 38px; line-height: 38px; padding-left: 10px;">Latest News</div>

					<div class="blog" style="padding: 10px; margin-top: -25px;">
						<article style="clear:both">
								<?php while ( have_posts() ) : the_post(); ?>			
									<?php the_content(); ?>
								<?php endwhile; // end of the loop. ?>

								<?php // Display blog posts on any page @ http://m0n.co/l
									$temp = $wp_query; $wp_query= null;
									$wp_query = new WP_Query(); $wp_query->query('showposts=6' . '&paged='.$paged);
									while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
										<?php get_template_part( 'content', get_post_format() ); ?>
									<?php endwhile; ?>
						</article>						
					</div>



				</div>
				<div><a href="/index/news/" class="read-more-front">Click here for older news</a></div>

				<br/>

			</div>


<?php
		$meta = get_post_meta(869, 'special_offers', true);
		$special_offers = json_decode($meta);
		$special_offers_cnt = sizeof($special_offers);
	?>



	<div class="adverts-outer" style="float: left; width:261px;margin-left:20px;">


<?php
		if($special_offers_cnt > 0) {
			?>

			<div style="float: left; border: 1px solid black;margin-bottom: 10px;margin-top: 0px;width: 100%;">
				<div style="width: 100%; background: none repeat scroll 0% 0% black; color: white; height: 38px; line-height: 38px;">
					<div style="padding-left: 10px">Coming Events</div></div>
						<div style="padding:20px;">
				<?php
			for($i=0; $i < $special_offers_cnt; $i++) { ?>

						<span style="color:#DB7276;text-transform:uppercase"><?=$special_offers[$i]->title?></span>
						<div style="margin-top: 10px;">
							<?=$special_offers[$i]->text?>
						</div>
						<br/>
						<a href="<?=$special_offers[$i]->link?>" class="read-more-front">Read more</a>
						<hr style="margin-left: 0px; margin-right: 0px;"/>
				<?php
			}
				?>
					</div>
				</div>
	<?php
		}
	?>

	<div style="float: left; border: 1px solid black;margin-bottom: 10px;margin-top:0px;width: 100%;">
		<div style="width: 100%; background: none repeat scroll 0% 0% black; color: white; height: 38px; line-height: 38px;">
		<div style="padding-left: 10px">Advert</div></div>
		<div id="slider" current="1">
			<img class="image" style="display:block" src="http://balzanfc.com/wp-content/uploads/2016/01/Advert1-261x261.jpg"/>		
			<img class="image" style="display:none" src="http://balzanfc.com/wp-content/uploads/2016/01/Advert2-261x261.jpg"/>		
			<img class="image" style="display:none" src="http://balzanfc.com/wp-content/uploads/2016/01/Advert3-261x261.jpg"/>		
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#slider').each(function(){

				});

				setInterval(function(){
					var current = $('#slider').attr('current');
					if (current == 3)
					{
						current = 1;
					}
					else{
						current++;
					}
					$("#slider .image").hide();
					$("#slider .image:nth-child(" + current + ")").show();
					$("#slider").attr('current', current);
				}, 5000);
			});
		</script>
	</div>

	

				<div style="float: left; border: 1px solid black;height:279px;width: 100%;margin-bottom: 0px;margin-top: 10px;width: 100%;">
					<div class="fb-page" data-href="https://www.facebook.com/balzanfc" data-width="279" data-height="279" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/balzanfc"><a href="https://www.facebook.com/balzanfc">Balzan F.C.</a></blockquote></div></div>
				</div>



				<a href="<?php echo get_site_url(); ?>/academy/about-us/">

					<div style="margin-top: 20px; float: left;">
						<div style="width: 100%; background: none repeat scroll 0% 0% black; color: white; height: 38px; line-height: 38px;">
							<div style="padding-left: 10px">Balzan FC Academy</div></div>
						<img src="<?php echo get_site_url(); ?>/wp-content/uploads/balzan3.jpg" style="width:100%"/>
					</div>
				</a>


			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->




<?php get_footer(); ?>

<!--
<script src="//code.jquery.com/jquery-latest.min.js"></script>
<script>
(function(e,t){if(!e)return t;var n=function(){this.el=t;this.items=t;this.sizes=[];this.max=[0,0];this.current=0;this.interval=t;this.opts={speed:500,delay:3e3,complete:t,keys:!t,dots:t,fluid:t};var n=this;this.init=function(t,n){this.el=t;this.ul=t.children("ul");this.max=[t.outerWidth(),t.outerHeight()];this.items=this.ul.children("li").each(this.calculate);this.opts=e.extend(this.opts,n);this.setup();return this};this.calculate=function(t){var r=e(this),i=r.outerWidth(),s=r.outerHeight();n.sizes[t]=[i,s];if(i>n.max[0])n.max[0]=i;if(s>n.max[1])n.max[1]=s};this.setup=function(){this.el.css({overflow:"hidden",width:n.max[0],height:this.items.first().outerHeight()});this.ul.css({width:this.items.length*100+"%",position:"relative"});this.items.css("width",100/this.items.length+"%");if(this.opts.delay!==t){this.start();this.el.hover(this.stop,this.start)}this.opts.keys&&e(document).keydown(this.keys);this.opts.dots&&this.dots();if(this.opts.fluid){var r=function(){n.el.css("width",Math.min(Math.round(n.el.outerWidth()/n.el.parent().outerWidth()*100),100)+"%")};r();e(window).resize(r)}if(this.opts.arrows){this.el.parent().append('<p class="arrows"><span class="prev">â†</span><span class="next">â†’</span></p>').find(".arrows span").click(function(){e.isFunction(n[this.className])&&n[this.className]()})}if(e.event.swipe){this.el.on("swipeleft",n.prev).on("swiperight",n.next)}};this.move=function(t,r){if(!this.items.eq(t).length)t=0;if(t<0)t=this.items.length-1;var i=this.items.eq(t);var s={height:i.outerHeight()};var o=r?5:this.opts.speed;if(!this.ul.is(":animated")){n.el.find(".dot:eq("+t+")").addClass("active").siblings().removeClass("active");this.el.animate(s,o)&&this.ul.animate(e.extend({left:"-"+t+"00%"},s),o,function(i){n.current=t;e.isFunction(n.opts.complete)&&!r&&n.opts.complete(n.el)})}};this.start=function(){n.interval=setInterval(function(){n.move(n.current+1)},n.opts.delay)};this.stop=function(){n.interval=clearInterval(n.interval);return n};this.keys=function(t){var r=t.which;var i={37:n.prev,39:n.next,27:n.stop};if(e.isFunction(i[r])){i[r]()}};this.next=function(){return n.stop().move(n.current+1)};this.prev=function(){return n.stop().move(n.current-1)};this.dots=function(){var t='<ol class="dots">';e.each(this.items,function(e){t+='<li class="dot'+(e<1?" active":"")+'">'+(e+1)+"</li>"});t+="</ol>";this.el.addClass("has-dots").append(t).find(".dot").click(function(){n.move(e(this).index())})}};e.fn.unslider=function(t){var r=this.length;return this.each(function(i){var s=e(this);var u=(new n).init(s,t);s.data("unslider"+(r>1?"-"+(i+1):""),u)})}})(window.jQuery,false)
</script>
<script type="text/javascript">
$(window).load(function() {

	
/*
	
	*/
	if(window.chrome) {
		$('.banner li').css('background-size', '100% 100%');
	}
	
	$('.banner').unslider({
		fluid: true,
		dots: true,
		speed: 500
	});

	$('.banner').height(
		$('.banner li img:first').outerHeight()
	);
});
</script>-->