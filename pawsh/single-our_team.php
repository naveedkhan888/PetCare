<?php get_header(); 
$fb = get_post_meta(get_the_ID(), 'social_profile_facebook_link', true);
$twitter = get_post_meta(get_the_ID(), 'social_profile_twitter_link', true);
$instagram = get_post_meta(get_the_ID(), 'social_profile_instagram_link', true);?>
<div id="primary" class="content-area pawsh-page-containerr pawsh-single-details teams-single-detail-page">
		<main id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="featured-image">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                            <h5><?php echo get_the_excerpt(); ?></h5>
                        <?php endif; ?>
                        <div>
                            <ul class="list-unstyled" data-aos="fade-up" data-aos-duration="700">
                                <?php if($fb){?>
                                <li class="d-inline-block">
                                    <a href="<?php print esc_attr($fb); ?>"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <?php } ?>
                                <?php if($twitter){?>
                                <li class="d-inline-block"><a href="<?php print esc_attr($twitter); ?>"><i class="fab fa-twitter"></i></a></li>
                                <?php } ?>
                                <?php if($instagram){?>
                                <li class="d-inline-block"><a href="<?php print esc_attr($instagram); ?>"><i class="fab fa-instagram"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12">
                        <div class="team-content">
                            <?php while (have_posts()) : the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <header class="entry-header">
                                        <h2 class="entry-title"><?php the_title(); ?></h2>
                                    </header>

                                    <div class="entry-content">
                                        <?php the_content(); ?>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div>
<?php get_footer(); ?>
