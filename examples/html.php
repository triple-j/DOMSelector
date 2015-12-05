<?php
require(__DIR__ . "/../vendor/autoload.php");

$html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <P>Hello Crawler!</P>
    </body>
</html>
HTML;


// parse data from XML
$doc = new DOMDocument();
$doc->loadHTML($html);
$dom = new \trejeraos\DOMSelector($doc);

// pull out data from XML
$arr['message']     = $dom->querySelector('.message')->nodeValue;
$arr['paragraphs']  = array();
foreach ($dom->querySelectorAll('p') as $node) {
    $arr['paragraphs'] []= $node->nodeValue;
}

// display data
echo "<pre>".PHP_EOL;
var_dump($arr);