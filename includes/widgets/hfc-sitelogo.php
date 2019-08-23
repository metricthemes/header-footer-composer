<?php
namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class HFC_Site_Logo_Widget extends Widget_Base {

	public function get_name() {
		return 'hfc-site-logo';
	}

	public function get_title() {
		return esc_html__( 'Site Logo', 'header-footer-composer' );
	}

	public function get_icon() {
		return 'eicon-site-logo';
	}

	public function get_categories() {
        return [ 'hfc-elementor-widgets' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'hfc_logo_section_tab', [
				'label' => esc_html__( 'Site Logo', 'header-footer-composer' ),
			]
		);
		
		$this->add_control(
			'hfc_logo_note',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<small>Please upload your logo from Dashboard >> Customizer >> Site Identity. Your theme must support "custom-logo" for this to work.</small>', 'header-footer-composer' ),				
			]
		);		
		
		$this->add_responsive_control(
			'hfc_logo_align', [
				'label'			 =>esc_html__( 'Alignment', 'header-footer-composer' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'header-footer-composer' ),
						'icon'	 => 'fa fa-align-right',
					],
				],
				'default'		 => '',
                'selectors' => [
                    '{{WRAPPER}} .hfc-site-logo' => 'text-align: {{VALUE}};',
                ],
			]
		);
		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'hfc_site_logo_style', [
				'label'	 => esc_html__( 'Logo', 'header-footer-composer' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'hfc_site_logo_width',
			[
				'label' => __( 'Width', 'header-footer-composer' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .hfc-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hfc_site_logo_border',
				'label' => __( 'Border', 'header-footer-composer' ),
				'selector' => '{{WRAPPER}} .hfc-site-logo img',
			]
		);		
		
		$this->add_responsive_control(
			'hfc_site_logo_border_padding',
			[
				'label' => __( 'Padding', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-site-logo img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_site_logo_border_marging',
			[
				'label' => __( 'Margin', 'header-footer-composer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-site-logo img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		

		$this->end_controls_section();
	      

	}

	protected function render() {
		$settings = $this->get_settings();					
		echo '<div class="site-branding hfc-site-logo">';
			the_custom_logo();
		echo '</div>';
		
	}

	protected function _content_template() {
		
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new HFC_Site_Logo_Widget() );