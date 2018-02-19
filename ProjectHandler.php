<?php

namespace GIndie\Framework;

/**
 * DVLP-Framework - ProjectHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package Framework
 *
 * @version GI-FRMWRK.00.00 18-02-23 Empty class created.
 * @edit GI-FRMWRK.00.01
 * - Class extends \GIndie\ProjectHandler
 * - Implemented abstract methods
 */
class ProjectHandler extends \GIndie\ProjectHandler
{

    /**
     * 
     * @return string
     * @since GI-FRMWRK.00.01
     */
    public static function pathToSourceCode()
    {
        return \pathinfo(__FILE__, \PATHINFO_DIRNAME) . \DIRECTORY_SEPARATOR;
    }

    /**
     * 
     * @return string
     * @since GI-FRMWRK.00.01
     */
    public static function projectName()
    {
        return "Framework";
    }

    /**
     * 
     * @return null
     * @since GI-FRMWRK.00.01
     */
    public static function projectNamespace()
    {
        return null;
    }

    /**
     * 
     * @return string
     * @since GI-FRMWRK.00.01
     */
    public static function projectVendor()
    {
        return "GIndie";
    }

}
