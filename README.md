#Text Formatter

A tool for handling the filtering of content.

The code based on Drupal text filters system.
Check out the [documentation](https://drupal.org/node/213156) about how Drupal text filters work.

Usage
===

```php
<?php

use ChiTeck\TextFormatter\TextFormatter;
use ChiTeck\TextFormatter\Filters\Html;
use ChiTeck\TextFormatter\Filters\Autop;
use ChiTeck\TextFormatter\Filters\Corrector;

$formatter = new TextFormatter([
    new Html(['allowedTags' => '<a><ul><li><p><br>']),
    new Autop(),
    new Corrector(),
]);

$safeText = $formatter->checkMarkup($text);
```

Supported filters
===

* Html – Limits allowed HTML tags.
* Autop – Converts line breaks into `<p>` and `<br>` in an intelligent fashion.
* Corrector – Makes sure that HTML tags are properly closed.
* Escape – Escapes all HTML tags, so they will be visible instead of being effective.
* Nofollow – Adds `rel="nofollow"` to all links.

License
===
Text Formatter licensed under GPLv2.