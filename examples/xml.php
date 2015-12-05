<?php
require(__DIR__ . "/../vendor/autoload.php");

$XML = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<import>
    <user>
        <username>steve</username>
        <display_name>Steven</display_name>
        <email>steve@example.com</email>
        <attributes>
            <attribute id="theme">sandstorm</attribute>
            <attribute id="pos_id">1833</attribute>
            <attribute id="api_key">a983ci47dsnuc9xw42</attribute>
        </attributes>
    </user>
</import>
EOD;


// parse data from XML
$doc = new DOMDocument();
$doc->loadXML($XML);
$dom = new \trejeraos\DOMSelector($doc, false);

// pull out data from XML
$arr['email']  = $dom->querySelector('user > email')->nodeValue;
$arr['name']   = $dom->querySelector('user > username')->nodeValue;
$arr['apiKey'] = $dom->querySelector('user attribute[id=api_key]')->nodeValue;
$arr['posId']  = (int)$dom->querySelector('user attribute[id=pos_id]')->nodeValue;

// display data
echo "<pre>".PHP_EOL;
var_dump($arr);