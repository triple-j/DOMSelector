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
}