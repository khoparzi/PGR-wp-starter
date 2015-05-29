<?php
/**
 * The Template for displaying all single pgr-profile.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.8
 */

get_header(); ?>

	<div id="content" class="medium-8 large-8 columns" role="main">
    
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p class="breadcrumbs">','</p>'); } ?>

		<?php while ( have_posts() ) : the_post(); ?>

			
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php wpforge_entry_meta_categories(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php wpforge_entry_meta_footer(); ?>
		</header><!-- .entry-header -->

		<?php 
			//$profile_data = get_post_custom();
		?>

        <div class="entry-summary">
            <span class="thumbnail"><?php the_post_thumbnail('thumbnail'); ?></span>
            <strong class="research-title"><?php echo get_field('research_project_title'); ?></strong>
            <?php if (get_field('email')): ?>
            	<span class="email"><?php echo get_field('email'); ?></span>
            <?php endif; ?>
        </div><!-- .entry-summary -->

        <div class="entry-content">
        	<?php echo get_field('project_details'); ?>
        	<h3>Links</h3>
        	<?php echo get_field('links'); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wp-forge' ), 'after' => '</div>' ) ); ?>
        </div><!-- .entry-content -->

	</article><!-- #post -->

			<nav class="nav-single">
				<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'wp-forge' ) . '</span> %title' ); ?></span>
				<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'wp-forge' ) . '</span>' ); ?></span>
			</nav><!-- .nav-single -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>