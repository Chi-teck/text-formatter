<?php

namespace ChiTeck\TextFormatter\Filters;

use  ChiTeck\TextFormatter\Utility\Xss;

/**
 * Text filter
 *
 * Limits allowed HTML tags
 */
class Html implements FilterInterface
{

    /**
     * A list of HTML tags that can be used.
     *
     * @var string $allowedTags
     * JavaScript event attributes, JavaScript URLs, and CSS are always stripped.
     */
    protected $allowedTags;

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->allowedTags = empty($options['allowedTags']) ? '' : $options['allowedTags'];
    }

    /**
     * {@inheritDoc}
     *
     * @see https://api.drupal.org/api/drupal/core%21modules%21filter%21filter.module/function/_filter_html/8
     */
    public function process($text)
    {
        $allowedTags = preg_split('/\s+|<|>/', $this->allowedTags, -1, PREG_SPLIT_NO_EMPTY);
        $text = Xss::filter($text, $allowedTags);

        return trim($text);
    }

}
