<?php

/**
 * GI-Framework-DVLP - FormInput
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package \GIndie\Framework\View
 *
 * @version 00.A5
 * @since 18-02-17
 */

namespace GIndie\Framework\View;

use GIndie\ScriptGenerator\Bootstrap3;

/**
 * @edit 18-02-17
 * - Created formGetOnCustom(), formGetOnSelf(), formPostOnSelf(), formPostOnCustom()
 * @edit 18-02-20
 * - Updated formGetOnCustom(), formGetOnSelf(), formPostOnSelf(), formPostOnCustom()
 * @edit 18-04-09
 * - Created form()
 * @edit 18-09-29
 * - Upgraded class dockblock
 * - Created buttonSubmitForm()
 */
class FormInput extends \GIndie\ScriptGenerator\Dashboard\FormInput {

    /**
     * @since 18-04-09
     * 
     * @return \GIndie\Framework\View\FormInput\Form
     */
    public static function form() {
        return new FormInput\Form();
    }

    /**
     * 
     * @param string $formId
     * @param string $customTarget
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\FormInput\Form
     * 
     * @since 18-02-17
     * @edit 18-02-20
     */
    public static function formGetOnCustom($formId, $customTarget) {
        $form = parent::formGetOnCustom($formId, $customTarget)->addInput(static::inputHidden(\GIndie\Framework\Controller::DEFAULT_REQUEST_NAME,
                        $formId));
        //$form->addScript("$(\"#{$formId}\").validate({debug: false});");
        return $form;
    }

    /**
     * 
     * @param string $formId
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\FormInput\Form
     * 
     * @since 18-02-17
     * @edit 18-02-20
     */
    public static function formGetOnSelf($formId) {
        $form = parent::formGetOnSelf($formId)->addInput(static::inputHidden(\GIndie\Framework\Controller::DEFAULT_REQUEST_NAME,
                        $formId));
        //$form->addScript("$(\"#{$formId}\").validate({debug: false});");
        return $form;
    }

    /**
     * 
     * @param string $formId
     * @param string $customTarget
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\FormInput\Form
     * 
     * @since 18-02-17
     * @edit 18-02-20
     */
    public static function formPostOnCustom($formId, $customTarget) {
        $form = parent::formPostOnCustom($formId, $customTarget)->addInput(static::inputHidden(\GIndie\Framework\Controller::DEFAULT_REQUEST_NAME,
                        $formId));
        //$form->addScript("$(\"#{$formId}\").validate({debug: false});");
        return $form;
    }

    /**
     * 
     * @param string $formId
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\FormInput\Form
     * 
     * @since 18-02-17
     * @edit 18-02-20
     */
    public static function formPostOnSelf($formId) {
        $form = parent::formPostOnSelf($formId)->addInput(static::inputHidden(\GIndie\Framework\Controller::DEFAULT_REQUEST_NAME,
                        $formId));
        //$form->addScript("$(\"#{$formId}\").validate({debug: false});");
        return $form;
    }

    /**
     * 
     * @param string $formId
     * @param string $buttonContent
     * @param string $name
     * @param string $value
     * @return \GIndie\ScriptGenerator\Bootstrap3\Component\Button
     * @since 18-09-29
     */
    public static function buttonSubmitForm($formId, $buttonContent, $name = null, $value = null) {
        $rtnBtn = new Bootstrap3\Component\Button($buttonContent, "submit");
        $rtnBtn->addClass("btn-sm"); 
        $rtnBtn->setForm($formId);
        if ($name !== null) {
            $rtnBtn->setAttribute("name", $name);
            $rtnBtn->setValue($value);
        }
        return $rtnBtn;
    }

}
