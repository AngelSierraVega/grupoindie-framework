<?php

namespace GIndie\Framework\View;

/**
 * DVLP-Framework - FormInput
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package Framework
 *
 * @version GI-FRMWRK.00.00 18-02-17 Empty class created.
 * @edit GI-FRMWRK.00.01 18-02-17
 * - Created formGetOnCustom(), formGetOnSelf(), formPostOnSelf(), formPostOnCustom()
 * @edit GI-FRMWRK.00.02 18-02-20
 * - Updated formGetOnCustom(), formGetOnSelf(), formPostOnSelf(), formPostOnCustom()
 */
class FormInput extends \GIndie\ScriptGenerator\Dashboard\FormInput
{

    /**
     * 
     * @param string $formId
     * @param string $customTarget
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\FormInput\Form
     * 
     * @since  GI-FRMWRK.00.01
     * @edit GI-FRMWRK.00.02
     */
    public static function formGetOnCustom($formId, $customTarget)
    {
        $form = parent::formGetOnCustom($formId, $customTarget)->addInput(static::inputHidden(\GIndie\Framework\Controller::DEFAULT_REQUEST_NAME, $formId));
        $form->addScript("$(\"#{$formId}\").validate({debug: false});");
        return $form;
    }

    /**
     * 
     * @param string $formId
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\FormInput\Form
     * 
     * @since  GI-FRMWRK.00.01
     * @edit GI-FRMWRK.00.02
     */
    public static function formGetOnSelf($formId)
    {
        $form = parent::formGetOnSelf($formId)->addInput(static::inputHidden(\GIndie\Framework\Controller::DEFAULT_REQUEST_NAME, $formId));
        $form->addScript("$(\"#{$formId}\").validate({debug: false});");
        return $form;
    }

    /**
     * 
     * @param string $formId
     * @param string $customTarget
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\FormInput\Form
     * 
     * @since  GI-FRMWRK.00.01
     * @edit GI-FRMWRK.00.02
     */
    public static function formPostOnCustom($formId, $customTarget)
    {
        $form = parent::formPostOnCustom($formId, $customTarget)->addInput(static::inputHidden(\GIndie\Framework\Controller::DEFAULT_REQUEST_NAME, $formId));
        $form->addScript("$(\"#{$formId}\").validate({debug: false});");
        return $form;
    }

    /**
     * 
     * @param string $formId
     * 
     * @return \GIndie\ScriptGenerator\Dashboard\FormInput\Form
     * 
     * @since  GI-FRMWRK.00.01
     * @edit GI-FRMWRK.00.02
     */
    public static function formPostOnSelf($formId)
    {
        $form = parent::formPostOnSelf($formId)->addInput(static::inputHidden(\GIndie\Framework\Controller::DEFAULT_REQUEST_NAME, $formId));
        $form->addScript("$(\"#{$formId}\").validate({debug: false});");
        return $form;
    }

}
