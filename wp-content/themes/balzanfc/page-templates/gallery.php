<?php
/**
 * Template Name: Full-width Page for gallery outer
 * Description: A full-width template with no sidebar
 *
 * @package Portfolio Press
 */

get_header(); ?>

	<div id="primary" class="full-width">
		<div id="content" role="main">

			<?php the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'portfolio-press' ) . '&after=</div>' ); ?>
					<?php edit_post_link( __( 'Edit', 'portfolio-press' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php comments_template( '', true ); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>

<style>
@media (min-width: 800px) {
	#main{float: left; width: 100%;
	footer{clear:both;}
}

.ms-slide-bgcont img{ position: absolute;}
.entry-header, #comments{
display:none;
}

#content{
padding:0px;
}

#content article, #content{
margin:0px;
}

#main{
margin:0px;
padding-bottom: 0px;
}

.ms-view.ms-basic-view.ms-grab-cursor{
	margin-bottom:-70px;
}

#colophon{
	border:none;
	 clear: both;
}

</style>
<script>
/*
jQuery( window ).resize(function($) {
	jQuery('.ms-grab-cursor, .ms-slide-container > div').height(
		jQuery(window).height() - jQuery('#colophon').outerHeight() - jQuery('#branding').outerHeight()
	);
	page_img_pos = getIMGPosition($('.ms-slide-bgcont'), $('body'));
				$('.ms-slide-bgcont img').each(function(){
					$(this).css({'left': (-1) * (page_img_pos.left - (page_img_pos.left / page_img_pos.center_x) * (page_img_pos.center_x - mouse_pos.x)) + 'px','top': (-1) * (page_img_pos.top - (page_img_pos.top / page_img_pos.center_y) * (page_img_pos.center_y - mouse_pos.y)) + 'px', 'margin-top':0});
				});
});


var count = 50;
function theResize(){
	setTimeout(function(){
		jQuery('.ms-grab-cursor, .ms-slide-container > div').height(
			jQuery(window).height() - jQuery('#colophon').outerHeight() - jQuery('#branding').outerHeight()
		);
		if (count-- > 0)
			theResize();
	}, 250);	
}*/

jQuery(document).ready(function($) {
	
	//$("#primary").height($("#content").height());
	
	//theResize();

	var mouse_pos = {
		'x': 0,
		'y': 0
	};
	var getIMGPosition = function(current_img, conteyner) {
		var left = (current_img.find('img').width() - current_img.parent().width()) / 2;
		var top = (current_img.find('img').height() - current_img.parent().height()) / 2;
		var center = {'x':/*conteyner.width()*/ 1583/2,'y': 1733/*conteyner.height()*//2};
		return {
			'left': left,
			'top': top,
			'center_x': center.x,
			'center_y': center.y
		};
	};
	var is_move_page_bg = true;
	$('body').mousemove(function(e) {

		mouse_pos.x = e.pageX;
		mouse_pos.y = e.pageY;
	
		if(is_move_page_bg) {
			is_move_page_bg = false;
			setTimeout(function() {
				page_img_pos = getIMGPosition($('.ms-slide-bgcont'), $('body'));
				$('.ms-slide-bgcont img').each(function(){
					$(this).css({'left': (-1) * (page_img_pos.left - (page_img_pos.left / page_img_pos.center_x) * (page_img_pos.center_x - mouse_pos.x)) + 'px','top': (-1) * (page_img_pos.top - (page_img_pos.top / page_img_pos.center_y) * (page_img_pos.center_y - mouse_pos.y)) + 'px', 'margin-top':0});
					is_move_page_bg = true;
				});
			}, 25);
		};
	});
});
</script>	