<?php
namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class HFC_Nav_Menu_Widget extends Widget_Base {

	public function get_name() {
		return 'hfc-nav-menu';
	}

	public function get_title() {
		return esc_html__( 'Nav Menu', 'open-commerce-pro' );
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
	public function hfc_menu_array(){
	
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
			'hfc_navmenu_section_tab', [
				'label' => esc_html__( 'Nav Menu', 'open-commerce-pro' ),
			]
		);			
		

		$this->add_control(
			'hfc_nav_menu_ed',
			[
				'label' => __( 'Select Menu', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->hfc_menu_array(),
			]
		);
		
		$this->add_control(
			'hfc_nav_menu_note',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<small>Please Go to the Dashboard >> Appereance >> Menus screen to manage your menus.', 'plugin-name' ),				
			]
		);			
		
		$this->add_control(
			'hfc_nav_menu_line_one',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_layout',
			[
				'label' => __( 'Menu Layout', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal'  => __( 'Horizontal', 'plugin-domain' ),
					'vertical' => __( 'Vertical', 'plugin-domain' ),
					'toggle' => __( 'Toggle', 'plugin-domain' ),					
				],
			]
		);	
		
		$this->add_responsive_control(
			'hfc_nav_menu_align', [
				'label'			 =>esc_html__( 'Alignment', 'open-commerce-pro' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'open-commerce-pro' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
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
                    '{{WRAPPER}} .hfc-navbar > ul.hfc-nav-menu-top' => 'text-align: {{VALUE}};',
                ],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_dropdown_icon',
			[
				'label' => __( 'Dropdown Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '\f0d7',
				'options' => [
					'\f0d7'  => __( 'Classic', 'plugin-domain' ),
					'\f078' => __( 'Chevron', 'plugin-domain' ),
					'\f107' => __( 'Angle', 'plugin-domain' ),					
					'\f067' => __( 'Plus', 'plugin-domain' ),										
					'' => __( 'None', 'plugin-domain' ),															
				],
                'selectors' => [
                    '{{WRAPPER}} .hfc-navbar > ul > li.has-sub > a:after' => 'content: "{{VALUE}}";',
                ],								
			]
		);						
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_align', [
				'label'			 =>esc_html__( 'Submenu Alignment', 'open-commerce-pro' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'open-commerce-pro' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
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
                    '{{WRAPPER}} .hfc-navbar > ul li ul' => 'text-align: {{VALUE}};',
                ],
			]
		);		
		
		
		
		$this->add_control(
			'hfc_nav_menu_line_two',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);			
		
		$this->add_control(
			'hfc_nav_menu_mobile_header',
			[
				'label' => __( 'Mobile Options', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);		
					
		$this->add_control(
			'hfc_nav_menu_mobile_breakpoint',
			[
				'label' => __( 'Mobile Breakpoint', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1024',
				'options' => [
					'768'  => __( 'Mobile - < 768px', 'plugin-domain' ),
					'1024' => __( 'Table - < 1024px', 'plugin-domain' ),
					'none' => __( 'None', 'plugin-domain' ),															
				],
			]
		);										
									

		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'hfc_nav_menu_style', [
				'label'	 => esc_html__( 'Main Menu', 'open-commerce-pro' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'hfc_nav_menu_bgcolor',
			[
				'label' => __( 'Navbar Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#191919',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar' => 'background-color: {{VALUE}}',
				],
			]
		);	
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hfc_nav_menu_typography',
				'label' => __( 'Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .hfc-navbar > ul > li > a',
			]
		);
		
		
		$this->add_control(
			'hfc_nav_menu_line_three',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);						
		
		$this->start_controls_tabs(
			'hfc_nav_menu_style_tabs'
		);		
		
		$this->start_controls_tab(
			'hfc_nav_menu_style_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_style_normal_color',
			[
				'label' => __( 'Link Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_style_normal_bgcolor',
			[
				'label' => __( 'Link Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a' => 'background-color: {{VALUE}}',
				],
			]
		);				
		
		$this->end_controls_tab();		
		
		$this->start_controls_tab(
			'hfc_nav_menu_style_normal_tab_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_style_hover_color',
			[
				'label' => __( 'Hover Link Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a:hover' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_style_hover_bgcolor',
			[
				'label' => __( 'Hover Link Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);		
		$this->end_controls_tab();				
		
		$this->start_controls_tab(
			'hfc_nav_menu_style_normal_tab_active_tab',
			[
				'label' => __( 'Active', 'plugin-name' ),
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_style_active_color',
			[
				'label' => __( 'Active Link Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li.current-menu-item > a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_style_active_bgcolor',
			[
				'label' => __( 'Active Link Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li.current-menu-item > a' => 'background-color: {{VALUE}}',
				],
			]
		);		
		
		$this->end_controls_tab();						
		
		$this->end_controls_tabs();
		
		$this->add_control(
			'hfc_nav_menu_line_four',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'hfc_nav_menu_style_margin',
			[
				'label' => __( 'Margin', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar > ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);						

		$this->end_controls_section();
		
		//Dropdown Style
		$this->start_controls_section(
			'hfc_nav_menu_dropdown_style', [
				'label'	 => esc_html__( 'Dropdown', 'open-commerce-pro' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);				
		
		$this->add_control(
			'hfc_nav_menu_dropdown_bgcolor',
			[
				'label' => __( 'Dropdown Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#191919',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul' => 'background-color: {{VALUE}}',
				],
			]
		);			
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hfc_nav_menu_dropdown_typography',
				'label' => __( 'Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .hfc-navbar ul ul li a',
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_line_eight',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);			
		
		$this->start_controls_tabs(
			'hfc_nav_menu_dropdown_style_tabs'
		);		
		
		$this->start_controls_tab(
			'hfc_nav_menu_dropdown_style_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_dropdown_style_normal_color',
			[
				'label' => __( 'Link Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,				
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_dropdown_style_normal_bgcolor',
			[
				'label' => __( 'Link Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#191919',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a' => 'background-color: {{VALUE}}',
				],
			]
		);				
		
		$this->end_controls_tab();		
		
		$this->start_controls_tab(
			'hfc_nav_menu_dropdown_style_normal_tab_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_dropdown_style_hover_color',
			[
				'label' => __( 'Hover Link Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_dropdown_style_hover_bgcolor',
			[
				'label' => __( 'Hover Link Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);		
		$this->end_controls_tab();				
		
		$this->start_controls_tab(
			'hfc_nav_menu_dropdown_style_normal_tab_active_tab',
			[
				'label' => __( 'Active', 'plugin-name' ),
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_dropdown_style_active_color',
			[
				'label' => __( 'Active Link Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li.current-menu-item a' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_dropdown_style_active_bgcolor',
			[
				'label' => __( 'Active Link Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li.current-menu-item a' => 'background-color: {{VALUE}}',
				],
			]
		);		
		
		$this->end_controls_tab();						
		
		$this->end_controls_tabs();		
		
		$this->add_control(
			'hfc_nav_menu_line_five',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);						

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hfc_nav_menu_dropdown_style_link_border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .hfc-navbar ul ul',
			]
		);
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_link_border_radius',
			[
				'label' => __( 'Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'hfc_nav_menu_dropdown_style_margin',
			[
				'label' => __( 'Margin', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar ul ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);								
				
		$this->end_controls_section();		
		
		//Toggle style
		$this->start_controls_section(
			'hfc_nav_menu_toggle_style', [
				'label'	 => esc_html__( 'Toggle Button', 'open-commerce-pro' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);				
		
		$this->add_control(
			'hfc_nav_menu_toggle_style_normal_color',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar #menu-button' => 'color: {{VALUE}}',
				],
			]
		);		
		
		$this->add_control(
			'hfc_nav_menu_toggle_style_normal_bgcolor',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar #menu-button' => 'background-color: {{VALUE}}',
				],
			]
		);				
		
		
		$this->add_control(
			'hfc_nav_menu_line_seven',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);						
		
		$this->add_control(
			'hfc_nav_menu_toggle_style_size',
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
					'{{WRAPPER}} .hfc-navbar #menu-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'hfc_nav_menu_toggle_style_align', [
				'label'			 =>esc_html__( 'Alignment', 'open-commerce-pro' ),
				'type'			 => Controls_Manager::CHOOSE,
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
				'default'		 => 'none',
                'selectors' => [
                    '{{WRAPPER}} .hfc-navbar #menu-button' => 'float: {{VALUE}};',
                ],
			]
		);			
		
		$this->add_control(
			'hfc_nav_menu_line_nine',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);					
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hfc_nav_menu_toggle_style_border',
				'label' => __( 'Toggle Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .hfc-navbar #menu-button',
			]
		);		
		
		$this->add_responsive_control(
			'hfc_nav_menu_toggle_style_border_radius',
			[
				'label' => __( 'Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar #menu-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		
		$this->add_responsive_control(
			'hfc_nav_menu_toggle_style_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hfc-navbar #menu-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);										
		
		
		$this->end_controls_section();		
	      

	}

	protected function render() {
		$settings = $this->get_settings();
		$hfc_menu_id = $settings[ 'hfc_nav_menu_ed' ];				
	?>		    
    
	        <nav id="hfc-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">            
				<?php
                  wp_nav_menu(array(
                    'menu'	  => $hfc_menu_id,
                    'depth'   => 0,
                    'container_class' => 'hfc-navbar',
                    'menu_class' => 'hfc-nav-menu-top'
                    ));
                ?>
            </nav>                

	<?php		
	}

	protected function _content_template() {
		
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new HFC_Nav_Menu_Widget() );