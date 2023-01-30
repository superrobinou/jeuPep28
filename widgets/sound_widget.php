
<?php
class Sound_Widget extends \Elementor\Widget_Base {
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
        	$this->add_control(
			'list',
			[
				'label' => esc_html__( 'images et sons pour le jeu', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'image',
						'label' => esc_html__( 'Choissisez votre image', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],	
					],
					[
						'name' => 'son',
						'label' => esc_html__( 'Choissisez votre son', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
					],
				]
			
			]
		);

	$this->add_control(
			'hearts',
			[
				'label' => esc_html__( 'image pour la vie', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);
        $this->add_control(
			'audiofail',
			[
				'label' => esc_html__( 'son lorsque le joueur fail', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);
              $this->add_control(
			'audiowin',
			[
				'label' => esc_html__( 'son lorsque le joueur gagne', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
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
			'msg_rejouer',
			[
				'label' => esc_html__( 'message sur le bouton pour rejouer', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Entrez du texte', 'textdomain' ),
			]
		);
                $this->add_control(
			'lifes',
			[
				'label' => esc_html__( 'nombre de vies', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Entrez du texte', 'textdomain' ),
			]
		);
    }
    	protected function render() {
			//récupération des paramétres enregistrés
			$settings = $this->get_settings_for_display();
            	$imagesArray = array_column($settings['list'],'images');
		        $images = array_column($imagesArray,'url');
                $sonArray = array_column($settings['list'],'images');
		        $sons = array_column($sonArray,'url');
				$winSound=$settings["audiowin"];
				$looseSound=$settings["audiofail"];
				$winMsg=$settings["msg_win"];
				$looseMsg=$settings["msg_gameover"];
				$replayMsg=$settings["msg_rejouer"];
				$hearts=$settings["hearts"];
				$lifes=$settings["lifes"];
				echo '<div class="settings" data-win-sound="'.$winSound['url']."' data-fail-sound='".$looseSound['url'].'"></div>';
				echo '<div class="end"> <p class="win">'.$winMsg.'</p><p class="loose">'.$looseMsg.'</p><button>'
				.$replayMsg.'</button></div> <div class="soundImages">';		
                foreach ($images as $index => $item):
                    echo '<div class="item"> <button class="btn-sound">
					<image class="img-sound" src="'.$item.'" data-audiosrc="'.$sons[$index].'"></image></button></div>';
                endforeach;
				echo "</div>";
        }
    }