<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package void
 */
global $col_width, $display_type, $is_filter;
global $post;

$taxonomies = get_post_taxonomies($post);
$terms_id = '[';
foreach($taxonomies as $t_k => $t_v){
	$terms = get_the_terms( $post->ID , $t_v );
	$terms = is_array($terms)? $terms: [];
	foreach($terms as $term){
		$terms_id .= '"'.$term->term_id.'",';
	}
}
$terms_id = rtrim($terms_id, ',');
$terms_id .= ']';

?>
<div class="void-col-md-<?php echo esc_attr( $col_width );?> <?php echo esc_attr(($is_filter == 'true')? ' minimal-grid': ''); ?>" data-groups='<?php echo esc_attr(($is_filter == 'true')? $terms_id: ''); ?>'>
    <div class="void-post-grid void-minimal-grid void-<?php echo esc_attr($display_type); ?> ">
		<?php if( has_post_thumbnail()) : ?>
			<div class="post-img">
				<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php
					if( get_transient('void_grid_image_size') ){
						$grid_image_size = get_transient('void_grid_image_size');
					}else{
						$grid_image_size = 'full';
					}
					the_post_thumbnail( $grid_image_size, array(
							'class' => 'img-responsive',
							'alt'	=> get_the_title( get_post_thumbnail_id() )
							)
					);
				?>
				</a>
			</div><!--.post-img-->
		<?php endif; ?>

        <div class="post-info">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php 
						void_posted_on();
						void_entry_header();
					?>
				</div><!-- .entry-meta -->
				<div class="blog-excerpt">
					<?php the_excerpt(); ?>
				</div><!--.blog-excerpt-->				
			<?php endif; ?>
        </div>
        <!--.post-info-->
    </div>
</div>