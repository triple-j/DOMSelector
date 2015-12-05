DOMSelector
===========

DOMSelector makes selecting HTML/XML elements easy by using CSS like selectors.



Usage
-----

```php
<?php
use trejeraos\DOMSelector;

$html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <P>Hello DOMSelector!</P>
    </body>
</html>
HTML;

$doc = new DOMDocument();
$doc->loadHTML($html);

$dom = new DOMSelector($doc);

echo $dom->querySelector('.message')->nodeValue;
```

### Limitations ###

See: [Limitations of the CssSelector Component](https://symfony.com/doc/2.8/components/css_selector.html#limitations-of-the-cssselector-component)