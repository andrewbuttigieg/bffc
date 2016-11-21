<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );$classes = get_body_class();
	if ($feat_image != '' && !in_array('search',$classes) && !in_array('attachment',$classes) ){
		echo '<div class="featured-image" style="margin-top: -50px;background:url(' . $feat_image . '); height:218px;width:100%;" ></div>';
	}
?>

		<div class="entry-content" style="margin-top: -50px;">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
