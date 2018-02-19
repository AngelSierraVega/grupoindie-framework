<?php

namespace GIndie\Framework\View;

use GIndie\ScriptGenerator\Dashboard;
use GIndie\ScriptGenerator\HTML5\Category\StylesSemantics;

/**
 * DVLP-Framework - DOM
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package Framework
 *
 * @version GI-FRMWRK.00.00 18-02-17 Empty class created.
 * @edit GI-FRMWRK.00.01
 * - Added code from FacturacionExterna\DOM
 * @edit GI-FRMWRK.00.02 18-02-19
 * - Created instanceWithWebSources()
 * @edit GI-FRMWRK.00.03 18-02-20
 * - Created configCSS(), configJS(), assetsFolder()
 */
abstract class DOM extends Dashboard\Document
{

    /**
     * 
     * @param type $title
     * @param type $lang
     * 
     * @return \GIndie\Framework\View\DOM
     * 
     * @since GI-FRMWRK.00.02
     */
    public static function instanceWithWebSources($title, $lang = "en")
    {
        return new static($title, $lang, null, null, null, null);
    }

    /**
     * 
     * @param type $title
     * @param type $lang
     * @param type $pathToCSS
     * @param type $pathToTheme
     * @param type $pathToJquery
     * @param type $pathToJS
     * 
     * @since GI-FRMWRK.00.01
     * @edit GI-FRMWRK.00.03
     */
    public function __construct($title, $lang = "en", $pathToCSS = null, $pathToTheme = null,
                                $pathToJquery = null, $pathToJS = null)
    {
        parent::__construct($title, $lang, $pathToCSS, $pathToTheme, $pathToJquery, $pathToJS);

        $this->topbar = $this->addContentGetPointer(new \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar());
        /**
         * @todo
         * $this->topbar->addClass("navbar-fixed-top");
         */
        $this->container = $this->addContentGetPointer(StylesSemantics::div());
        $this->container->addClass("container");
        static::configCSS();
        static::configJS();
        /**
         * @todo 
         * $this->_footbar = $this->addContentGetPointer(new Document\Footbar("[gip-footbar]"));
         */
    }

    /**
     * @since GI-FRMWRK.00.03
     */
    public function configCSS()
    {
        
    }

    /**
     * @since GI-FRMWRK.00.03
     */
    public function configJS()
    {
        
    }

    /**
     * @since GI-FRMWRK.00.03
     */
    abstract public static function assetsFolder();

    /**
     * 
     * @param type $content
     * @return $this
     * 
     * @since GI-FRMWRK.00.01
     */
    public function addContent($content)
    {
        $this->container->addContent($content);
        return $this;
    }

    /**
     * 
     * @var \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics\Div 
     * 
     * @since GI-FRMWRK.00.01
     */
    private $container;

    /**
     * 
     * @return \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar 
     * @since GI-FRMWRK.00.03
     */
    public function getTopbar()
    {
        return $this->topbar;
    }

    /**
     *
     * @var \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar 
     * @since GI-FRMWRK.00.03
     */
    private $topbar;

    /**
     * 
     * @return \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar 
     * @since GI-FRMWRK.00.03
     */
    public function getFootbar()
    {
        return $this->footbar;
    }

    /**
     *
     * @var \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar  
     * 
     * @since GI-FRMWRK.00.03
     */
    private $footbar;

}
