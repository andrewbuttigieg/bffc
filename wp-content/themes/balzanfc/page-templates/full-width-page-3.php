<?php
/**
 * Template Name: A full-width template with no sidebar arranged icons
 * Description: A full-width template with no sidebar arranged icons
 *
 * @package Portfolio Press
 */

get_header(); ?>

	
<?php the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
		<div style="background: none repeat scroll 0% 0% white; padding-left: 40px; padding-right: 40px; max-width: 900px; margin: 0px auto -18px; padding-top: 1px;">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
		</div>
		<?php the_content(); ?>
	</article><!-- #post-<?php the_ID(); ?> -->
<?php comments_template( '', true ); ?>
	
<?php get_footer(); ?>


<div style="position:fixed;height:94px;width:100%;bottom:0px;background:white;z-index:90;display:none" id="lower">
	<div style="max-width: 980px; margin: 0px auto;line-height: 94px;">
		<div id="nnmm"></div>
		<span id="nnmm2"></span> <span id="nnmm4">|</span>
		<span id="nnmm3"></span>
		
		<div class='arrow-close'> <img src="../../wp-content/uploads/2014/08/close.png"/> </div>
		<div class='arrow-right'> <img src="../../wp-content/uploads/2014/08/right.png"/> </div>
		<div class='arrow-left'> <img src="../../wp-content/uploads/2014/08/left.png"/> </div>
		<!-- <div class='arrow-email'> <img src="../../wp-content/uploads/2014/08/email.png"/> </div> -->
		
		<!--<div style="margin-top: 13px; float: right;">
			<img id="a1" src="" width="50px"/>
			<img id="b1" src="" width="50px"/>
			<img id="c1" src="" width="50px"/>
		</div>-->
		
	</div>
</div>

<style>
	h2{
		background: none repeat scroll 0 0 white;
	    margin: 0 auto;
	    max-width: 940px;
	    /*padding-left: 40px;*/
	}
	article h2{
		padding-left: 40px;	
	}
	.entry-title{
		margin-bottom: 18px;
		margin-top: 20px;
		padding-top: 20px;
	}

	#main{
		/*background:url('../../wp-content/uploads/background.jpg');*/
		margin-top: -100px;
		background-repeat:no-repeat;
	}
	
	.swiper-container-main{
		background:white;
	}
	#main > article {
		padding-top:100px;
	}
	article{
		max-width: 100%;
	}
	#a1, #b1, #c1{
		cursor: pointer;
	}
	.arrow-right, .arrow-left, .arrow-close, .arrow-email{
		float:right;margin-top: 18px;
		cursor: pointer;
	}
	
	#comments{
		display:none;
	}

	#nnmm{
		float: left; font-size: 22pt; text-transform: uppercase;
	}
	
	#nnmm2{
		padding-left:33px;
		line-height: 103px;
	}

	.entry-header, article p{
		max-width:980px;
		margin: 0 auto;
	}
	
	article p{
		background:white;
		max-width: 900px;
		padding: 10px 40px 10px;
	}
	
	*, *:before, *:after {
		box-sizing: inherit;
	}
	#main .col-width{
		max-width:none;
	}

	.swiper-wrapper {
		position: relative;
		width: 100%;
		-webkit-transition-property: -webkit-transform,left,top;
		-webkit-transition-duration: 0s;
		-webkit-transform: translate3d(0px,0,0);
		-webkit-transition-timing-function: ease;
		-moz-transition-property: -moz-transform,left,top;
		-moz-transition-duration: 0s;
		-moz-transform: translate3d(0px,0,0);
		-moz-transition-timing-function: ease;
		-o-transition-property: -o-transform,left,top;
		-o-transition-duration: 0s;
		-o-transform: translate3d(0px,0,0);
		-o-transition-timing-function: ease;
		-o-transform: translate(0px,0px);
		-ms-transition-property: -ms-transform,left,top;
		-ms-transition-duration: 0s;
		-ms-transform: translate3d(0px,0,0);
		-ms-transition-timing-function: ease;
		transition-property: transform,left,top;
		transition-duration: 0s;
		transform: translate3d(0px,0,0);
		transition-timing-function: ease;
	}
	.swiper-container {
		position: relative;
		overflow: hidden;
		-webkit-backface-visibility: hidden;
		-moz-backface-visibility: hidden;
		-ms-backface-visibility: hidden;
		-o-backface-visibility: hidden;
		backface-visibility: hidden;
		z-index: 1;
		padding-top: 0px;
		margin:0 auto !important;
	}
	.gallery {
		text-align:center;
	}
    .mobHolder .gallery {
        margin-left: 38px;
    }
    .swiper-slide {
        height: 900px;
        -webkit-transition: 300ms;
        -moz-transition: 300ms;
        -ms-transition: 300ms;
        -o-transition: 300ms;
        transition: 300ms;
    }
    .swiper-slide-active {
        opacity: 1;
    }
    .swiper-slide .title {
        font-style: italic;
        font-size: 42px;
        margin-top: 80px;
        margin-bottom: 0;
        line-height: 45px;
    }
	.swiper-slide {
		float: left;
	}
	.swiper-slide-visible{
		opacity:0.15;
	}
		.swiper-slide-active
	{
		opacity:1.0;
	}
    .gallery-item{
		margin-bottom: -7px;
	    margin-top: -10px;
	    padding-left: 45px;
	    padding-right: 45px;
	    padding-top: 45px;
	    width: 220px;
    }
	.swiper-container {
		max-width:980px;
		margin:0 auto;
	}
	
	#container{
		/*background:#F4F4F4;*/
	}
	
	.gallery-chooser{
		border: 1px solid black;
    margin-left: 18px;
    margin-right: 18px;
    padding: 16px 10px;
	}
	
	.gallery-chooser-container{
		 clear: both;
		height: 120px;
		margin: 73px auto 0;
		position: absolute;
		text-align: center;
		width: 100%;
		z-index:50;
	}
	.gallery-chooser.active{
		background:black
	}
	
	.gallery-chooser-container a{
		color:black;
		font-family:georgia;
		font-weight:bold;
	}
	
	.gallery-chooser-container a.active{
		color:white;
	}
	
	.gallery-chooser-container a:hover{
		text-decoration:none;
	}

</style>
