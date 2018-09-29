<?php
/**
 * GI-FRMWRK - InstanceFromPlatformRecord
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2019 Angel Sierra Vega. Grupo INDIE.
 *
 * @package \GIndie\Framework\View
 *
 * @version 00.70
 * @since 19-12-29
 */

namespace GIndie\Framework\View\FormInput;

/**
 * Description of InstanceFromPlatformRecord
 *
 * @author angel
 */
class InstanceFromPlatformRecord
{

    /**
     * 
     * @param type $name
     * @param \GIndie\ScriptGenerator\HTML5\Category\FormElement\Label $label
     * @param type $options
     * @return \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics\Div
     * @since 19-04-02
     */
    public static function select($name, $label, $options)
    {
        $formGroup = new \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics\Div();
        $formGroup->addClass("form-group");
        //$formGroup = static::formGroup($label, $input);
//        static::inpu
        $label = new \GIndie\ScriptGenerator\HTML5\Category\FormElement\Label($label);
        $label->setAttribute("for", $name);
        $select = new \GIndie\ScriptGenerator\HTML5\Category\FormElement\Select($options);
        $select->addClass("form-control");
//        $select->setAttribute("data-live-search", "true");
        $select->setName($name);
        $select->setId($name);

        $formGroup->addContent($label);
        $formGroup->addContent($select);
//        $formGroup->addContent('<script>
//                $(document).ready(function () {
//                $("#' . $name . '").selectpicker({size: 8});});</script>');
        return $formGroup;
    }

    /**
     * 
     * @param \GIndie\Platform\Model\Record $record
     * @return array
     * @since 19-07-03
     */
    public static function inputsFromPlatformRecord(\GIndie\Platform\Model\Record $record)
    {
        $rtnArray = [];
        foreach ($record->getAttributesForm() as $attrName) {
            if (\strcmp($record::PRIMARY_KEY, $attrName) !== 0) {
                $rtnArray[$attrName] = Input::constructFromAttribute(
                        $record->getAttribute($attrName),
                        $record->getValueOf($attrName),
                        $record->getId());
            } else {
                if ($record::AUTOINCREMENT == false) {
                    $rtnArray[$attrName] = Input::constructFromAttribute(
                            $record->getAttribute($attrName),
                            $record->getValueOf($attrName),
                            $record->getId());
                } else {
                    $rtnArray[$attrName] = Input::constructFromAttribute(
                            $record->getAttribute($attrName),
                            $record->getValueOf($attrName),
                            $record->getId());
                }
            }
        }
        return $rtnArray;
    }

