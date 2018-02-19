<?php

namespace GIndie\Framework\ExceptionHandler;

/**
 * DVLP-Framework - UserException
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package Framework
 *
 * @version GI-FRMWRK.00.00 18-02-18 Empty class created.
 */
class UserException extends \GIndie\Exception
{

    /**
     * 
     * @factory
     * @since GI-CMMN.00.03
     * 
     * @param string $pathToFile
     * @return \GIndie\Exception
     */
    public static function defaultError($message)
    {
        return new static(static::DEFAULT_ERROR, $message);
    }

    /**
     * 
     * @since GI-CMMN.00.03
     * 
     * @param int $constant
     * @param string|null $param1
     * @param string|null $param2
     * @return string
     * @edit GI-CMMN.00.04
     * - Removed static from visibility for using $this.
     * 
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
     * REQUIRED_VAR
     * 
     * @var int
     * @since GI-CMMN.00.01
     * @edit GI-CMMN.00.02
     * - Renamed to FILE_REQUIRES_VAR from REQUIRED_VAR
     * @edit GI-CMMN.00.03
     * - Moved from GIndie\Exception
     */
    const DEFAULT_ERROR = 0;

}
