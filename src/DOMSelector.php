<?php
namespace trejeraos;

use \DOMDocument;
use \DOMXpath;
use Symfony\Component\CssSelector\Parser\Shortcut\ClassParser;
use Symfony\Component\CssSelector\Parser\Shortcut\ElementParser;
use Symfony\Component\CssSelector\Parser\Shortcut\EmptyStringParser;
use Symfony\Component\CssSelector\Parser\Shortcut\HashParser;
use Symfony\Component\CssSelector\XPath\Translator;

/**
 * DOMSelector makes selecting XML elements easy by using CSS like selectors
 * 
 * @author   Jeremie Jarosh <jeremie@jarosh.org>
 * @version  0.2
 */
class DOMSelector extends DOMXpath
{
    
    /**
     * @var \Symfony\Component\CssSelector\XPath\Translator
     */
    protected $translator;
    
    
    public function __construct(DOMDocument $doc) 
    {
        parent::__construct($doc);
        
        $this->translator = new Translator();

        $this->translator
            ->registerParserShortcut(new EmptyStringParser())
            ->registerParserShortcut(new ElementParser())
            ->registerParserShortcut(new ClassParser())
            ->registerParserShortcut(new HashParser())
        ;
    }
    
    /**
     * Translates a CSS expression to its XPath equivalent.
     * Optionally, a prefix can be added to the resulting XPath
     * expression with the $prefix parameter.
     *
     * @param mixed  $cssExpr The CSS expression.
     * @param string $prefix  An optional prefix for the XPath expression.
     *
     * @return string
     */
    public function toXPath($cssExpr, $prefix = 'descendant-or-self::')
    {
        return $this->translator->cssToXPath($cssExpr, $prefix);
    }
    
    /**
     * Returns a list of the elements within the document that match the specified group of selectors.
     * 
     * @param string  $filename  CSS Selector
     * 
     * @return DOMNodeList
     */
    public function querySelectorAll($cssSelectors) 
    {
        $xpathQuery = $this->toXPath($cssSelectors);
        return $this->query($xpathQuery);
    }

    /**
     * Returns the first element within the document that matches the specified group of selectors.
     * 
     * @param string  $filename  CSS Selector
     * 
     * @return DOMNode
     */
    public function querySelector($cssSelectors) 
    {
        return $this->querySelectorAll($cssSelectors)->item(0);
    }
}