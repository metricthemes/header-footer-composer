<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class MT_Title_Widget extends Widget_Base {

	public function get_name() {
		return 'mt-title';
	}

	public function get_title() {
		return esc_html__( 'MT Custom Title', 'open-commerce-pro' );
	}

	public function get_icon() {
		return 'eicon-type-tool';
	}

	public function get_categories() {
        return [ 'metric-themes-widgets' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' =>esc_html__( 'Title Settings', 'open-commerce-pro' ),
			]
		);

		$this->add_control(
			'title_text', [
				'label'			 =>esc_html__( 'Heading Title', 'open-commerce-pro' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Featured Products', 'open-commerce-pro' ),
				'default'		 =>esc_html__( 'Featured Products', 'open-commerce-pro' ),
			]
		);

		$this->add_control(
			'sub_title', [
				'label'			 =>esc_html__( 'Heading Sub Title', 'open-commerce-pro' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Shop Collections', 'open-commerce-pro' ),
				'default'		 =>esc_html__( 'Shop Collections', 'open-commerce-pro' ),
			]
		);

        $this->add_control(
            'desc_title', [
                'label'			 =>esc_html__( 'Description', 'open-commerce-pro' ),
                'type'			 => Controls_Manager::TEXTAREA,
                'label_block'	 => true,
                'placeholder'	 =>esc_html__( 'Shop Description', 'open-commerce-pro' ),
                'default'		 =>esc_html__( 'Shop Description', 'open-commerce-pro' ),
            ]
        );


		$this->add_responsive_control(
			'title_align', [
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
					'justify'	 => [
						'title'	 =>esc_html__( 'Justified', 'open-commerce-pro' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => '',
                'selectors' => [
                    '{{WRAPPER}} .mt-heading' => 'text-align: {{VALUE}};',
                ],
			]
		);
		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'section_title_style', [
				'label'	 => esc_html__( 'Title', 'open-commerce-pro' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color', [
				'label'		 =>esc_html__( 'Title color', 'open-commerce-pro' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .mt-title' => 'color: {{VALUE}};'
				],
			]
		);

        $this->add_control(
            'title_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'open-commerce-pro' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .mt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .mt-title',
			]
		);

		$this->end_controls_section();

		//Subtitle Style Section
		$this->start_controls_section(
			'section_subtitle_style', [
				'label'	 => esc_html__( 'Sub Title', 'open-commerce-pro' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color', [
				'label'		 => esc_html__( 'color', 'open-commerce-pro' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .mt-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'subtitle_typography',
			'selector'	 => '{{WRAPPER}} .mt-subtitle',
			]
		);

        $this->add_control(
            'subtitle_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'open-commerce-pro' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .mt-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //Description Style Section
        $this->start_controls_section(
            'section_description_style', [
                'label'	 => esc_html__( 'Description Title', 'open-commerce-pro' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_color', [
                'label'		 => esc_html__( 'color', 'open-commerce-pro' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .mt-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'desc_typography',
                'selector'	 => '{{WRAPPER}} .mt-description',
            ]
        );

        $this->add_control(
            'desctitle_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'open-commerce-pro' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .mt-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();        

	}

	protected function render() {
		$settings = $this->get_settings();
		
		$title = $settings[ 'title_text' ];
		$sub_title = $settings[ 'sub_title' ];
		$desc_title = $settings[ 'desc_title' ];
		?>
			
            <div class="mt-heading">
				<?php if(!empty($sub_title)): ?>
					<h2 class="mt-subtitle"><?php echo esc_html( $sub_title ); ?></h2>
				<?php endif; ?>
				<?php if(!empty($title)): ?>
				<h3 class="mt-title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>
				<?php if(!empty($desc_title)): ?>
				 <p class="mt-description lead"><?php echo esc_html($desc_title); ?></p>
				<?php endif; ?>
			</div>
            
		<?php
	}

	protected function _content_template() {
		
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new MT_Title_Widget() );