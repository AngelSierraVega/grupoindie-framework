<?php

/**
 * GI-Framework-DVLP - ProjectHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package \GIndie\Framework\Components
 * 
 * @version 00.6C
 * @since 18-02-23
 */

namespace GIndie\Framework;

/**
 *
 * @edit 18-02-23
 * - Class extends \GIndie\ProjectHandler
 * - Implemented abstract methods
 * @edit 18-09-29
 * - Upgraded class dockblock
 */
class ProjectHandler extends \GIndie\ProjectHandler\AbstractProjectHandler
{

    /**
     * 
     * @return string
     * @since 18-05-17
     * @edit 18-05-19
     * - Upgraded project versions 
     * @edit 18-08-26
     * - Upgraded project versions 
     * @edit 18-10-02
     * - Upgraded project versions 
     */
    public static function versions()
    {
//        $rtnArray = parent::versions();
        $rtnArray = [];

        $rtnArray[\hexdec("00.01")]["description"] = "Cero";
        $rtnArray[\hexdec("00.01")]["code"] = "Cero";
        $rtnArray[\hexdec("00.01")]["threshold"] = "00.01";
        
        

        $rtnArray[\hexdec("00.50")]["description"] = "Functional project: Facturación Externa";
        $rtnArray[\hexdec("00.50")]["code"] = "FP-FE";
        $rtnArray[\hexdec("00.50")]["threshold"] = "00.50";
        
        /**
         * INT-DBHNDLR
         */
        $rtnArray[\hexdec("00.6C")]["description"] = "19-12-29 Started integration with DBHandler";
        $rtnArray[\hexdec("00.6C")]["code"] = "INT-DBHNDLR";
        $rtnArray[\hexdec("00.6C")]["threshold"] = "00.6C";

        $rtnArray[\hexdec("01.00")]["description"] = "Release";
        $rtnArray[\hexdec("01.00")]["code"] = "One";
        $rtnArray[\hexdec("01.00")]["threshold"] = "01.00";

        return $rtnArray;
    }

    /**
     * 
     * @return string
     * @since 18-02-23
     */
    public static function pathToSourceCode()
    {
        return \pathinfo(__FILE__, \PATHINFO_DIRNAME) . \DIRECTORY_SEPARATOR;
    }

    /**
     * 
     * @return string
     * @since 18-02-23
     */
    public static function projectName()
    {
        return "Framework";
    }

    /**
     * 
     * @return null
     * @since 18-02-23
     */
    public static function projectNamespace()
    {
        return null;
    }

    /**
     * 
     * @return string
     * @since 18-02-23
     */
    public static function projectVendor()
    {
        return "GIndie";
    }

}
