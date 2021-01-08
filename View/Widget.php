<?php

/**
 * GI-Framework-DVLP - Widget
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package \GIndie\Framework\View
 *
 * @version 00.A0
 * @since 18-04-07
 */

namespace GIndie\Framework\View;

/**
 * @edit 18-04-07
 * - Created addActionForm(), addActionPost()
 * @edit 18-09-29
 * - Upgraded class dockblock
 */
class Widget extends \GIndie\ScriptGenerator\Dashboard\Widget
{

    /**
     * 
     * @param \GIndie\Framework\View\FormInput\Form $form
     * @param array $params
     * @since 18-04-07
     * @return \GIndie\Framework\View\Widget
     */
    public function addActionForm(FormInput\Form $form, array $params)
    {
        switch (false)
        {
            case \is_null($this->getHeadingBody()):
                $this->getHeadingBody()->addContent($form);
                break;
            case \is_null($this->getBody()):
                $this->getBody()->addContent($form);
                break;
            case \is_null($this->getBodyFooter()):
                $this->getBodyFooter()->addContent($form);
                break;
            case \is_null($this->getFooter()):
                $this->getFooter()->addContent($form);
                break;
            default:
                $this->getHeading()->addContent($form);
                break;
        }
        $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button(isset($params["action-name"]) ? $params["action-name"] : "Submit", "submit");
        $button->addClass("btn-sm");
        !isset($params["context"]) ?: $button->setContext($params["context"]);
        $button->setForm($form->getId());
        $this->addButtonHeading($button);
        return $this;
    }

    /**
     * 
     * @param array $params
     * @since 18-04-07
     * @return \GIndie\Framework\View\Widget
     */
    public function addActionPost($formId, array $params)
    {
        //$formId = "TEST_ID_FORM";
        if (isset($params["target"])) {
            $form = FormInput::formPostOnCustom($formId, $params["target"]);
        } else {
            $form = FormInput::formPostOnSelf($formId);
        }
        !isset($params["action"]) ?: $form->setAttribute("action", $params["action"]);
        return $this->addActionForm($form, $params);
    }

}
