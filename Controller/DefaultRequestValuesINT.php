<?php

/**
 * GI-Framework-DVLP - DefaultRequestValuesINT
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package \GIndie\Framework\Controller
 * 
 * @version 00.A0
 * @since 18-02-18
 */

namespace GIndie\Framework\Controller;

/**
 * 
 * @edit 18-02-18
 * - Created DEFAULT_REQUEST_NAME, DEFAULT_REQUEST_VALUE
 * @edit 18-09-29
 * - Upgraded class dockblock
 */
interface DefaultRequestValuesINT
{

    /**
     *
     * @var string 
     * @since 18-02-18
     */
    const DEFAULT_REQUEST_NAME = "GI-FRMWRK-FRM-RQST";

    /**
     *
     * @var string 
     * @since 18-02-18
     */
    const DEFAULT_REQUEST_VALUE = "GI-FRMWRK-RQST-DFLT";
    
    /**
     * 
     * @var string 
     * @since 18-02-18
     */
    const ERROR_REQUEST_NAME = "GI-FRMWRK-ERROR";

}
