<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Timeline Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use \Elementor\Scheme_Typography;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;

class Elementor_Timeline_Widget extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve Timeline widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'evtimeline';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Timeline widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Timeline', 'ev-timeline');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Timeline widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Timeline widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['basic'];
	}

	/**
	 * Register Timeline widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Widget Title', 'ev-timeline'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_title',
			[
				'label' => esc_html__('Title', 'ev-timeline'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title of widget', 'ev-timeline'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __('Typography', 'ev-timeline'),
				'selector' => '{{WRAPPER}} .widgetTitle',
			]
		);

		$this->add_responsive_control(
			'widget_title_alignment',
			[
				'label' => __('Title Alignment', 'ev-timeline'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'ev-timeline'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'ev-timeline'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'ev-timeline'),
						'icon' => 'fa fa-align-right',
					]
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .widgetTitle' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'widget_title_color',
			[
				'label' => __('Color', 'ev-timeline'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widgetTitle' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_responsive_control(
			'widgetTitle_margin',
			[
				'label' => __( 'Margins', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .widgetTitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'widgetTitle_padding',
			[
				'label' => __( 'Paddings', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .widgetTitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//TIME LINE ITEMS
		$this->start_controls_section(
			'timeline_section',
			[
				'label' => __('Timeline Content', 'ev-timeline'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title_right_elements',
			[
				'label' => __('Elements of the right', 'ev-timeline'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'right_items_aligment',
			[
				'label' => __('Right Items Alignment', 'ev-timeline'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'ev-timeline'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'ev-timeline'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'ev-timeline'),
						'icon' => 'fa fa-align-right',
					]
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .right-item , {{WRAPPER}} {{CURRENT_ITEM}} .right-item .item-title, {{WRAPPER}} {{CURRENT_ITEM}} .right-item .item-content' => 'text-align: {{VALUE}};',
				]
			]
		);

		$repeater->add_control(
			'item_right_title',
			[
				'label' => __('Right Title', 'ev-timeline'),
				'type' => Controls_Manager::TEXT,
				'default' => __('List Title', 'ev-timeline'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_right_content',
			[
				'label' => __('Right Content', 'ev-timeline'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('List Content', 'ev-timeline'),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'right_image',
			[
				'label' => __('Right Image', 'ev-timeline'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'title_left_elements',
			[
				'label' => __('Elements of the left', 'ev-timeline'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'left_items_aligment',
			[
				'label' => __('Right Items Alignment', 'ev-timeline'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'ev-timeline'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'ev-timeline'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'ev-timeline'),
						'icon' => 'fa fa-align-right',
					]
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .left-item, {{WRAPPER}} {{CURRENT_ITEM}} .left-item .item-title, {{WRAPPER}} {{CURRENT_ITEM}} .left-item .item-content' => 'text-align: {{VALUE}};',
				]
			]
		);

		$repeater->add_control(
			'item_left_title',
			[
				'label' => __('Left Title', 'ev-timeline'),
				'type' => Controls_Manager::TEXT,
				'default' => __('List Title', 'ev-timeline'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_left_content',
			[
				'label' => __('Left Content', 'ev-timeline'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('List Content', 'ev-timeline'),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'left_image',
			[
				'label' => __('Left Image', 'ev-timeline'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'reverse_row',
			[
				'label' => __( 'Reverse Row in Mobile', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => true,
				'default' => false,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __('Repeater List', 'ev-timeline'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ item_right_title }}} - {{{ item_left_title }}}',
			]
		);

		$this->end_controls_section();

		//TIME LINE ITEM STYLEES
		$this->start_controls_section(
			'item_containerLine_styles',
			[
			'label'  => __( 'Items Container Styles', 'ev-timeline' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_containerLine_margin',
			[
				'label' => __( 'Margins', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ev-timeline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] 
		);

		$this->add_responsive_control(
			'item_containerLine_padding',
			[
				'label' => __( 'Paddings', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ev-timeline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//TIME LINE ITEM STYLEES
		$this->start_controls_section(
			'item_line_styles',
			[
			'label'  => __( 'Items Styles', 'ev-timeline' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_line_margin',
			[
				'label' => __( 'Margins', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .timeline-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_line_padding',
			[
				'label' => __( 'Paddings', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .timeline-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//TITLE STYLES
		$this->start_controls_section(
			'tabs_styles',
			[
			'label'  => __( 'Title Styles', 'ev-timeline' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'titles_stylee',
			[
				'label' => __('Title Color', 'ev-timeline'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-title' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Title Typography', 'ev-timeline'),
				'selector' => '{{WRAPPER}} .item-title',
			]
		);
		$this->add_responsive_control(
			'title_aligment',
			[
				'label' => __('Title Alignment', 'ev-timeline'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'ev-timeline'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'ev-timeline'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'ev-timeline'),
						'icon' => 'fa fa-align-right',
					]
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .item-title' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margins', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Margins', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//CONTENT STYLES
		$this->start_controls_section(
			'content_styles',
			[
			'label'  => __( 'Content Styles', 'ev-timeline' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_stylee',
			[
				'label' => __('Content Color', 'ev-timeline'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-content' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 't_content_typography',
				'label' => __('Content Typography', 'ev-timeline'),
				'selector' => '{{WRAPPER}} .item-content',
			]
		);
		$this->add_responsive_control(
			'content_aligment',
			[
				'label' => __('Content Alignment', 'ev-timeline'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'ev-timeline'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'ev-timeline'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'ev-timeline'),
						'icon' => 'fa fa-align-right',
					]
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .item-content' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => __( 'Margins', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .item-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Paddings', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Timeline widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{

		$settings = $this->get_settings_for_display();


		echo '<h2 class="widgetTitle" >';
		echo  $settings['widget_title'];
		echo '</h2>';

		if ($settings['list']) { ?>
			<div class="ev-timeline">
				<div class="line-time"></div>
				<div class="line-time-scroll"></div>
				<?php
				foreach ($settings['list'] as $item) {
				?>
					<div class="elementor-repeater-item-<?= $item['_id'] ?> timeline-item <?php if($item['reverse_row'] == true) { echo 'reverse-row'; } ?>">
						<div class="pointer"></div>
						<div class="left-item">
							<?php if (!empty($item['item_left_title'])) : ?>
								<h2 class="item-title"><div class="pointer"></div> <?= $item['item_left_title'] ?></h2>
							<?php endif; ?>
							<?php if (!empty($item['item_left_content'])) : ?>
								<p class="item-content"> <?= $item['item_left_content'] ?></p>
							<?php endif; ?>

							<?php if (!empty($item['left_image']['id'])) : ?>
								<img src="<?= esc_url($item['left_image']['url']) ?>" alt="<?= esc_attr(get_post_meta($item['left_image']['id'], '_wp_attachment_image_alt', true)) ?>">
							<?php endif; ?>
						</div>
						<div class="right-item">
							<?php if (!empty($item['item_right_title'])) : ?>
								<h2 class="item-title"><div class="pointer"></div> <?= $item['item_right_title'] ?></h2>
							<?php endif; ?>
							<?php if (!empty($item['item_right_content'])) : ?>
								<p class="item-content"> <?= $item['item_right_content'] ?></p>
							<?php endif; ?>

							<?php if (!empty($item['right_image']['id'])) : ?>
								<img src="<?= esc_url($item['right_image']['url']) ?>" alt="<?= esc_attr(get_post_meta($item['right_image']['id'], '_wp_attachment_image_alt', true)) ?>">
							<?php endif; ?>
						</div>
					</div>
				<?php
				} ?>
			</div> 
			<?php
		}
	}
}
