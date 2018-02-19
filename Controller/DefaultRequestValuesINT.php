<?php

namespace GIndie\Framework\Controller;

/**
 * DVLP-Framework - DefaultRequestValuesINT
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package Framework
 *
 * @version GI-FRMWRK.00.00 18-02-18 Empty interface created.
 * @edit GI-FRMWRK.00.01
 * - Created DEFAULT_REQUEST_NAME, DEFAULT_REQUEST_VALUE
 */
interface DefaultRequestValuesINT
{

    /**
     *
     * @var string 
     * @since GI-FRMWRK.00.01
     * @edit 
     */
    const DEFAULT_REQUEST_NAME = "GI-FRMWRK-FRM-RQST";

    /**
     *
     * @var string 
     * @since GI-FRMWRK.00.01
     */
    const DEFAULT_REQUEST_VALUE = "GI-FRMWRK-RQST-DFLT";
    
    /**
     * 
     * @var string 
     * @since GI-FRMWRK.00.02 
     */
    const ERROR_REQUEST_NAME = "GI-FRMWRK-ERROR";

}
