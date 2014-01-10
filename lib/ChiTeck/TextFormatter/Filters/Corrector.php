<?php

namespace ChiTeck\TextFormatter\Filters;

use ChiTeck\TextFormatter\Utility\Dom;

/**
 * Text filter
 *
 * Makes sure that HTML tags are properly closed.
 */
class Corrector implements FilterInterface
{

    /**
     * {@inheritDoc}
     *
     * @see https://api.drupal.org/api/drupal/core%21modules%21filter%21filter.module/function/_filter_htmlcorrector/8
     */
    public function process($text)
    {
        return Dom::serialize(Dom::load($text));
    }

}