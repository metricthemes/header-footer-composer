<?php
namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class HFC_Overlay_Nav_Widget extends Widget_Base {

	public function get_name() {
		return 'hfc-overlay-nav';
	}

	public function get_title() {
		return esc_html__( 'Overlay Nav Menu', 'open-commerce-pro' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
        return [ 'hfc-elementor-widgets' ];
	}
	
	/*
	*
	* Get all Available Menu in array.
	*/
	public function hfc_overlay_menu_array(){
	
			$hfc_menu_ed = wp_get_nav_menus();
			
			// Initate an empty array
			$menu_options = array();
			$menu_options['0'] = esc_attr__( 'Select a Menu', 'plugin-name' );
			
			if ( ! empty( $hfc_menu_ed ) ) {
				foreach ( $hfc_menu_ed as $menu ) {
						$menu_options[ $menu->term_id ] = $menu->name;    
				}
			}
			return $menu_options;
	}		

	protected function _register_controls() {
		$this->start_controls_section(
			'hfcoverlay_navmenu_section_tab', [
				'label' => esc_html__( 'Nav Menu', 'open-commerce-pro' ),
			]
		);			
		

		$this->add_control(
			'hfc_overlay_nav_ed',
			[
				'label' => __( 'Select Menu', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->hfc_overlay_menu_array(),
			]
		);
		
		$this->add_control(
			'hfc_overlay_nav_note',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<small>Please Go to the Dashboard >> Appereance >> Menus screen to manage your menus.', 'plugin-name' ),				
			]
		);						
		
		$this->add_responsive_control(
			'hfc_overlay_nav_align', [
				'label'			 =>esc_html__( 'Alignment', 'open-commerce-pro' ),
				'type'			 => Controls_Manager::CHOOSE,
				'default' 		 => 'right',
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'open-commerce-pro' ),
						'icon'	 => 'fa fa-align-left',
					],
					'none'	 => [
						'title'	 =>esc_html__( 'Center', 'open-commerce-pro' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'open-commerce-pro' ),
						'icon'	 => 'fa fa-align-right',
					],
				],
				'default'		 => '',
                'selectors' => [
                    '{{WRAPPER}} #trigger-overlay' => 'float: {{VALUE}};',
                ],
			]
		);										
																	
		$this->end_controls_section();
		
		$this->start_controls_section(
			'hfc_overlay_nav_style', [
				'label'	 => esc_html__( 'Main Menu', 'open-commerce-pro' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'hfc_overlay_nav_bgcolor',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'rgba(153,204,51,0.9)',
				'selectors' => [
					'{{WRAPPER}} .hfc-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);	
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hfc_overlay_nav_typography',
				'label' => __( 'Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .hfc-overlay ul li a',
			]
		);
		
		
		$this->add_control(
			'hfc_overlay_nav_line_three',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);						
		
		$this->start_controls_tabs(
			'hfc_overlay_nav_style_tabs'
		);		
		
		$this->start_controls_tab(
			'hfc_overlay_nav_style_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);		
		
		$this->add_control(
			'hfc_overlay_nav_style_normal_color',
			[
				'label' => __( 'Link Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hfc-overlay ul li a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_overlay_nav_style_normal_bgcolor',
			[
				'label' => __( 'Link Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hfc-overlay ul li a' => 'background-color: {{VALUE}}',
				],
			]
		);				
		
		$this->end_controls_tab();		
		
		$this->start_controls_tab(
			'hfc_overlay_nav_style_normal_tab_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);		
		
		$this->add_control(
			'hfc_overlay_nav_style_hover_color',
			[
				'label' => __( 'Hover Link Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-overlay ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_overlay_nav_style_hover_bgcolor',
			[
				'label' => __( 'Hover Link Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-overlay ul li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);		
		$this->end_controls_tab();													
		
		$this->end_controls_tabs();
		
		$this->add_control(
			'hfc_overlay_nav_line_four',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		
		
		$this->add_responsive_control(
			'hfc_overlay_nav_style_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-overlay ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'hfc_overlay_nav_style_margin',
			[
				'label' => __( 'Margin', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-overlay ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);						

		$this->end_controls_section();			
		
		//Toggle style
		$this->start_controls_section(
			'hfc_overlay_nav_toggle_style', [
				'label'	 => esc_html__( 'Toggle Button', 'open-commerce-pro' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);				
		
		$this->add_control(
			'hfc_overlay_nav_toggle_style_normal_color',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #trigger-overlay' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_overlay_nav_toggle_style_normal_bgcolor',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #trigger-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);				
		
		
		$this->add_control(
			'hfc_overlay_nav_line_seven',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);						
		
		$this->add_control(
			'hfc_overlay_nav_toggle_style_size',
			[
				'label' => __( 'Size', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'selectors' => [
					'{{WRAPPER}} #trigger-overlay' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);			
		
		$this->add_control(
			'hfc_overlay_nav_line_nine',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);					
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hfc_overlay_nav_toggle_style_border',
				'label' => __( 'Toggle Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} #trigger-overlay',
			]
		);		
		
		$this->add_responsive_control(
			'hfc_overlay_nav_toggle_style_border_radius',
			[
				'label' => __( 'Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #trigger-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		
		$this->add_responsive_control(
			'hfc_overlay_nav_toggle_style_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #trigger-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);										
		
		
		$this->end_controls_section();			

		
	}

	protected function render() {
		$settings = $this->get_settings();
		$hfc_menu_id = $settings[ 'hfc_overlay_nav_ed' ];				
	?>		    
                 
		<button id="trigger-overlay" type="button">
	        <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
        
		<div class="hfc-overlay hfc-overlay-hugeinc">
			<button type="button" class="overlay-close"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
	        <nav id="hfc-overlay-navbar" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">            
				<?php
                  wp_nav_menu(array(
                    'menu'	  => $hfc_menu_id,
                    'depth'   => 1,
                    'menu_class' => 'hfc-overlay-nav'
                    ));
                ?>
            </nav>            
		</div>
    
	<?php			
	}

	protected function _content_template() {
		
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new HFC_Overlay_Nav_Widget() );