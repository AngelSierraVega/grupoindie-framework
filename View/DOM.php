<?php

/**
 * GI-Framework-DVLP - DOM
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package \GIndie\Framework\View
 *
 * @version 00.A0
 * @since 18-02-17
 */

namespace GIndie\Framework\View;

use GIndie\ScriptGenerator\Dashboard;
use GIndie\ScriptGenerator\HTML5\Category\StylesSemantics;

/**
 *
 * @edit 18-02-17
 * - Added code from FacturacionExterna\DOM
 * @edit 18-02-19
 * - Created instanceWithWebSources()
 * @edit 18-02-20
 * - Created configCSS(), configJS(), assetsFolder()
 * @edit 18-02-25
 * - Added functional footbar
 * @edit 18-09-29
 * - Upgraded class dockblock
 */
class DOM extends Dashboard\Document
{

    /**
     * 
     * @param type $title
     * @param type $lang
     * 
     * @return \GIndie\Framework\View\DOM
     * 
     * @since 18-02-19
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
     * @since 18-02-17
     * @edit 18-02-20
     */
    public function __construct($title, $lang = "en", $pathToCSS = null, $pathToTheme = null, $pathToJquery = null, $pathToJS = null)
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
        $this->footbar = $this->addContentGetPointer(new \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar(false));
        $this->footbar->addClass("navbar-fixed-bottom");

        $this->getBody()->setAttribute("style", "padding-bottom: 55px;");
    }

    /**
     * @since 18-02-20
     */
    public function configCSS()
    {
        
    }

    /**
     * @since 18-02-20
     */
    public function configJS()
    {
        
    }

    /**
     * @since 18-02-20
     */
    public static function assetsFolder()
    {
        
    }

    /**
     * 
     * @param type $content
     * @return $this
     * 
     * @since 18-02-17
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
     * @since 18-02-17
     */
    private $container;

    /**
     * 
     * @return \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar 
     * @since 18-02-20
     */
    public function getTopbar()
    {
        return $this->topbar;
    }

    /**
     *
     * @var \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar 
     * @since 18-02-20
     */
    private $topbar;

    /**
     * 
     * @return \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar 
     * @since 18-02-20
     */
    public function getFootbar()
    {
        return $this->footbar;
    }

    /**
     *
     * @var \GIndie\ScriptGenerator\Bootstrap3\Component\Navbar  
     * 
     * @since 18-02-20
     */
    private $footbar;

}
