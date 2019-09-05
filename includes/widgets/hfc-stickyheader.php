<?php
if ( !defined( 'ABSPATH' ) )
exit;

function hfc_sticky_header ( $section, $args ) {
	$section->start_controls_section(
		'section_custom_class',
		[
			'label' => esc_html__( 'Sticky Header', 'header-footer-composer' ),
			'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
		]
	);

	$section->add_control(
		'hfc_sticky_header_ed',
		[
			'label'					=> esc_html__( 'Enable Sticky Header', 'header-footer-composer' ),
			'type'					=> Elementor\Controls_Manager::SWITCHER,
			'label_on'				=> esc_html__( 'On', 'header-footer-composer' ),
			'label_off'				=> esc_html__( 'Off', 'header-footer-composer' ),
			'return_value'			=> 'on',
			'default'				=> '',
			'frontend_available'	=> true,				
			'prefix_class'			=> 'hfc-sticky-header-'
		]
	);
	
	$section->add_control(
			'hfc_sticky_header_devices',
			[
				'label' => esc_html__( 'Enabled On', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => 'true',				
				'frontend_available' => true,								
				'multiple' => true,
				'options' => [
					'desktop'  => esc_html__( 'Desktop', 'header-footer-composer' ),
					'tablet' => esc_html__( 'Tablet', 'header-footer-composer' ),
					'mobile' => esc_html__( 'Mobile', 'header-footer-composer' ),
				],
				'default' => [ 'desktop', 'tablet', 'mobile' ],
				'condition' => [				    
					'hfc_sticky_header_ed!' => '',
				],				
			]
	);	
	
	$section->add_control(
		'hfc_sticky_header_line_one',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
			'condition' => [				    
				'hfc_sticky_header_ed!' => '',
			],							
		]
	);	
		
	$section->add_responsive_control(
		'hfc_sticky_header_scroll_top',
		[
			'label' => esc_html__( 'Scroll Distance (px)', 'header-footer-composer' ),
			'type'         => Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 2500,
				],
			],
			'size_units' => [ 'px'],				
			'description' => esc_html__( 'Choose the scroll distance to enable Sticky Header Effects', 'header-footer-composer' ),
			'frontend_available' => true,
			'condition' => [				    
				'hfc_sticky_header_ed!' => '',
			],							
		]
	);
	
	$section->add_control(
		'hfc_sticky_header_line_two',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
			'condition' => [				    
				'hfc_sticky_header_ed!' => '',
			],				
			
		]
	);		
	
	$section->add_control(
			'hfc_sticky_header_bgcolor',
			[
				'label' => esc_html__( 'Background Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'frontend_available' => true,				
				'condition' => [				    
					'hfc_sticky_header_ed!' => '',
				],								
			]
	);
	
	$section->add_control(
		'hfc_sticky_header_line_three',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
			'condition' => [				    
				'hfc_sticky_header_ed!' => '',
			],							
		]
	);		
	
	$section->add_control(
		'hfc_sticky_header_border_ed',
		[
			'label'        => esc_html__( 'Bottom Border', 'header-footer-composer' ),
			'type'         => Elementor\Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'On', 'header-footer-composer' ),
			'label_off' => esc_html__( 'Off', 'header-footer-composer' ),
			'return_value' => 'on',
			'default' => '',
			'frontend_available' => true,				
			'prefix_class'  => '',
			'condition' => [				    
				'hfc_sticky_header_ed!' => '',
			],				
			
		]
	);
	
	$section->add_control(
			'hfc_sticky_header_border_color',
			[
				'label' => esc_html__( 'Border Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'frontend_available' => true,				
				'condition' => [				    
					'hfc_sticky_header_ed!' => '',
					'hfc_sticky_header_border_ed!' => '',
				],								
			]
	);		
	
	$section->add_responsive_control(
		'hfc_sticky_header_border_size',
		[
			'label' => esc_html__( 'Border Size (px)', 'header-footer-composer' ),
			'type'         => Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'size_units' => [ 'px'],				
			'description' => esc_html__( 'Only adds bottom border to the sticky header.', 'header-footer-composer' ),
			'frontend_available' => true,
			'condition' => [				    
				'hfc_sticky_header_ed!' => '',
				'hfc_sticky_header_border_ed!' => '',				
			],				
			
		]
	);	
		
	$section->add_control(
		'hfc_sticky_header_line_four',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
			'condition' => [				    
				'hfc_sticky_header_ed!' => '',
			],							
		]
	);	
		
	
	$section->end_controls_section();			
}
add_action('elementor/element/section/section_advanced/after_section_end', 'hfc_sticky_header', 10, 2);