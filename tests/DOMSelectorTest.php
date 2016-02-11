<?php
use trejeraos\DOMSelector;

class DOMSelectorTest extends PHPUnit_Framework_TestCase
{

    private $htmlCode = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p>Hello World!</p>
        <P class="message">Hello DOMSelector!</P>
    </body>
</html>
HTML;


    private $xmlCode = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<import>
    <default_user>
        <username>kevin</username>
    </default_user>
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
    
    
    // function testCanCreateDOMSelector() {
    //     $doc = new DOMDocument();
    //     $doc->loadHTML($this->htmlCode);
        
    //     $dom = new DOMSelector($doc);
        
    //     $this->assertInstanceOf(DOMSelector::class, $dom);
    // }
    
    function testCanSelectFirstParagraph() {
        $doc = new DOMDocument();
        $doc->loadHTML($this->htmlCode);
        
        $dom = new DOMSelector($doc);
        
        $node = $dom->querySelector('p');
        
        $this->assertInstanceOf(DOMNode::class, $node);
        $this->assertEquals("Hello World!", $node->nodeValue);
    }
    
    function testCanSelectMessageClass() {
        $doc = new DOMDocument();
        $doc->loadHTML($this->htmlCode);
        
        $dom = new DOMSelector($doc);
        
        $node = $dom->querySelector('.message');
        
        // $this->assertInstanceOf(DOMNode::class, $node);
        $this->assertEquals("Hello DOMSelector!", $node->nodeValue);
    }
    
    function testCanSelectAllParagraphs() {
        $doc = new DOMDocument();
        $doc->loadHTML($this->htmlCode);
        
        $dom = new DOMSelector($doc);
        
        $nodeList = $dom->querySelectorAll('p');
        
        $this->assertInstanceOf(DOMNodeList::class, $nodeList);
        $this->assertEquals(2, $nodeList->length);
    }
    
    function testReturnsNullWhenAnElementIsNotFound() {
        $doc = new DOMDocument();
        $doc->loadHTML($this->htmlCode);
        
        $dom = new DOMSelector($doc);
        
        $node = $dom->querySelector('#does-not-exist');
        
        $this->assertNull($node);
    }
    
    function testReturnsEmptyWhenElementsAreNotFound() {
        $doc = new DOMDocument();
        $doc->loadHTML($this->htmlCode);
        
        $dom = new DOMSelector($doc);
        
        $nodeList = $dom->querySelectorAll('.does-not-exist');
        
        $this->assertInstanceOf(DOMNodeList::class, $nodeList);
        $this->assertEquals(0, $nodeList->length);
    }
    
    function testCanQueryXML() {
        $doc = new DOMDocument();
        $doc->loadXML($this->xmlCode);
        
        $dom = new DOMSelector($doc, false);
        
        // pull out data from XML
        $arr['email']  = $dom->querySelector('user > email')->nodeValue;
        $arr['name']   = $dom->querySelector('user > username')->nodeValue;
        $arr['apiKey'] = $dom->querySelector('user attribute[id=api_key]')->nodeValue;
        $arr['posId']  = (int)$dom->querySelector('user attribute[id=pos_id]')->nodeValue;
        
        
        $this->assertEquals("steve@example.com", $arr['email']);
        $this->assertEquals("steve", $arr['name']);
        $this->assertEquals("a983ci47dsnuc9xw42", $arr['apiKey']);
        $this->assertEquals(1833, $arr['posId']);
    }
}