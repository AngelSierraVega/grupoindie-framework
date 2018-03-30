<?php

namespace GIndie\Framework\View;

/**
 * GI-Framework-DVLP - Widget
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package Framework
 * @subpackage Sandbox
 *
 * @version AO
 * @since 18-04-07
 */
class Widget extends \GIndie\ScriptGenerator\Dashboard\Widget
{

    /**
     * 
     * @param array $params
     * @return $this
     * @since 18-04-07
     * @todo upgrade method
     */
    public function addActionHeading(array $params)
    {
        $form = new \GIndie\Platform\View\Form(null, true, isset($params["target"]) ? $params["target"] : false);
        !isset($params["gip-action"]) ?: $form->setAttribute("gip-action", $params["gip-action"]);
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

}
