<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor petsone-faq Widget.
 *
 * Elementor widget that uses the petsone-faq control.
 *
 * @since 1.0.0
 */
class Elementor_Petsone_Faq_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve petsone-faq widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'petsone-faq';
    }

    /**
     * Get widget title.
     *
     * Retrieve petsone-faq widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Petsone Faq', 'elementor-petsone-faq-control' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve petsone-faq widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-carousel-loop';
    }

    /**
     * Register petsone-faq widget controls.
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
                'label' => esc_html__( 'Content', 'elementor-petsone-faq-control' ),
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
            'list_title',
            [
                'label' => esc_html__( 'Title', 'elementor-medell-faq-control' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Title' , 'elementor-petsone-faq-control' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'list_content', [
                'label' => __( 'Content', 'elementor-petsone-faq-control' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'Content' , 'elementor-petsone-faq-control' ),
                'label_block' => true,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __( 'Repeater List', 'elementor-petsone-faq-control' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( 'Title', 'elementor-petsone-faq-control' ),
                        'list_content' => __( 'Content', 'elementor-petsone-faq-control' ),
                    ],
                    [
                        'list_title' => __( 'Title', 'elementor-petsone-faq-control' ),
                        'list_content' => __( 'Content', 'elementor-petsone-faq-control' ),
                    ],
                ],
                'heading_field' => '{{{ list_heading }}}',
            ]
        );
        $this->end_controls_section();

    }

    /**
     * Render petsone-faq widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="faq-main-section">
            <div class="container">
                <div class="faq-inner-section">
                    <div id="accordion">
                        <?php
                        $count = 0;
                        if ($settings['list']) {
                            foreach ($settings['list'] as $item) {
                                $collapse_id = 'collapse_' . $count;
                                $show_class = ($count === 0) ? 'show' : ''; // Set 'show' class for the first item
                                $card_class = ($show_class) ? 'true' : 'false'; // Add 'true' class if 'show' class is present
                                ?>
                                <div class="card <?php echo $card_class; ?>" data-aos="fade-up" data-aos-duration="700">
                                    <div class="card-header" id="heading_<?php echo $count; ?>">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link <?php echo ($count === 0) ? '' : 'collapsed'; ?>" data-toggle="collapse" data-target="#<?php echo $collapse_id; ?>"
                                                    aria-expanded="<?php echo ($count === 0) ? 'true' : 'false'; ?>" aria-controls="<?php echo $collapse_id; ?>"
                                                    onclick="toggleTrueFalseClasses(this, '<?php echo $collapse_id; ?>')">
                                                <?php echo $item['list_title']; ?>
                                            </button>
                                        </h5>
                                    </div>
    
                                    <div id="<?php echo $collapse_id; ?>" class="collapse <?php echo $show_class; ?>" aria-labelledby="heading_<?php echo $count; ?>"
                                         data-parent="#accordion">
                                        <div class="card-body"><?php echo $item['list_content']; ?></div>
                                    </div>
                                </div>
                                <?php
                                $count++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    
        <script>
            function toggleTrueFalseClasses(button, collapseId) {
                // Remove 'true' class from all cards
                document.querySelectorAll('.card').forEach(function(card) {
                    card.classList.remove('true');
                });
    
                // Add 'true' class to the clicked card
                var clickedCard = button.closest('.card');
                clickedCard.classList.add('true');
    
                // Add 'false' class to all cards except those with 'show' class
                document.querySelectorAll('.card:not(.show)').forEach(function(cardWithoutShow) {
                    cardWithoutShow.classList.add('false');
                });
    
                // Remove 'false' class from the clicked card
                clickedCard.classList.remove('false');
            }
        </script>
    
        <?php
    }
    
}    
