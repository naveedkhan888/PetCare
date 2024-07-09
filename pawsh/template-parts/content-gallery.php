<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package petsone
 */
$petsoneTag = Petsone_Function('Tags');
$petsoneFunc = Petsone_Function('Functions');
$petsone_tg = Petsone_Function('Tags');

if( is_single() ): ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-details-inner">
		<div class="blog-details-content">	
			<?php 
	        $gallery_images =  get_post_meta(get_the_id(), '_gallery-images', true); 
	        if (!empty($gallery_images)) : ?>
	            <div class="postbox-gallery mb-30">
	                <?php 
	                foreach( $gallery_images as $key => $image ) :   
	                	$image_url = wp_get_attachment_image_src($key, 'petsone-main-blog', true);
	                	?>
	                    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php print esc_attr__('image','petsone'); ?>" />
	                <?php 
	                endforeach; ?>
	            </div>
	        <?php 
	        endif; ?>
			
			<div class="blog-item-info">
				<ul class="post-meta">
					<li class="post-author"><?php $petsone_tg->posted_by(); ?></li>
					<li class="post-date"><?php $petsone_tg->posted_on(); ?></li>
				</ul>
			</div>

			<div class="st-blog-content-detils">

				<?php 
				if( has_excerpt() ): ?>
					<div class="short-summary-content">
						<?php the_excerpt(); ?>
					</div>
				<?php 
				endif; ?>		
				
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'petsone' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );
					
					$petsoneFunc->link_pages(); 
				?>
			 </div>

			<?php 
			if( has_category() ): ?>
				<div class="blog-details_bottom">
					<?php $petsone_tg->categories(); ?>
				</div>	
			<?php 
			endif; ?>

			 <?php 
			 if( has_tag() ) : ?>
				<div class="blog-details_bottom">
					<?php $petsone_tg->tags(); ?>
				</div>
			<?php 
			endif; ?>
		</div>
	</div>
		
</article><!-- #post-<?php the_ID(); ?> -->

<?php 
else: ?>
<div class="single-blog-wrap hellow-single-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<!-- blog-item-->
		<div class="blog-item">
		
			<?php 
	        $gallery_images =  get_post_meta(get_the_id(), '_gallery-images', true); 
	        if (!empty($gallery_images)) : ?>
	            <div class="postbox-gallery mb-30">
	                <?php 
	                foreach( $gallery_images as $key => $image ) :   
	                	$image_url = wp_get_attachment_image_src($key, 'petsone-main-blog', true);
	                	?>
	                    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php print esc_attr__('image','petsone'); ?>" />
	                <?php 
	                endforeach; ?>
	            </div>
	        <?php 
	        endif; ?>
			
			<div class="blog-details">

				<?php 
				if( ! empty( $post->post_title ) ) : ?>
        			<h5 class="blog-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php 
				endif; ?>

				<span><i class="fa fa-user"></i><?php $petsoneTag->posted_by(); ?></span>
                <span><i class="fa fa-clock-o"></i><?php $petsoneTag->posted_on(); ?></span>
                <?php the_excerpt(); ?>

				<div class="blog-btn">
				    <a class="read-more-btn" href="<?php esc_url( the_permalink() );?>"><?php esc_html_e("Read More", "petsone");?><i class="fa fa-long-arrow-right"></i></a>
				</div>
			
			</div>
		</div>
		
	</article>
</div>

<?php endif; ?>



