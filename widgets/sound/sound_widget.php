
<?php
class Sound_Widget extends \Elementor\Widget_Base {
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		wp_register_script('sound_widget_js', plugins_url('sound_widget.js', __FILE__));
		wp_register_style('sound_widget_css', plugins_url('sound_widget.css', __FILE__));
	}
    public function get_name() {
		return 'sound_widget';
	}

	//titre du widget
	public function get_title() {
		return esc_html__( 'sound widget', 'sound_widget' );
	}

	//icone représentant le widget
	public function get_icon() {
		return 'eicon-code';
	}

	//catégorie du widget
	public function get_categories() {
		return [ 'basic' ];
	}

	//mot clés pour le widget
	public function get_keywords() {
		return [ 'sound' ];
	}
    
	protected function register_controls() {
        	$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Contenu', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'son',
			[
				'label' => esc_html__('Content', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_type'=>'audio',
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Content', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'list',
			[
				'label' => esc_html__('liste de son et images', 'textdomain'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
        $this->add_control(
			'audiofail',
			[
				'label' => esc_html__( 'son lorsque le joueur perd', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_type'=> array('audio')
			]
		);
              $this->add_control(
			'audiowin',
			[
				'label' => esc_html__( 'son lorsque le joueur gagne', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_type' => array('audio')
			]
		);
        $this->add_control(
			'msg_gameover',
			[
				'label' => esc_html__( 'message quand le joueur perd', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Entrez du texte', 'textdomain' ),
			]
		);
        	$this->add_control('msg_win',
			[
				'label' => esc_html__( 'message quand le joueur gagne', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Entrez du texte', 'textdomain' ),
			]
		);
                $this->add_control(
			'lifes',
			[
				'label' => esc_html__( 'nombre de vies', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default'=>1,
			]
		);
    }
	public function get_script_depends()
	{
		return ['sound_widget_js'];
	}
	//dépédences fichier css
	public function get_style_depends()
	{
		return ['sound_widget_css'];
	}
    	protected function render() {
			//récupération des paramétres enregistrés
			$settings = $this->get_settings_for_display();
			$list=$settings['list'];
				$winSound=$settings["audiowin"];
				$looseSound=$settings["audiofail"];
				$winMsg=$settings["msg_win"];
				$looseMsg=$settings["msg_gameover"];
				$lifes=$settings["lifes"];
				$firstAudio=array_rand($list);
		echo '<div id="win"><p class="wl">' . $winMsg . '</div>';
		echo '<div id="loose"><p id="l1">' . $looseMsg . '</div>';
		echo '<div class="hearts"><p id="hl">Vies: 	'.$lifes.'/'.$lifes.'</p></div>';
		echo '<div class="audioPlayer"><audio id="audioControls" controls src="'.$list[$firstAudio]['son']['url'].'"></audio></div>';
		echo '<div id="sound_widget" data-winSound="'.$winSound['url'].'" data-looseSound="'
		.$looseSound['url'].'" data-life="'.$lifes.'">';
		foreach ($list as $index => $item):
			echo '<div class="item"><button class="btn-choose" data-linked-audio="' . $item['son']['url'] . '"><img src="' . $item['image']['url']. '"></img></button></div>';
		endforeach;
		echo '</div>';
        }
    }