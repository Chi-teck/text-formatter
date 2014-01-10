<?php

namespace ChiTeck\TextFormatter\Filters;

use ChiTeck\TextFormatter\Utility\Dom;

/**
 * Text filter
 *
 * Adds rel="nofollow" to all links.
 */
class Nofollow implements FilterInterface
{

    /**
     * {@inheritDoc}
     *
     * @see https://api.drupal.org/api/drupal/core%21modules%21filter%21filter.module/function/_filter_html/8
     */
    public function process($text)
    {

        $htmlDom = Dom::load($text);
        $links = $htmlDom->getElementsByTagName('a');
        foreach ($links as $link) {
            $link->setAttribute('rel', 'nofollow');
        }
        $text = Dom::serialize($htmlDom);

        return trim($text);
    }

}
