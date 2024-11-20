<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'custom_slider';
	}

	public function get_title() {
		return esc_html__( 'Custom Slider', 'elementor-slider-widget' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {

		// Content Section
		$this->start_controls_section(
			'slider_type_section',
			[
				'label' => esc_html__( 'Slider Type', 'elementor-slider-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slider_type',
			[
				'label' => esc_html__( 'Slider Type', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'custom_post'   => esc_html__( 'Custom Post', 'elementor-slider-widget' ),
					'custom_content' => esc_html__( 'Custom Content', 'elementor-slider-widget' ),
					'hero_slider'   => esc_html__( 'Hero Slider', 'elementor-slider-widget' ),
				],
				'default' => 'custom_post',
			]
		);
		$post_types = get_post_types( [ 'public' => true ], 'objects' );
		$post_type_options = [];
		
		foreach ( $post_types as $post_type ) {
			$post_type_options[ $post_type->name ] = $post_type->label;
		}
		// Custom Post Options
		$this->add_control(
			'custom_post_type',
			[
				'label' => esc_html__( 'Select Post Type', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $post_type_options, // Dynamically populated options
				'default' => 'post', // Default to "Post"
				'condition' => [
					'slider_type' => 'custom_post',
				],
			]
		);
		$this->add_control(
			'custom_post_category',
			[
				'label' => esc_html__( 'Enter Category Slug', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter the category slug', 'elementor-slider-widget' ),
				'condition' => [
					'slider_type' => 'custom_post',
				],
			]
		);
		
	
		

	// Repeater for Custom Slides
$custom_repeater = new \Elementor\Repeater();
$custom_repeater->add_control(
    'slide_title',
    [
        'label' => esc_html__('Title', 'elementor-slider-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Slide Title', 'elementor-slider-widget'),
    ]
);
$custom_repeater->add_control(
    'slide_content',
    [
        'label' => esc_html__('Content', 'elementor-slider-widget'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => esc_html__('Slide Content', 'elementor-slider-widget'),
    ]
);
$custom_repeater->add_control(
    'slide_image',
    [
        'label' => esc_html__('Image', 'elementor-slider-widget'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);
$custom_repeater->add_control(
    'slide_button_text',
    [
        'label' => esc_html__('Button Text', 'elementor-slider-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Click Here', 'elementor-slider-widget'),
    ]
);
$custom_repeater->add_control(
    'slide_button_url',
    [
        'label' => esc_html__('Button URL', 'elementor-slider-widget'),
        'type' => \Elementor\Controls_Manager::URL,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_external' => true,
    ]
);

// Add Custom Slides Control
$this->add_control(
    'custom_slides',
    [
        'label' => esc_html__('Slides', 'elementor-slider-widget'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $custom_repeater->get_controls(),
        'default' => [
            [
                'slide_title' => esc_html__('Slide 1 Title', 'elementor-slider-widget'),
                'slide_content' => esc_html__('This is slide 1 content.', 'elementor-slider-widget'),
                'slide_image' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'slide_button_text' => esc_html__('Learn More', 'elementor-slider-widget'),
                'slide_button_url' => [
                    'url' => '#',
                ],
            ],
        ],
        'condition' => [
            'slider_type' => 'custom_content',
        ],
    ]
);

// Repeater for Hero Slides
$hero_repeater = new \Elementor\Repeater();
$hero_repeater->add_control(
    'hero_title',
    [
        'label' => esc_html__('Hero Title', 'elementor-hero-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Welcome to Our Website', 'elementor-hero-widget'),
    ]
);
$hero_repeater->add_control(
    'hero_subtitle',
    [
        'label' => esc_html__('Hero Subtitle', 'elementor-hero-widget'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => esc_html__('Explore the best products and services we offer.', 'elementor-hero-widget'),
    ]
);
$hero_repeater->add_control(
    'hero_background_image',
    [
        'label' => esc_html__('Background Image', 'elementor-hero-widget'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);
$hero_repeater->add_control(
    'hero_button_text',
    [
        'label' => esc_html__('Button Text', 'elementor-hero-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('Get Started', 'elementor-hero-widget'),
    ]
);
$hero_repeater->add_control(
    'hero_button_url',
    [
        'label' => esc_html__('Button URL', 'elementor-hero-widget'),
        'type' => \Elementor\Controls_Manager::URL,
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'show_external' => true,
    ]
);

// Add Hero Slides Control
$this->add_control(
    'hero_slides',
    [
        'label' => esc_html__('Hero Slides', 'elementor-hero-widget'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $hero_repeater->get_controls(),
        'default' => [
            [
                'hero_title' => esc_html__('Slide 1 Title', 'elementor-hero-widget'),
                'hero_subtitle' => esc_html__('Slide 1 Subtitle', 'elementor-hero-widget'),
                'hero_background_image' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'hero_button_text' => esc_html__('Learn More', 'elementor-hero-widget'),
                'hero_button_url' => [
                    'url' => '#',
                ],
            ],
        ],
        'condition' => [
            'slider_type' => 'hero_slider',
        ],
    ]
);

$this->end_controls_section();


		// Options Section
		$this->start_controls_section(
			'slider_options_section',
			[
				'label' => esc_html__( 'Slider Options', 'elementor-slider-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		// Number of Slides to Show at Once
		$this->add_control(
			'slides_to_show',
			[
				'label' => esc_html__( 'Slides to Show', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
				'min' => 1,
				'max' => 10,
			]
		);
		
		// Number of Slides to Scroll at Once (When Arrow is Clicked)
		$this->add_control(
			'slides_to_scroll',
			[
				'label' => esc_html__( 'Slides to Scroll', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
				'min' => 1,
				'max' => 10,
			]
		);
		
		// Arrow Navigation
		$this->add_control(
			'arrow_navigation',
			[
				'label' => esc_html__( 'Enable Arrows', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		// Dot Navigation
		$this->add_control(
			'dot_navigation',
			[
				'label' => esc_html__( 'Enable Dots', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		// Autoplay
		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Enable Autoplay', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		
		// Autoplay Speed (in milliseconds)
		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay Speed (ms)', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3000,
				'min' => 1000,
				'max' => 10000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);
		
		// Transition Speed (in milliseconds)
		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Transition Speed (ms)', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 600,
				'min' => 100,
				'max' => 5000,
			]
		);
		
		// Infinite Loop
		$this->add_control(
			'infinite',
			[
				'label' => esc_html__( 'Enable Infinite Loop', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Slider Style', 'elementor-slider-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'elementor-slider-widget' ),
				'selector' => '{{WRAPPER}} .slider-title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Content Typography', 'elementor-slider-widget' ),
				'selector' => '{{WRAPPER}} .slider-content',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .slider-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Content Color', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#666',
				'selectors' => [
					'{{WRAPPER}} .slider-content' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Button Color', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slider-button' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'button_background',
			[
				'label' => esc_html__( 'Button Background Color', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0073e6',
				'selectors' => [
					'{{WRAPPER}} .slider-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( 'Text Alignment', 'elementor-slider-widget' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-slider-widget' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-slider-widget' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-slider-widget' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .slider-title, {{WRAPPER}} .slider-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'slider_background',
				'label' => esc_html__( 'Slider Background', 'elementor-slider-widget' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slider-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__( 'Button Border', 'elementor-slider-widget' ),
				'selector' => '{{WRAPPER}} .slider-button',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'slider_shadow',
				'label' => esc_html__( 'Slider Shadow', 'elementor-slider-widget' ),
				'selector' => '{{WRAPPER}} .slider-wrapper',
			]
		);
		$this->end_controls_section();
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	
		// Generate a unique ID for each slider
		$unique_id = 'custom-slider-' . uniqid();
	
		$slider_type = $settings['slider_type'];
	
		echo '<div id="' . esc_attr($unique_id) . '" class="custom-slider-widget">';
	
		// Render Custom Post Slider
		if ($slider_type === 'custom_post') {
			$post_type = $settings['custom_post_type'];
			$category_slug = $settings['custom_post_category']; // Get the category slug from the settings
		
			// Prepare the tax_query to filter posts by category
			$tax_query = [];
			if (!empty($category_slug)) {
				$tax_query = [
					[
						'taxonomy' => 'category', // Assuming you're using the default 'category' taxonomy
						'field'    => 'slug',
						'terms'    => $category_slug,
					],
				];
			}
		
			$query = new WP_Query([
				'post_type' => $post_type,
				'posts_per_page' => -1,
				'tax_query' => $tax_query, // Add the tax_query to filter by category
			]);
		
			if ($query->have_posts()) {
				echo '<div class="swiper-container">';
				echo '<div class="swiper-wrapper">';
		
				while ($query->have_posts()) {
					$query->the_post();
		
					// Check if the post has a thumbnail, if not, use a placeholder
					$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : plugins_url( 'assets/images/placeholder.png', __FILE__ );
					?>
					<div class="swiper-slide slider-item">
						<img src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>">
						<h3><?php the_title(); ?></h3>
						<p style="font-size: 12px; color: #666;"><?php echo get_the_excerpt(); ?></p>
						<p><?php echo get_post_meta(get_the_ID(), 'price', true); ?></p>
						<p><?php echo get_post_meta(get_the_ID(), 'review', true); ?></p>
					</div>
					<?php
				}
		
				echo '</div>'; // swiper-wrapper
				echo '<div class="swiper-pagination"></div>';
				echo '<div class="swiper-button-next"></div>';
				echo '<div class="swiper-button-prev"></div>';
				echo '</div>'; // swiper-container
		
				wp_reset_postdata();
			}
		}
		
	
		// Render Custom Content Slider
		if ($slider_type === 'custom_content' && !empty($settings['custom_slides'])) {
			echo '<div class="swiper-container">';
			echo '<div class="swiper-wrapper">';
	
			foreach ($settings['custom_slides'] as $slide) {
				echo '<div class="swiper-slide slider-item">';
				
				if (!empty($slide['slide_image']['url'])) {
					echo '<div class="slider-image">';
					echo '<img src="' . esc_url($slide['slide_image']['url']) . '" alt="' . esc_attr($slide['slide_title']) . '">';
					echo '</div>';
				}
				
				if (!empty($slide['slide_title'])) {
					echo '<h3 class="slider-title">' . esc_html($slide['slide_title']) . '</h3>';
				}
				
				if (!empty($slide['slide_content'])) {
					echo '<p class="slider-content">' . esc_html($slide['slide_content']) . '</p>';
				}
				
				if (!empty($slide['slide_button_text']) && !empty($slide['slide_button_url']['url'])) {
					$button_target = $slide['slide_button_url']['is_external'] ? ' target="_blank"' : '';
					$button_nofollow = $slide['slide_button_url']['nofollow'] ? ' rel="nofollow"' : '';
					echo '<a class="slider-button" href="' . esc_url($slide['slide_button_url']['url']) . '"' . $button_target . $button_nofollow . '>';
					echo esc_html($slide['slide_button_text']);
					echo '</a>';
				}
	
				echo '</div>'; // swiper-slide
			}
	
			echo '</div>'; // swiper-wrapper
			echo '<div class="swiper-pagination"></div>';
			echo '<div class="swiper-button-next"></div>';
			echo '<div class="swiper-button-prev"></div>';
			echo '</div>'; // swiper-container
		}
	
		// Render Hero Slider
		if (!empty($settings['hero_slides'])) {
			echo '<div class="swiper-container">';
			echo '<div class="swiper-wrapper">';
			
			foreach ($settings['hero_slides'] as $slide) {
				echo '<div class="swiper-slide slider-item" style="background-image: url(' . esc_url($slide['hero_background_image']['url']) . ');">';
				echo '<div class="hero-slide-content">';
				echo '<h2 class="hero-title">' . esc_html($slide['hero_title']) . '</h2>';
				echo '<p class="hero-subtitle">' . esc_html($slide['hero_subtitle']) . '</p>';
				echo '<a href="' . esc_url($slide['hero_button_url']['url']) . '" class="hero-button">';
				echo esc_html($slide['hero_button_text']);
				echo '</a>';
				echo '</div>'; // hero-slide-content
				echo '</div>'; // swiper-slide
			}
	
			echo '</div>'; // swiper-wrapper
			echo '<div class="swiper-pagination"></div>';
			echo '<div class="swiper-button-next"></div>';
			echo '<div class="swiper-button-prev"></div>';
			echo '</div>'; // swiper-container
		}
	
		echo '</div>'; // Close custom-slider-widget
	
		// Dynamic JS for unique Swiper initialization
		echo "<script>
			jQuery(document).ready(function($) {
				var swiper = new Swiper('#" . esc_js($unique_id) . " .swiper-container', {
					slidesPerView: " . (!empty($settings['slides_to_show']) ? $settings['slides_to_show'] : 1) . ",
					slidesPerGroup: " . (!empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : 1) . ",
					loop: " . ($settings['infinite'] === 'yes' ? 'true' : 'false') . ",
					autoplay: " . ($settings['autoplay'] === 'yes' ? '{ delay: ' . (!empty($settings['autoplay_speed']) ? $settings['autoplay_speed'] : 3000) . ', disableOnInteraction: false }' : 'false') . ",
					speed: " . (!empty($settings['speed']) ? $settings['speed'] : 500) . ",
					spaceBetween: 20,
					navigation: {
						nextEl: '#" . esc_js($unique_id) . " .swiper-button-next',
						prevEl: '#" . esc_js($unique_id) . " .swiper-button-prev'
					},
					pagination: {
						el: '#" . esc_js($unique_id) . " .swiper-pagination',
						clickable: true
					},
					breakpoints: {
						1024: { slidesPerView: " . (!empty($settings['slides_to_show']) ? $settings['slides_to_show'] : 1) . ", slidesPerGroup: " . (!empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : 1) . " },
						768: { slidesPerView: " . (!empty($settings['slides_to_show']) ? $settings['slides_to_show'] : 1) . ", slidesPerGroup: " . (!empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : 1) . " },
						480: { slidesPerView: " . (!empty($settings['slides_to_show']) ? $settings['slides_to_show'] : 1) . ", slidesPerGroup: " . (!empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : 1) . " }
					}
				});
			});
		</script>";
	}
	
}
?>
<style>
	/* General Styles */
.slider-custom-content {
    width: 100%;
    position: relative;
    padding: 0;
    margin: 0 auto;
}

/* Swiper Styles */
.swiper-container {
    position: relative;
    width: 100%;
    height: auto;
	overflow: hidden;
}

.swiper-wrapper {
	display: flex;
    transition: transform 0.3s ease;
}

.swiper-slide {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-sizing: border-box;
}

/* Slide Content Styles */
.slider-item {
    text-align: center;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    position: relative;
}

.slider-title {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.slider-image img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.slider-content {
    font-size: 16px;
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.slider-button {
    display: inline-block;
    background-color: #0073e6;
    color: #fff;
    font-size: 16px;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.slider-button:hover {
    background-color: #005bb5;
}

/* Navigation Buttons */
.swiper-button-next,
.swiper-button-prev {
    position: absolute;
    top: 50%;
    width: 40px;
    height: 40px;
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    z-index: 10;
    transform: translateY(-50%);
    cursor: pointer;
}

.swiper-button-next {
    right: 10px;
}

.swiper-button-prev {
    left: 10px;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* Pagination */
.swiper-pagination {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10;
}

.swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    margin: 0 5px;
    background-color: #ccc;
    border-radius: 50%;
    transition: background-color 0.3s ease;
}

.swiper-pagination-bullet-active {
    background-color: #0073e6;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .slider-title {
        font-size: 20px;
    }

    .slider-content {
        font-size: 14px;
    }

    .slider-button {
        font-size: 14px;
        padding: 8px 16px;
    }
}

@media (max-width: 480px) {
    .swiper-container {
        width: 100%;
    }

    .slider-item {
        padding: 10px;
    }

    .slider-title {
        font-size: 18px;
    }

    .slider-button {
        font-size: 12px;
        padding: 6px 12px;
    }
}

</style>