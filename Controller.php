<?php

namespace GIndie\Framework;

use GIndie\ScriptGenerator\Bootstrap3;

/**
 * DVLP-Framework - Controller
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package Framework
 *
 * @version GI-FRMWRK.00.00 18-02-17 
 * - Empty class created.
 * @edit GI-FRMWRK.00.01
 * - Abstract class
 * - Created configRequestHandler(), handleRequestGet(), handleRequestPost(), run(), config()
 * - Created $DEFAULT_REQUEST_NAME, $DEFAULT_REQUEST_VALUE, $requestHandlers, $requestParameters
 * @edit GI-FRMWRK.00.02 18-02-18
 * - Class implements DefaultRequestValues
 * - Created setUserError(), getUserError()
 * @edit GI-FRMWRK.00.03 18-02-20
 * - Created widgetForm(), getDOM(), inputText()
 * - Updated run()
 * @edit GI-FRMWRK.00.04 18-02-23
 * - Created sanitize()
 */
abstract class Controller implements Controller\DefaultRequestValuesINT
{

    /**
     * 
     * @param string $message
     * @return boolean
     * 
     * @since GI-FRMWRK.00.02
     */
    protected static function setUserError($message)
    {
        if (!isset(static::$requestParameters[static::ERROR_REQUEST_NAME])) {
            static::$requestParameters[static::ERROR_REQUEST_NAME] = [];
        }
        static::$requestParameters[static::ERROR_REQUEST_NAME][] = $message;
        return true;
    }

    /**
     * 
     * @return array|null
     * 
     * @since GI-FRMWRK.00.02
     */
    protected static function getUserError()
    {
        return isset(static::$requestParameters[static::ERROR_REQUEST_NAME]) ?
                static::$requestParameters[static::ERROR_REQUEST_NAME] : null;
    }

    /**
     * @since GI-FRMWRK.00.01
     */
    abstract public static function config();

    /**
     * 
     * @param type $callable
     * @param type $requestCode
     * @since 18-03-30
     */
    public static function configGetRequest($callable, $requestCode = null)
    {
        return self::configRequestHandler("GET", $callable, $requestCode);
    }
    
    /**
     * 
     * @param type $callable
     * @param type $requestCode
     * @since 18-03-30
     */
    public static function configPostRequest($callable, $requestCode = null)
    {
        return self::configRequestHandler("POST", $callable, $requestCode);
    }

    /**
     * 
     * @param string $requestMethod
     * @param string $callable
     * @param string|null $requestCode
     * @return boolean
     * @throws \Exception
     * @since GI-FRMWRK.00.01
     * @edit 18-03-30 
     */
    private static function configRequestHandler($requestMethod, $callable, $requestCode = null)
    {
        switch (true)
        {
            case (\is_callable($callable) == false):
                \trigger_error($callable . " is not callable.", \E_USER_ERROR);
            case \is_null($requestCode):
                $requestCode = self::DEFAULT_REQUEST_VALUE;
            default:
                self::$requestHandlers[$requestMethod][$requestCode] = $callable;
        }
        return true;
    }

    /**
     * 
     * @since GI-FRMWRK.00.01
     * @edit 18-03-29
     * - Removed method param $parameters
     * - Renamed method from handleRequestGet to runGetRequest
     */
    private static function runGetRequest()
    {
        $parameters = self::$requestParameters;
        if (!isset($parameters["GET"][self::DEFAULT_REQUEST_NAME])) {
            $parameters["GET"][self::DEFAULT_REQUEST_NAME] = self::DEFAULT_REQUEST_VALUE;
        }
        $requestCode = $parameters["GET"][self::DEFAULT_REQUEST_NAME];

        return \call_user_func(self::$requestHandlers["GET"][$requestCode]);
    }

    /**
     * 
     * @since GI-FRMWRK.00.01
     * @edit 18-03-29
     * - Removed method param $parameters
     * - Renamed method from handleRequestPost to runPostRequest
     */
    private static function runPostRequest()
    {
        $parameters = self::$requestParameters;
        if (!isset($parameters[self::DEFAULT_REQUEST_NAME])) {
            $parameters[self::DEFAULT_REQUEST_NAME] = self::DEFAULT_REQUEST_VALUE;
        }
        $requestCode = $parameters[self::DEFAULT_REQUEST_NAME];
        return \call_user_func(self::$requestHandlers["POST"][$requestCode]);
    }

    /**
     * 
     * @param array $data
     * @return array
     * 
     * @since GI-FRMWRK.00.04
     */
    private static function sanitize(array $data)
    {
//        foreach ($data as $key => $value) {
//            $data[$key] = \GIndie\DBHandler\MySQL::getConnection()->escape_string(\htmlspecialchars($value));
//        }
        return $data;
    }

    /**
     * 
     * @param string $requestMethod
     * @return null|mixed
     * @since 18-03-29
     */
    protected static function runUserRequest($requestMethod)
    {
        static::$response = null;
        switch ($requestMethod)
        {
            case "GET":
                static::$requestParameters = self::sanitize($_GET);
                static::$response = self::runGetRequest();
                break;
            case "POST":
                static::$requestParameters = self::sanitize($_POST);
                static::$response = self::runPostRequest();
                break;
        }
        return static::$response;
    }

    /**
     *
     * @var mixed|null 
     * @since 18-03-29
     */
    protected static $response;

    /**
     * 
     * @return type
     * @since GI-FRMWRK.00.01
     * @edit 18-03-29
     * - Exploded code into handleRequest()
     */
    public static function run()
    {
        isset(self::$requestHandlers) ?: static::config();
        $DOM = static::getDOM();
        try {
            static::runUserRequest($_SERVER["REQUEST_METHOD"]);
        } catch (ExceptionHandler\UserException $exc) {
            static::$response = $exc->getMessage();
        }
        $DOM->addContent(static::$response);
        return $DOM;
    }

    /**
     * 
     * @return \GIndie\Framework\View\DOM
     * 
     * @since GI-FRMWRK.00.03
     */
    protected static function getDOM()
    {
        return View\DOM::instanceWithWebSources("");
    }

    /**
     * 
     * @param string $title
     * @param \GIndie\ScriptGenerator\Dashboard\FormInput\Form $form
     * @param boolean $submit
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\Widget\FormWidget
     * 
     * @since GI-FRMWRK.00.03
     */
    protected static function widgetForm($title, \GIndie\ScriptGenerator\Dashboard\FormInput\Form $form,
                                         $submit = false)
    {
        $widget = new \GIndie\ScriptGenerator\Dashboard\Widget\FormWidget($form, $submit);
        $widget->getHeading()->setTitle($title);
        if (static::getUserError() !== null) {
            foreach (static::getUserError() as $error) {
                $alert = Bootstrap3\Component\Alert::warning($error);
                $widget->getHeadingBody()->addContent($alert);
            }
        }
        return $widget;
    }

    /**
     *
     * @var array 
     * @since GI-FRMWRK.00.01
     */
    private static $requestHandlers;

    /**
     *
     * @var array 
     * @since GI-FRMWRK.00.01
     */
    protected static $requestParameters;

}
