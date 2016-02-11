<?php
namespace trejeraos;

use \DOMDocument;
use \DOMXpath;
use Symfony\Component\CssSelector\CssSelectorConverter;

/**
 * DOMSelector makes selecting XML elements easy by using CSS like selectors
 * 
 * @author   Jeremie Jarosh <jeremie@jarosh.org>
 * @version  0.3.0
 */
class DOMSelector extends DOMXpath
{
    
    /**
     * @var \Symfony\Component\CssSelector\CssSelectorConverter
     */
    protected $converter;
    
    
    /**
     * Creates a new DOMSelector object
     * 
     * @param DOMDocument $doc   The DOMDocument associated with the DOMSelector.
     * @param bool        $html  Whether HTML support should be enabled. Disable it for XML documents.
     */
    public function __construct(DOMDocument $doc, $html = true) 
    {
        parent::__construct($doc);
        
        $this->converter = new CssSelectorConverter($html);
    }
    
    /**
     * Returns a list of the elements within the document that match the specified group of selectors.
     * 
     * @param string  $filename  CSS Selector
     * 
     * @return DOMNodeList  List of matching elements (will be empty if no matches are found).
     */
    public function querySelectorAll($cssSelectors) 
    {
        $xpathQuery = $this->converter->toXPath($cssSelectors);
        return $this->query($xpathQuery);
    }

    /**
     * Returns the first element within the document that matches the specified group of selectors.
     * 
     * @param string  $filename  CSS Selector
     * 
     * @return DOMNode|NULL  The first matching element or NULL if no matches are found.
     */
    public function querySelector($cssSelectors) 
    {
        return $this->querySelectorAll($cssSelectors)->item(0);
    }
}