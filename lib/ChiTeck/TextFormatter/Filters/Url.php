<?php

namespace ChiTeck\TextFormatter\Filters;


class Url implements FilterInterface {

    /***
     * @var integer $urlLengths
     *
     * URLs longer than this number of characters will be truncated to prevent
     * long strings that break formatting. The link itself will be retained;
     * just the text portion of the link will be truncated.
     */
    protected $urlLength;

    public function __construct(array $options = array()) {
        $this->urlLength = $options['urlLength'];
    }

    public function process($text) {

        throw new \BadMethodCallException('Not implemented yet');
/*
        // Tags to skip and not recurse into.
        $ignore_tags = 'a|script|style|code|pre';

        // Pass length to regexp callback.
        _filter_url_trim(NULL, $filter->settings['filter_url_length']);

        // Create an array which contains the regexps for each type of link.
        // The key to the regexp is the name of a function that is used as
        // callback function to process matches of the regexp. The callback function
        // is to return the replacement for the match. The array is used and
        // matching/replacement done below inside some loops.
        $tasks = array();

        // Prepare protocols pattern for absolute URLs.
        // check_url() will replace any bad protocols with HTTP, so we need to support
        // the identical list. While '//' is technically optional for MAILTO only,
        // we cannot cleanly differ between protocols here without hard-coding MAILTO,
        // so '//' is optional for all protocols.
        // @see filter_xss_bad_protocol()
        $protocols = \Drupal::config('system.filter')->get('protocols');
        $protocols = implode(':(?://)?|', $protocols) . ':(?://)?';

        $valid_url_path_characters = "[\p{L}\p{M}\p{N}!\*\';:=\+,\.\$\/%#\[\]\-_~@&]";

        // Allow URL paths to contain balanced parens
        // 1. Used in Wikipedia URLs like /Primer_(film)
        // 2. Used in IIS sessions like /S(dfd346)/
        $valid_url_balanced_parens = '\(' . $valid_url_path_characters . '+\)';

        // Valid end-of-path chracters (so /foo. does not gobble the period).
        // 1. Allow =&# for empty URL parameters and other URL-join artifacts
        $valid_url_ending_characters = '[\p{L}\p{M}\p{N}:_+~#=/]|(?:' . $valid_url_balanced_parens . ')';

        $valid_url_query_chars = '[a-z0-9!?\*\'@\(\);:&=\+\$\/%#\[\]\-_\.,~|]';
        $valid_url_query_ending_chars = '[a-z0-9_&=#\/]';

        //full path
        //and allow @ in a url, but only in the middle. Catch things like http://example.com/@user/
        $valid_url_path = '(?:(?:' . $valid_url_path_characters . '*(?:' . $valid_url_balanced_parens . $valid_url_path_characters . '*)*' . $valid_url_ending_characters . ')|(?:@' . $valid_url_path_characters . '+\/))';

        // Prepare domain name pattern.
        // The ICANN seems to be on track towards accepting more diverse top level
        // domains, so this pattern has been "future-proofed" to allow for TLDs
        // of length 2-64.
        $domain = '(?:[\p{L}\p{M}\p{N}._+-]+\.)?[\p{L}\p{M}]{2,64}\b';
        $ip = '(?:[0-9]{1,3}\.){3}[0-9]{1,3}';
        $auth = '[\p{L}\p{M}\p{N}:%_+*~#?&=.,/;-]+@';
        $trail = '(' . $valid_url_path . '*)?(\\?' . $valid_url_query_chars . '*' . $valid_url_query_ending_chars . ')?';

        // Match absolute URLs.
        $url_pattern = "(?:$auth)?(?:$domain|$ip)/?(?:$trail)?";
        $pattern = "`((?:$protocols)(?:$url_pattern))`u";
        $tasks['_filter_url_parse_full_links'] = $pattern;

        // Match e-mail addresses.
        $url_pattern = "[\p{L}\p{M}\p{N}._-]{1,254}@(?:$domain)";
        $pattern = "`($url_pattern)`u";
        $tasks['_filter_url_parse_email_links'] = $pattern;

        // Match www domains.
        $url_pattern = "www\.(?:$domain)/?(?:$trail)?";
        $pattern = "`($url_pattern)`u";
        $tasks['_filter_url_parse_partial_links'] = $pattern;

        // Each type of URL needs to be processed separately. The text is joined and
        // re-split after each task, since all injected HTML tags must be correctly
        // protected before the next task.
        foreach ($tasks as $task => $pattern) {
            // HTML comments need to be handled separately, as they may contain HTML
            // markup, especially a '>'. Therefore, remove all comment contents and add
            // them back later.
            _filter_url_escape_comments('', TRUE);
            $text = preg_replace_callback('`<!--(.*?)-->`s', '_filter_url_escape_comments', $text);

            // Split at all tags; ensures that no tags or attributes are processed.
            $chunks = preg_split('/(<.+?>)/is', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
            // PHP ensures that the array consists of alternating delimiters and
            // literals, and begins and ends with a literal (inserting NULL as
            // required). Therefore, the first chunk is always text:
            $chunk_type = 'text';
            // If a tag of $ignore_tags is found, it is stored in $open_tag and only
            // removed when the closing tag is found. Until the closing tag is found,
            // no replacements are made.
            $open_tag = '';

            for ($i = 0; $i < count($chunks); $i++) {
                if ($chunk_type == 'text') {
                    // Only process this text if there are no unclosed $ignore_tags.
                    if ($open_tag == '') {
                        // If there is a match, inject a link into this chunk via the callback
                        // function contained in $task.
                        $chunks[$i] = preg_replace_callback($pattern, $task, $chunks[$i]);
                    }
                    // Text chunk is done, so next chunk must be a tag.
                    $chunk_type = 'tag';
                }
                else {
                    // Only process this tag if there are no unclosed $ignore_tags.
                    if ($open_tag == '') {
                        // Check whether this tag is contained in $ignore_tags.
                        if (preg_match("`<($ignore_tags)(?:\s|>)`i", $chunks[$i], $matches)) {
                            $open_tag = $matches[1];
                        }
                    }
                    // Otherwise, check whether this is the closing tag for $open_tag.
                    else {
                        if (preg_match("`<\/$open_tag>`i", $chunks[$i], $matches)) {
                            $open_tag = '';
                        }
                    }
                    // Tag chunk is done, so next chunk must be text.
                    $chunk_type = 'text';
                }
            }

            $text = implode($chunks);
            // Revert back to the original comment contents
            _filter_url_escape_comments('', FALSE);
            $text = preg_replace_callback('`<!--(.*?)-->`', '_filter_url_escape_comments', $text);
        }*/

    }

}
