<?php

namespace ChiTeck\TextFormatter;

use ChiTeck\TextFormatter\Filters\FilterInterface;

/**
 * Class TextFormatter
 */
class TextFormatter
{

    /**
     * @var array $filters List of filters. Ordered make sense.
     */
    protected $filters = array();

    /**
     * Creates a new text formatter.
     *
     * @param array
     */
    public function __construct(array $filters = array())
    {
        $this->filters = $filters;
    }

    /**
     * Adds a filter.
     *
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
    }

    /**
     * Runs all the enabled filters on a piece of text.
     *
     * @param string $text The text to be filtered.
     * @return string The filtered text.
     */
    public function checkMarkup($text)
    {
        // Convert all Windows and Mac newlines to a single newline, so filters only
        // need to deal with one possibility.
        $text = str_replace(array("\r\n", "\r"), "\n", $text);

        // Give filters the chance to escape HTML-like data such as code or formulas.
        foreach ($this->filters as $filter) {
            if (method_exists($filter,' prepare')) {
                $text = $filter->prepare($text);
            }
        }

        // Perform filtering.
        foreach ($this->filters as $filter) {
            $text = $filter->process($text);
        }

        return $text;
    }

}
