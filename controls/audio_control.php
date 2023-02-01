<?php
class Audio_Control extends \Elementor\Control_Base_Multiple {
    public function get_type()
    {
        return 'audio';
    }



    public function get_default_value()
    {
        return [
            'url' => '',
            'id' => '',
        ];
    }
    public function on_import($settings)
    {
        if (empty($settings['url'])) {
            return $settings;
        }

        $settings = Plugin::$instance->templates_manager->get_import_audios_instance()->import($settings);

        if (!$settings) {
            $settings = [
                'id' => '',
                'url' => '/assets/audio/file_example_MP3_700KB.mp3',
            ];
        }

        return $settings;
    }

    public function content_template()
    {
        ?>
        <div class="elementor-control-field">
            
        </div>
        <?php
    }

    public function enqueue()
    {
    }
}
?>