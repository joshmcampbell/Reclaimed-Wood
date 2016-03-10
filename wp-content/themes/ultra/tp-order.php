<?php
/**
 * Template Name: Order
 *
 * This is the template for the board builder.
 *
 * @package BoardBuilder
 * @version  1.0
 */

get_header(); ?>

	<header class="entry-header">
		<div class="container">
			<h1 class="entry-title"><?php echo get_the_title(); ?></h1><?php ultra_breadcrumb(); ?>
		</div><!-- .container -->
	</header><!-- .entry-header -->		

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php include(MG_VIEWS. '/order.php'); ?>

			</main><!-- #main -->
		</div><!-- #primary -->


<?php get_footer(); ?>