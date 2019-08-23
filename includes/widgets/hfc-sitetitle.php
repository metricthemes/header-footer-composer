<?php
namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class HFC_Site_Title_Widget extends Widget_Base {

	public function get_name() {
		return 'hfc-site-title';
	}

	public function get_title() {
		return esc_html__( 'Site Title', 'header-footer-composer' );
	}

	public function get_icon() {
		return 'eicon-site-title';
	}

	public function get_categories() {
        return [ 'hfc-elementor-widgets' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'hfc_title_section_tab', [
				'label' => esc_html__( 'Site Title', 'header-footer-composer' ),
			]
		);		
		
		$this->add_control(
			'hfc_site_title_description_ed',
			[
				'label' => __( 'Show Site Description', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'header-footer-composer' ),
				'label_off' => __( 'Hide', 'header-footer-composer' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);		
		
		$this->add_control(
			'hfc_site_title_line_one',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);							

		$this->add_control(
			'hfc_site_title_html',
			[
				'label' => __( 'HTML Tag', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1'  => __( 'H1', 'header-footer-composer' ),
					'h2' => __( 'H2', 'header-footer-composer' ),
					'h3' => __( 'H3', 'header-footer-composer' ),
					'h4' => __( 'H4', 'header-footer-composer' ),
					'h5' => __( 'H5', 'header-footer-composer' ),
					'h6' => __( 'H6', 'header-footer-composer' ),
					'div' => __( 'div', 'header-footer-composer' ),
					'span' => __( 'span', 'header-footer-composer' ),
					'p' => __( 'p', 'header-footer-composer' ),
				],
			]
		);											

		$this->add_responsive_control(
			'hfc_title_align', [
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
                    '{{WRAPPER}} .hfc-site-title' => 'text-align: {{VALUE}};',
                ],
			]
		);
		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'hfc_site_title_style', [
				'label'	 => esc_html__( 'Site Title', 'header-footer-composer' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);		
		

		$this->add_control(
			'hfc_site_title_color',
			[
				'label' => __( 'Title Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .hfc-site-title a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hfc_site_title_typography',
				'label' => __( 'Typography', 'header-footer-composer' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .hfc-site-title a',
			]
		);						

		$this->end_controls_section();
		
		//Site Description Style Section
		$this->start_controls_section(
			'hfc_site_description_style', [
				'label'	 => esc_html__( 'Site Description', 'header-footer-composer' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'hfc_site_title_description_ed' => 'yes',
                ]				
			]
		);		
		

		$this->add_control(
			'hfc_site_description_color',
			[
				'label' => __( 'Color', 'header-footer-composer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .hfc-site-title p.site-description' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hfc_site_description_typography',
				'label' => __( 'Typography', 'header-footer-composer' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .hfc-site-title p.site-description',
			]
		);						

		$this->end_controls_section();		
	      

	}

	protected function render() {
		$settings = $this->get_settings();
		$hfc_site_description_ed = $settings[ 'hfc_site_title_description_ed' ];
		$hfc_site_title_html = $settings[ 'hfc_site_title_html' ];		
		?>
			
            <div class="site-branding hfc-site-title">
				<<?php echo $hfc_site_title_html; ?> class="site-title">
                	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </<?php echo esc_attr($hfc_site_title_html); ?>>
				<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description && $hfc_site_description_ed ) : ?>
					<p class="site-description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
		  	</div>			
          
		<?php		
	}

	protected function _content_template() {
		
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new HFC_Site_Title_Widget() );