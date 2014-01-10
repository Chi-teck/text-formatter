<?php

/**
 * @file
 * Contains \ChiTeck\TextFormatter\Utility\String.
 */

namespace ChiTeck\TextFormatter\Utility;

/**
 * Provides helpers to operate on strings.
 *
 * @see https://api.drupal.org/api/drupal/core!lib!Drupal!Component!Utility!String.php/class/String/8
 */
class String
{

    /**
     * Encodes special characters in a plain-text string for display as HTML.
     *
     * Also validates strings as UTF-8.
     *
     * @param string $text
     *   The text to be checked or processed.
     *
     * @return string
     *   An HTML safe version of $text, or an empty string if $text is not
     *   valid UTF-8.
     *
     * @see drupal_validate_utf8()
     *
     * @ingroup sanitization
     */
    public static function checkPlain($text)
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Decodes all HTML entities including numerical ones to regular UTF-8 bytes.
     *
     * Double-escaped entities will only be decoded once ("&amp;lt;" becomes
     * "&lt;", not "<"). Be careful when using this function, as it will revert
     * previous sanitization efforts (&lt;script&gt; will become <script>).
     *
     * @param string $text
     *   The text to decode entities in.
     *
     * @return string
     *   The input $text, with all HTML entities decoded once.
     */
    public static function decodeEntities($text)
    {
        return html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    }

}
