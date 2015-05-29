<?php
/**
 * The custom template for displaying content. Used for homepage loop.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.8
 */
?>

		<div class="large-6 columns grid-item">
			<?php wpforge_entry_meta_categories(); ?>
				<?php the_post_thumbnail(); ?>
				<span class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-forge' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</span>
		</div>