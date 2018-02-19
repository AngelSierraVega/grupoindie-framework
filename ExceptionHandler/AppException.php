<?php

namespace GIndie\Framework\ExceptionHandler;

/**
 * DVLP-Framework - AppException
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package Framework
 *
 * @version GI-FRMWRK.00.00 18-02-22 
 * - Empty class created.
 * @edit GI-FRMWRK.00.01
 * - Added code from GI-CMMN
 */
class AppException extends \GIndie\Exception
{

    /**
     * 
     * @param string $message
     * 
     * @return \GIndie\Framework\ExceptionHandler\AppException
     * 
     * @since GI-FRMWRK.00.01
     */
    public static function defaultError($message)
    {
        return new static(static::DEFAULT_ERROR, $message);
    }

    /**
     * 
     * @param int $constant
     * @param string|null $param1
     * @param string|null $param2
     * 
     * @return string
     * @since GI-FRMWRK.00.01
     */
    protected function handleMessage($constant, $param1 = null, $param2 = null)
    {
        $message = "";
        switch ($constant)
        {
            case static::DEFAULT_ERROR:
                $message = $param1;
        }
        return $message;
    }

    /**
     * DEFAULT_ERROR
     * 
     * @var int
     * @since GI-FRMWRK.00.01
     */
    const DEFAULT_ERROR = 0;

}
