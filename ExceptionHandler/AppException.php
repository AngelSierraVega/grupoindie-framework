<?php

/**
 * GI-Framework-DVLP - AppException
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package \GIndie\Framework
 * 
 * @version 00.70
 * @since 18-02-22
 */

namespace GIndie\Framework\ExceptionHandler;

/**
 * @edit 18-02-22
 * - Added code from GI-CMMN
 * @edit 18-09-29
 * - Upgraded class dockblock
 */
class AppException extends \GIndie\Exception
{

    /**
     * 
     * @param string $message
     * 
     * @return \GIndie\Framework\ExceptionHandler\AppException
     * 
     * @since 18-02-22
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
     * @since 18-02-22
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
     * @since 18-02-22
     */
    const DEFAULT_ERROR = 0;

}
