<?php

/**
 * @file
 * Contains \ChiTeck\TextFormatter\Utility\Dom.
 */

namespace ChiTeck\TextFormatter\Utility;

/**
 * Provides helpers to operate with DOM.
 */
class Dom {

    /**
     * Parses an HTML snippet and returns it as a DOM object.
     *
     * This function loads the body part of a partial (X)HTML document and returns
     * a full DOMDocument object that represents this document. You can use
     * filter_dom_serialize() to serialize this DOMDocument back to a XHTML
     * snippet.
     *
     * @param string $text
     *   The partial (X)HTML snippet to load. Invalid mark-up will be corrected on
     *   import.
     *
     * @return
     *   A DOMDocument that represents the loaded (X)HTML snippet.
     *
     * @see https://api.drupal.org/api/drupal/core%21modules%21filter%21filter.module/function/filter_dom_load/8
     */
    public static function load($text) {
        $domDocument = new \DOMDocument();
        // Ignore warnings during HTML soup loading.
        @$domDocument->loadHTML('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>' . $text . '</body></html>');

        return $domDocument;
    }

    /**
     * Converts a DOM object back to an HTML snippet.
     *
     * The function serializes the body part of a DOMDocument back to an XHTML
     * snippet. The resulting XHTML snippet will be properly formatted to be
     * compatible with HTML user agents.
     *
     * @param $domDocument
     *   A DOMDocument object to serialize, only the tags below
     *   the first <body> node will be converted.
     *
     * @return
     *   A valid (X)HTML snippet, as a string.
     *
     * @see https://api.drupal.org/api/drupal/core%21modules%21filter%21filter.module/function/filter_dom_serialize/8
     */
    public static function serialize($domDocument) {
        $body_node = $domDocument->getElementsByTagName('body')->item(0);
        $body_content = '';

        foreach ($body_node->getElementsByTagName('script') as $node) {
            self::filterDomSerializeEscapeCdataElement($domDocument, $node);
        }

        foreach ($body_node->getElementsByTagName('style') as $node) {
            self::filterDomSerializeEscapeCdataElement($domDocument, $node, '/*', '*/');
        }

        foreach ($body_node->childNodes as $child_node) {
            $body_content .= $domDocument->saveXML($child_node);
        }
        return preg_replace('|<([^> ]*)/>|i', '<$1 />', $body_content);
    }

    /**
     * Adds comments around the <!CDATA section in a dom element.
     *
     * DOMDocument::loadHTML in filter_dom_load() makes CDATA sections from the
     * contents of inline script and style tags.  This can cause HTML 4 browsers to
     * throw exceptions.
     *
     * This function attempts to solve the problem by creating a DocumentFragment
     * and imitating the behavior in drupal_get_js(), commenting the CDATA tag.
     *
     * @param $dom_document
     *   The DOMDocument containing the $dom_element.
     * @param $dom_element
     *   The element potentially containing a CDATA node.
     * @param $comment_start
     *   (optional) A string to use as a comment start marker to escape the CDATA
     *   declaration. Defaults to '//'.
     * @param $comment_end
     *   (optional) A string to use as a comment end marker to escape the CDATA
     *   declaration. Defaults to an empty string.
     */
    public function filterDomSerializeEscapeCdataElement($dom_document, $dom_element, $comment_start = '//', $comment_end = '') {
        foreach ($dom_element->childNodes as $node) {
            if (get_class($node) == 'DOMCdataSection') {
                // See drupal_get_js().  This code is more or less duplicated there.
                $embed_prefix = "\n<!--{$comment_start}--><![CDATA[{$comment_start} ><!--{$comment_end}\n";
                $embed_suffix = "\n{$comment_start}--><!]]>{$comment_end}\n";

                // Prevent invalid cdata escaping as this would throw a DOM error.
                // This is the same behavior as found in libxml2.
                // Related W3C standard: http://www.w3.org/TR/REC-xml/#dt-cdsection
                // Fix explanation: http://en.wikipedia.org/wiki/CDATA#Nesting
                $data = str_replace(']]>', ']]]]><![CDATA[>', $node->data);

                $fragment = $dom_document->createDocumentFragment();
                $fragment->appendXML($embed_prefix . $data . $embed_suffix);
                $dom_element->appendChild($fragment);
                $dom_element->removeChild($node);
            }
        }
    }

}
