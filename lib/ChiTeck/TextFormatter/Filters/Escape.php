<?php

namespace ChiTeck\TextFormatter\Filters;

use  ChiTeck\TextFormatter\Utility\String;

/**
 * Text filter
 *
 * Escapes all HTML tags, so they will be visible instead of being effective.
 */
class Escape implements FilterInterface
{

    /**
     *{@inheritDoc}
     *
     * @see https://api.drupal.org/api/drupal/core%21modules%21filter%21filter.module/function/_filter_html_escape/8
     */
    public function process($text)
    {
        return trim(String::checkPlain($text));
    }

}