    /**
     * Creates an input element from \GIndie\Platform\Model\Attribute
     * @param \GIndie\Platform\Model\Attribute $attribute
     * 
     * @since 19-07-03
     * - Instanced from Platform\View\Input
     */
    public static function inputFromPlatformAttribute(\GIndie\Platform\Model\Attribute $attribute, $value, $recordId)
    {
        $inputElement = null;
        switch ($value) {
            case "GIP-UNDEFINED":
                $value = "";
        }

        switch ($attribute->getType()) {
            case Attribute::TYPE_STRING:
                $form_element = "<input class='form-control' type='text' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" .
                    $value . "' " . $required . $restrictions . " >";
                break;
            case Attribute::TYPE_NUMERIC:
                $form_element = "<input class='form-control' type='number' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" .
                    $value . "' " . $required . $restrictions . " >";
                break;
            case Attribute::TYPE_BOOLEAN:
                $form_element = static::Checkbox($attribute->getName(), $value);
                break;
            case Attribute::TYPE_DATE:
                $form_element = "<input class='form-control dateinputtext' type='text' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" .
                    $value . "' " . $required . $restrictions . " >";
                break;

            case Attribute::TYPE_PASSWORD:
                $form_element = "<input class='form-control' type='password' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" .
                    $value . "' " . $required . $restrictions . " >";
                break;
            case Attribute::TYPE_EMAIL:
                $form_element = "<input class='form-control' type='email' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" .
                    $value . "' " . $required . $restrictions . " >";
                break;
            case Attribute::TYPE_TIMESTAMP:
                if ($value == "") {
                    $value = 0;
                }
                $form_element = "<input class='form-control dateinputtext' type='text' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" .
                    \date("Y-m-d", $value) . "' " . $required . " >";
                break;
            case Attribute::TYPE_FOREIGN_KEY:
                $form_element = static::selectFromAttribute($attribute, $value, $recordId);
                //$form_element = $this->_inputFK($attribute, $value);
                break;
            case Attribute::TYPE_OPTIONGROUP:
                /* $form_element = "<input class='form-control' type='text' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" . $attribute->getValue() . "' ".$required." >"; */
                $form_element = "<input type='radio' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" . $value . "' " . $required . " > I have a car";
                break;
            case Attribute::TYPE_ENUM:
                $form_element = "<select class='form-control selectpicker' "
                    . "data-live-search='false' id='{$attribute->getName()}' "
                    . "name='{$attribute->getName()}' " . $required . " >"
                    . static::_selectOptionsFromEnum($value, $attribute->getEnumOptions())
                    . "</select>";
                $form_element .= '<script>
                $(document).ready(function () {
                $("#' . $attribute->getName() . '").selectpicker({size: 8});});</script>';
                $scriptTemp = "";
                if (($slaveAttr = $attribute->getSlave()) !== \NULL) {
                    $recordClass = \urlencode($attribute->getRecordClass());
//                    $recordClass = \urlencode("NON");
                    ob_start();

                    ?>
                    <script>
                        $(document).ready(function () {
                            $("#<?= $attribute->getName(); ?>").change(function () {
                                $("#<?= $slaveAttr; ?>").parent().replaceWith("<div><div id='<?= $slaveAttr; ?>'>Cargando contenido, por favor espere...</div></div>");
                                var data = {
                                    'gip-action': "get-input",
                                    'gip-action-id': '<?= $slaveAttr; ?>',
                                    'gip-selected-id': this.value,
                                    'gip-action-class': "<?= $recordClass; ?>",
                                    'gip-record-id': "<?= $recordId; ?>"
                                };
                                $.ajax({
                                    type: "POST",
                                    data: data,
                                    url: "?", //
                                    success: function (data) {
                                        $("#<?= $slaveAttr; ?>").parent().replaceWith(data);
                                        //parent(".form-group")
                                    }
                                });
                            });
                            setTimeout(function () {
                                $("#<?= $attribute->getName(); ?>").change();
                            }, 50);
                            //$("#<?= ""; //$attribute->getName();                        ?>").change();
                        });
                    </script>
                    <?php
                    $scriptTemp = ob_get_contents();
                    ob_end_clean();
                }
                $form_element .= $scriptTemp;
                break;
            case Attribute::TYPE_HIDDEN:
                $form_element = "<input type='hidden' "
                    . "id='{$attribute->getName()}' "
                    . "name='{$attribute->getName()}' "
                    . "value='{$value}' "
                    . " >"
                    . "</input>";
                break;
            case Attribute::TYPE_CURRENCY:
                $form_element = "<input class='form-control' type='number' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" .
                    $value . "' " . $required . $restrictions . " >";
                break;
//            case Attribute::TYPE_FILE:
//                $form_element = new \GIndie\ScriptGenerator\HTML5\Category\FormInput\Input\File();
//                $form_element->addClass("form-control");
//                $form_element->setId("fileToUpload");
//                $form_element->setName("fileToUpload");
//                $form_element = '<input type="hidden" name="MAX_FILE_SIZE" value="30000" />' . $form_element;
//                break;
            case Attribute::TYPE_COLOR:
                $form_element = new \GIndie\ScriptGenerator\HTML5\Category\FormInput\Input\Color();
                $form_element->addClass("form-control");
                $form_element->setId($attribute->getName());
                $form_element->setName($attribute->getName());
                $form_element->setValue($value);
                break;
            default:
                \trigger_error("Unrecognized type " . $attribute->getType() . " using text",
                    \E_USER_WARNING);
                $form_element = "<input class='form-control' type='text' id='{$attribute->getName()}' name='{$attribute->getName()}' value='" .
                    $value . "' " . $required . " >";
                break;
        }
        $required = "";
        if ($attribute->getRestrictionRequired()) {
            $required = "required='required'";
        }
        $restrictions = " ";
        foreach ($attribute->getRestrictions() as $key => $val_res) {
            $restrictions .= "$key='$val_res' ";
        }
        switch (\TRUE) {
            case ($attribute->getType() == Attribute::TYPE_HIDDEN):
                $rtnStr = $form_element;
                break;
            case \TRUE:
                $rtnStr = '<div class="form-group ';
                $rtnStr .= $attribute->getSize();
                //clase checkbox modifica la etiqueta default de un input.
                //$rtnStr .= $attribute->getType() == Record::TYPE_BOOLEAN ? ' checkbox">' : '">';
                $rtnStr .= '">';
                $rtnStr .= "<label for='{$attribute->getName()}'>";
                if ($attribute->getHelp() !== \NULL) {
                    $icon = Icons::Help();
                    //$icon->setAttribute("data-toggle", "tooltip");
                    //$icon->setAttribute("data-placement", "top");
                    $icon->setAttribute("title", $attribute->getHelp());
                    //$icon->setAttribute("container", "body");
                    $rtnStr .= "<sup>" . $icon . "</sup>&nbsp";
                }
                $rtnStr .= $attribute->getLabel() . "</label>";
                $rtnStr .= $form_element;
//                if (!\is_null($attribute->getHelp())) {
//                    $rtnStr .= "<i>Nota: " . $attribute->getHelp() . "</i>";
//                }
                $rtnStr .= '</div>';
                break;
        }
        return $rtnStr;
    }

}
