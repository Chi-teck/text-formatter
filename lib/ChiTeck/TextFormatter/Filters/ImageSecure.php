<?php

namespace ChiTeck\TextFormatter\Filters;


class ImageSecure implements FilterInterface {

    public function __construct(array $options = array()) {
        $this->otions = $options;
    }

    public function process($text) {

        throw new \BadMethodCallException('Not implemented yet');

/*        // Find the path (e.g. '/') to Drupal root.
        $base_path = base_path();
        $base_path_length = drupal_strlen($base_path);

        // Find the directory on the server where index.php resides.
        $local_dir = DRUPAL_ROOT . '/';

        $html_dom = filter_dom_load($text);
        $images = $html_dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            // Transform absolute image URLs to relative image URLs: prevent problems on
            // multisite set-ups and prevent mixed content errors.
            $image->setAttribute('src', file_url_transform_relative($src));

            // Verify that $src starts with $base_path.
            // This also ensures that external images cannot be referenced.
            $src = $image->getAttribute('src');
            if (drupal_substr($src, 0, $base_path_length) === $base_path) {
                // Remove the $base_path to get the path relative to the Drupal root.
                // Ensure the path refers to an actual image by prefixing the image source
                // with the Drupal root and running getimagesize() on it.
                $local_image_path = $local_dir . drupal_substr($src, $base_path_length);
                $local_image_path = rawurldecode($local_image_path);
                if (@getimagesize($local_image_path)) {
                    // The image has the right path. Erroneous images are dealt with below.
                    continue;
                }
            }
            // Replace an invalid image with an error indicator.
            $filter_html_image_secure_image = array(
                '#theme' => 'filter_html_image_secure_image',
                '#image' => $image,
            );
            drupal_render($filter_html_image_secure_image);
        }
        $text = filter_dom_serialize($html_dom);*/

    }


}