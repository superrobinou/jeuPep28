<?php
class Memory_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'memory_widget';
	}

	public function get_title() {
		return esc_html__( 'memory widget', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'jeux' ];
	}

	public function get_keywords() {
		return [ 'memory' ];
	}

    
	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
				[
				'name'=>'images',
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
				],
			
			]
		);
		$this->add_control(
			'face',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'win',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();


		// Style Tab End

	}
 
    	public function get_script_depends() {
		return [ 'memory_widget_js' ];
	}
    	public function get_style_depends() {
		return [ 'memory_widget_css' ];
	}
	protected function render() {
	
		?>
		<?php
			$settings = $this->get_settings_for_display();
		$list = array_column($settings['list'],'images');
		$list = array_column($list,'url');
		 array_push($list, ...$list);
		shuffle($list);
							echo '<div class="win"><p class="legend">Bravo, vous avez gagné!</p> <button class="replay">rejouer</button></div>';
		echo '<div id="memorygame" data-win="' . $settings['win']['url'] . '" data-face="' . $settings['face']['url'] . '">';
		foreach ($list as $index => $item):
			echo '<div class="divBack"><button class="memory-button"><img src="'.$settings['face']['url'].'" data-realImage="'.$item.
			'" data-isShowed="false"></img></button></div>';
		endforeach;

		?>
</div>

		<?php
	}
}

?>