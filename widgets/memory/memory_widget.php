<?php
//fichier de définition du widget de memory
class Memory_Widget extends \Elementor\Widget_Base {
	//le nom du widget
	public function get_name() {
		return 'memory_widget';
	}

	//titre du widget
	public function get_title() {
		return esc_html__( 'memory widget', 'memory_widget' );
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
		return [ 'memory' ];
	}

    
	//enregistrement des options de configuration du widget
	protected function register_controls() {

		// Content Tab Start
		//section pour le contenu
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Contenu', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//ajout des options des widgets
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'images pour les cartes', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
				[
				'name'=>'images',
				'label' => esc_html__( 'Choississez votre image', 'textdomain' ),
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
				'label' => esc_html__( 'face caché', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'win',
			[
				'label' => esc_html__( 'face gagné!', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'msg_win',
			[
				'label' => esc_html__( 'message lorsque le joueur gagne', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'entrez du texte', 'textdomain' ),
			]
		);
		$this->add_control(
			'msg_replay',
			[
				'label' => esc_html__( 'msg sur le bouton pour rejouer', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Entrez du texte', 'textdomain' ),
			]
		);
		
		//fin de la section des controles
		$this->end_controls_section();

	}
 
		//dépéndence scripts js
    	public function get_script_depends() {
		return [ 'memory_widget_js' ];
	}
	    //dépédences fichier css
    	public function get_style_depends() {
		return [ 'memory_widget_css' ];
	}
	//rendu html du widget
	protected function render() {
	
			//récupération des paramétres enregistrés
			$settings = $this->get_settings_for_display();
		//récupération des urls des images dans un tableau
		$list = array_column($settings['list'],'images');
		$list = array_column($list,'url');
		 //création des doublons pour chaque image
		 array_push($list, ...$list);
		 //mélange du tableau
		shuffle($list);
		/*début du code html avec les variables
		msg_win correspond au message affiché lorsque le joueur gagne ['msg_replay'] pour le bouton rejouer. 
		note: cette section n'apparaît que lorsque le joueur gagne)
		memorygame section globale dans laquelle se trouve le jeu en général.
		['win']['url'] url des images lorsque l'utilisateur trouve les deux mêmes cartes
		['face']['url'] lorsque les cartes sont faces cachés
		*/
							echo '<div id="win"><p class="legend">'.$settings['msg_win'].'</p> <button id="replay">'.$settings['msg_replay'].'</button></div>';
		echo '<div id="memorygame" data-win="' . $settings['win']['url'] . '" data-face="' . $settings['face']['url'] . '">';
		/*
		boucle pour chaque image, on met l'image de carte retourné, son url avec l'image réele (data-realImage représente l'image réele relié
		a la carte) data-IsShowed est un paramétre permettant de savoir si l'image est face caché ou non.
		 */
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