<?php

namespace ChiTeck\TextFormatter\Filters;

/**
 * Defines the interface for Text Formatter filters.
 */
interface FilterInterface
{

    /**
     * Filter process callback.
     *
     * @param string $text The text string to be filtered.
     * @return string The filtered text.
     */
    public function process($text);

}
