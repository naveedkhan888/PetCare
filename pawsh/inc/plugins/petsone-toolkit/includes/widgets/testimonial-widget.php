<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor testimonial Widget.
 *
 * Elementor widget that uses the testimonial control.
 *
 * @since 1.0.0
 */
class Elementor_Testimonial_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonial widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'testimonial';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonial widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Petsone Testimonial', 'elementor-testimonial-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve testimonial widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel-loop';
	}

	/**
	 * Register testimonial widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-testimonial-control' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'selected_style',
			[
				'label' => esc_html__( 'Select Style', 'elementor-services-post-control' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1', // Set the default style
				'options' => [
					'style1' => esc_html__( 'Style 1', 'elementor-services-post-control' ),
					'style2' => esc_html__( 'Style 2', 'elementor-services-post-control' ),
					'style3' => esc_html__( 'Style 3', 'elementor-services-post-control' ),
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'list_content', [
				'label' => __( 'Content', 'elementor-testimonial-control' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Content' , 'elementor-testimonial-control' ),
				'label_block' => true,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'list_clientname', [
				'label' => __( 'Client Name', 'elementor-testimonial-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'clientname' , 'elementor-testimonial-control' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_department', [
				'label' => __( 'Client Designation', 'elementor-testimonial-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'clientdesignation' , 'elementor-testimonial-control' ),
				'label_block' => true,
			]
		);
	
		$repeater->add_control(
			'list_image1',
			[
				'label' => esc_html__( 'Quote Image', 'elementor-farosa-04-control' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'list_image2',
			[
				'label' => esc_html__( 'Client Image', 'elementor-farosa-04-control' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
	
		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'elementor-testimonial-control' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_content' => __( 'Content', 'elementor-testimonial-control' ),
						'list_clientname' => __( 'Client Name', 'elementor-testimonial-control' ),
						'list_department' => __( 'Department Name', 'elementor-testimonial-control' ),
						'list_image1' => __( 'Quote Image', 'elementor-testimonial-control' ),
					],
					[
						'list_content' => __( 'Content', 'elementor-testimonial-control' ),
						'list_clientname' => __( 'Client Name', 'elementor-testimonial-control' ),
						'list_image1' => __( 'Quote Image', 'elementor-testimonial-control' ),
						'list_department' => __( 'Department Name', 'elementor-testimonial-control' ),
					],
				],
				'heading_field' => '{{{ list_heading }}}',
			]
		);
		$this->end_controls_section();
		
	}


	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$selected_style = $settings['selected_style'];
		?>
		<?php if ($selected_style === 'style1') {?>
			<section class="testimonials_section position-relative">
					<div class="owl-carousel testimonial-carousel owl-theme" data-aos="fade-up" data-aos-duration="700">
					<?php
					$count = 0;
					if ($settings['list']) {
						foreach ($settings['list'] as $item) {
							?>
						<div class="item">
							<div class="testimonials_content position-relative">
								<p class="paragraph"><?php echo $item['list_content']; ?></p>
								<ul class="list-unstyled">
									<li><i class="fa-solid fa-star"></i></li>
									<li><i class="fa-solid fa-star"></i></li>
									<li><i class="fa-solid fa-star"></i></li>
									<li><i class="fa-solid fa-star"></i></li>
									<li><i class="fa-solid fa-star"></i></li>
								</ul>
								<h3><?php echo $item['list_clientname']; ?></h3>
								<p class="text-size-18"><?php echo $item['list_department']; ?></p>
								<figure class="testimonials_quote mb-0 position-absolute">
									<?php echo wp_get_attachment_image($item['list_image1']['id'], 'full'); ?>
								</figure>
							</div>
						</div>
						<?php
								$count++;
							}
						}
						?>
					</div>
			</section>
		<?php } if ($selected_style === 'style2') {?>
			<section class="testimonials_section1 position-relative">
					<div class="owl-carousel testimonial-carousel1 owl-theme" data-aos="fade-up" data-aos-duration="700">
					<?php
					$count = 0;
					if ($settings['list']) {
						foreach ($settings['list'] as $item) {
							?>
						<div class="item">
							<div class="testimonials_content1 position-relative">
								<figure class="testimonials_client">
									<?php echo wp_get_attachment_image($item['list_image2']['id'], 'full'); ?>
								</figure>
								<ul class="list-unstyled">
									<li><i class="fa-solid fa-star"></i></li>
									<li><i class="fa-solid fa-star"></i></li>
									<li><i class="fa-solid fa-star"></i></li>
									<li><i class="fa-solid fa-star"></i></li>
									<li><i class="fa-solid fa-star"></i></li>
								</ul>
								<p class="paragraph"><?php echo $item['list_content']; ?></p>
								<h3><?php echo $item['list_clientname']; ?></h3>
								<p class="depart"><?php echo $item['list_department']; ?></p>
							</div>
						</div>
						<?php
								$count++;
							}
						}
						?>
					</div>
			</section>
		<?php } if ($selected_style === 'style3') {?>
			<section class="testimonials_section2 position-relative">
					<div class="owl-carousel testimonial-carousel2 owl-theme" data-aos="fade-up" data-aos-duration="700">
					<?php
					$count = 0;
					if ($settings['list']) {
						foreach ($settings['list'] as $item) {
							?>
						<div class="item">
							<div class="testimonials_content2 position-relative">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="left-content">
											<p class="paragraph"><?php echo $item['list_content']; ?></p>
											<h3><?php echo $item['list_clientname']; ?></h3>
											<p class="depart"><?php echo $item['list_department']; ?></p>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">
										<figure class="testimonials_client">
											<?php echo wp_get_attachment_image($item['list_image2']['id'], 'full'); ?>
										</figure>
									</div>
								</div>
							</div>
						</div>
						<?php
								$count++;
							}
						}
						?>
					</div>
					<div class="btn-wrap">
						<button class="prev-btn"><span class="d-block"></span><i class="fas fa-long-arrow-alt-left"></i></button>
						<button class="next-btn"><span class="d-block"></span><i class="fas fa-long-arrow-alt-right"></i></button>
					</div>
			</section>
			<script>
			jQuery(document).ready(function ($) {
				jQuery(".owl-carousel").owlCarousel({
					loop: false,
					margin: 0,
					dots: false,
					nav: true,
					items: 1 
				});
				var owl = jQuery(".owl-carousel");
				owl.owlCarousel();
				jQuery(".next-btn").click(function () {
					owl.trigger("next.owl.carousel");
				});
				jQuery(".prev-btn").click(function () {
					owl.trigger("prev.owl.carousel");
				});
				jQuery(".prev-btn").addClass("disabled");
				jQuery(owl).on("translated.owl.carousel", function (event) {
					if (jQuery(".owl-prev").hasClass("disabled")) {
						jQuery(".prev-btn").addClass("disabled");
					} else {
						jQuery(".prev-btn").removeClass("disabled");
					}
					if (jQuery(".owl-next").hasClass("disabled")) {
						jQuery(".next-btn").addClass("disabled");
					} else {
						jQuery(".next-btn").removeClass("disabled");
					}
				});
			});
		</script>
		<?php } ?>
		<?php
	}
	

}
