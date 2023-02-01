<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class Audio_Import
{
    
    private $_replace_audio_ids = [];
    private function get_hash_audio($attachment_url)
    {
        return sha1($attachment_url);
    }

    private function get_saved_audio($attachment)
    {
        global $wpdb;
        if (isset($this->_replace_audio_ids[$attachment['id']])) {
            return $this->_replace_audio_ids[$attachment['id']];
        }
        $post_id = $wpdb->get_var(
            $wpdb->prepare(
                'SELECT `post_id` FROM `' . $wpdb->postmeta . '`
					WHERE `meta_key` = \'_elementor_source_audio_hash\'
						AND `meta_value` = %s
				;',
                $this->get_hash_audio($attachment['url'])
            )
        );
        if ($post_id) {
            $new_attachment = [
                'id' => $post_id,
                'url' => wp_get_attachment_url($post_id),
            ];
            $this->_replace_audio_ids[$attachment['id']] = $new_attachment;

            return $new_attachment;
        }

        return false;
    }
    public function import($attachment, $parent_post_id = null)
    {
        if (isset($attachment['tmp_name'])) {
            // Used when called to import a directly-uploaded file.
            $filename = $attachment['name'];

            $file_content = Utils::file_get_contents($attachment['tmp_name']);
        } else {
            // Used when attachment information is passed to this method.
            if (!empty($attachment['id'])) {
                $saved_audio = $this->get_saved_audio($attachment);

                if ($saved_audio) {
                    return $saved_audio;
                }
            }
            $filename = basename($attachment['url']);

            $request = wp_safe_remote_get($attachment['url']);
            if (empty($file_content)) {
                return false;
            }

            $filetype = wp_check_filetype($filename);

            // If the file type is not recognized by WordPress, exit here to avoid creation of an empty attachment document.
            if (!$filetype['ext']) {
                return false;
            }
            $upload = wp_upload_bits(
                $filename,
                null,
                $file_content
            );

            $post = [
                'post_title' => $filename,
                'guid' => $upload['url'],
            ];

            $info = wp_check_filetype($upload['file']);

            if ($info) {
                $post['post_mime_type'] = $info['type'];
            } else {
                // For now just return the origin attachment
                return $attachment;
                // return new \WP_Error( 'attachment_processing_error', esc_html__( 'Invalid file type.', 'elementor' ) );
            }

            $post_id = wp_insert_attachment($post, $upload['file'], $parent_post_id);

            apply_filters('elementor/template_library/import_audio/new_attachment', $post_id);

            // On REST requests.
            if (!function_exists('wp_generate_attachment_metadata')) {
                require_once ABSPATH . '/wp-admin/includes/file.php';
            }

            wp_update_attachment_metadata(
                $post_id,
                wp_generate_attachment_metadata($post_id, $upload['file'])
            );
            update_post_meta($post_id, '_elementor_source_audio_hash', $this->get_hash_audio($attachment['url']));

            $new_attachment = [
                'id' => $post_id,
                'url' => $upload['url'],
            ];

            if (!empty($attachment['id'])) {
                $this->_replace_audio_ids[$attachment['id']] = $new_attachment;
            }

            return $new_attachment;
        }

    }
    public function __construct()
    {
        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        WP_Filesystem();
    }
}
?>