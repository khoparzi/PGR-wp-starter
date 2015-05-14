<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.8
 */

get_header(); ?>

	<div id="content" class="medium-12 large-12 columns" role="main">

    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p class="breadcrumbs">','</p>'); } ?>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; // end have_posts() check ?>

		<?php wp_reset_postdata(); ?>

    	<?php
			$events = tribe_get_events( false, true);
    	?>
    	<h1 class="tribe-events-page-title"><?php echo tribe_get_events_title() ?></h1>

		<!-- List Header -->
		<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
			<?php tribe_get_template_part( 'list/nav', 'header' ); ?>
		</div>
		<!-- #tribe-events-header -->

		<ul class="block date-list">
		<?php while ( $events->have_posts() ) : $events->the_post(); ?>
			<li class="box">
				<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
					<?php the_title() ?>
				<div class="updated published time-details">
					<?php echo tribe_get_start_time( $post, false, 'U' ) ?> - 
					<?php echo tribe_get_end_time( $post, false, 'U' ) ?>
				</div>
				</a>
			</li>
		<?php endwhile; ?>
		</ul>
	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>