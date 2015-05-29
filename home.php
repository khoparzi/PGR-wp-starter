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
		<?php $post_count = 0; ?>
		<?php if ( have_posts() ) : ?>
			<div class="row grid">
			<?php while ( have_posts() && $post_count < 4 ) : the_post(); ?>
				<?php get_template_part( 'content', 'looped' ); $post_count++; ?>
			<?php endwhile; ?>
			</div>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; // end have_posts() check ?>

		<?php wp_reset_postdata(); ?>

    	<?php
			$events = tribe_get_events(
				array(
					'posts_per_page' => 20,
					'start_date' => date( 'Y-m-d H:i:s', strtotime( '-1 week' ) ),
					'end_date' => date( 'Y-m-d H:i:s', strtotime( '+12 week' ) )
				),
			true);
			$prev_day = $prev_month = '';
    	?>
    	<h1 class="tribe-events-page-title"><?php echo tribe_get_events_title() ?></h1>

		<!-- List Header -->
		<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
			<?php tribe_get_template_part( 'list/nav', 'header' ); ?>
		</div>
		<!-- #tribe-events-header -->

		<ul class="block date-list">
			<?php while ( $events->have_posts() ) : $events->the_post(); ?>
			<?php 
					$curr_day = tribe_get_start_date( $post, false, 'Y-m-d' );
					$curr_month = tribe_get_start_date( $post, false, 'Y-m' );
			?>
			<!-- Month / Year Headers -->
			<?php
				
				if ($prev_day != $curr_day) {
					if ($prev_day != '') echo "</ul></li>";
					if ($prev_month != $curr_month) {
						echo '<li class="box monthYear">
							<a class="dateLink" href="'. TribeEvents::instance()->getLink( 'month', tribe_get_start_date( $post, false, 'Y-m' ) ) . '">
								<span>'.tribe_get_start_date( $post, false, 'M' ).'</span><br>
								'.tribe_get_start_date( $post, false, 'Y' ).'</a>
						</li>';
					}
			?>
				<!-- Day box -->
				<li class="box">
				<span class="theDay"><a href="<?php echo TribeEvents::instance()->getLink( 'day', tribe_get_start_date( $post, false, 'Y-m-d' ) ) ?>"><?php echo tribe_get_start_date( $post, false, 'd' ) ?></a></span>
				<ul>
				<?php } ?>
			
			
				<li class="event">
					<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
						<span class="theTitle"><?php the_title() ?></span>
						<span class="updated published time-details">
							<?php echo tribe_get_start_time( $post, false, 'U' ) ?> - 
							<?php echo tribe_get_end_time( $post, false, 'U' ) ?>
						</span>
					</a>
					<?php// echo "$prev_day - $curr_day" ?>
				</li>
			

				<?php
				$prev_day = $curr_day;
				$prev_month = $curr_month;
				?>
			<?php endwhile; ?>
			
			<?php if ($prev_month) { echo "</ul></li>"; } ?>
		</ul>
	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>