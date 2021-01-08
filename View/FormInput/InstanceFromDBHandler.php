<?php

/**
 * GI-FRMWRK - InstanceFromDBHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package \GIndie\Framework\View
 *
 * @version 00.A0
 * @since 19-12-20
 */

namespace GIndie\Framework\View\FormInput;

use GIndie\DBHandler\MySQL57\Instance\ColumnDefinition;
use GIndie\DBHandler\MySQL57\Instance\Table;
use GIndie\DBHandler\MySQL57\Instance\DataType;

/**
 * Description of InstanceFromDBHandler
 *
 * @author angel
 */
class InstanceFromDBHandler
{

    /**
     * 
     * @param $table
     * @return \GIndie\Framework\View\FormInput\Form
     * @since 20-03-05
     */
    public static function getFormFilter($table,$columns)
    {
        if (\is_subclass_of($table, Table::class, false)) {
            $form = new Form();
            foreach ($columns as $columnName => $columnDefinition) {
                
                $ref = $table->referenceDefinition();
                $foreignKeys = $ref->getForeignKeys();
                if (\array_key_exists($columnName, $foreignKeys)) {
                    $instanceTable = $foreignKeys[$columnName];
                    $instanceTable = $instanceTable::instance();
                    $select = static::getSelect($columnName, $columnDefinition, $instanceTable);
                    $inputGroup = new \GIndie\ScriptGenerator\Bootstrap3\FormInput\InputGroup($select, $table::TABLE);
                    $formGroup = new \GIndie\ScriptGenerator\Bootstrap3\FormInput\FormGroup($columnName, $inputGroup);
                    $form->addContent($formGroup);
                    //$form->addContent(static::getSelect($columnName, $columnDefinition, $instanceTable));
                } else {
                    $form->addContent(static::getInputGroup($columnName, $columnDefinition, $table::TABLE));
                }
            }
        } else {
            \trigger_error("Invalid object", \E_USER_ERROR);
        }
        return $form;
    }

    /**
     * 
     * @param string $columnName
     * @param ColumnDefinition $columnDefinition
     * @since 20-03-05
     */
    public static function getInputGroup($columnName, ColumnDefinition $columnDefinition, $tableName)
    {
        $label = $columnName;
        $name = $columnName;
        $input = static::getInput($columnName, $columnDefinition);
        $inputGroup = new \GIndie\ScriptGenerator\Bootstrap3\FormInput\InputGroup($input, $tableName);
        $formGroup = new \GIndie\ScriptGenerator\Bootstrap3\FormInput\FormGroup($label, $inputGroup);
        return $formGroup;
        return $inputGroup;
    }

    /**
     * 
     * @param $table
     * @return \GIndie\Framework\View\FormInput\Form
     * @since 19-12-20
     * @edit 19-12-29
     */
    public static function getForm($table)
    {
        if (\is_subclass_of($table, Table::class, false)) {
            $form = new Form();
            foreach ($table->columns() as $columnName => $columnDefinition) {
                $ref = $table->referenceDefinition();
                $foreignKeys = $ref->getForeignKeys();
                if (\array_key_exists($columnName, $foreignKeys)) {
                    $instanceTable = $foreignKeys[$columnName];
                    $instanceTable = $instanceTable::instance();
                    $select = static::getSelect($columnName, $columnDefinition, $instanceTable);
                    $formGroup = new \GIndie\ScriptGenerator\Bootstrap3\FormInput\FormGroup($columnName, $select);
                    $form->addContent($formGroup);
                    //return $formGroup;
                    //$form->addContent(static::getSelect($columnName, $columnDefinition, $instanceTable));
                } else {
                    $form->addContent(static::getFormGroup($columnName, $columnDefinition));
                }
            }
        } else {
            \trigger_error("Invalid object", \E_USER_ERROR);
        }
        return $form;
    }

    /**
     * 
     * @param type $columnName
     * @param type $columnDefinition
     * @param Table $table
     * @return \GIndie\ScriptGenerator\Bootstrap3\FormInput\FormGroup
     * @since 19-12-29
     */
    public static function getSelect($columnName, ColumnDefinition $columnDefinition, Table $referencedTable)
    {
        $label = $columnName;
        if ($columnDefinition->getNotNull() == true) {
            $options = [];
        } else {
            $options = ["NULL" => "Sin definir"];
        }
        $selectors = [];
        $selectors[] = "`" . $referencedTable->referenceDefinition()->getPrimaryKeyName() . "`";
        $uniqueKey = $referencedTable->referenceDefinition()->getUniqueKeyName();
        if (\is_array($uniqueKey)) {//COALESCE(`columna`,'')
            $tmpSelect = "CONCAT(COALESCE(" . \join(",''),'|',COALESCE(", $uniqueKey) . ",'')) AS DISPLAY";
            $selectors[] = $tmpSelect;
        } else {
            $selectors[] = "`{$uniqueKey}` AS DISPLAY";
        }
        $assoc = $referencedTable->fetchAssoc($selectors, [], []);
        foreach ($assoc as $key => $value) {
            $options[$key] = $value["DISPLAY"];
        }
        $select = new \GIndie\ScriptGenerator\HTML5\Category\FormElement\Select($options);
        $select->setId($columnName);
        $select->setName($columnName);
        return $select;
        $formGroup = new \GIndie\ScriptGenerator\Bootstrap3\FormInput\FormGroup($label, $select);
        return $formGroup;
    }

    /**
     * 
     * @param string $columnName
     * @param ColumnDefinition $columnDefinition
     * @return \GIndie\ScriptGenerator\Bootstrap3\FormInput\FormGroup
     * @since 19-12-20
     */
    public static function getFormGroup($columnName, ColumnDefinition $columnDefinition)
    {
        $label = $columnName;
        $name = $columnName;
//        $formGroup = \GIndie\ScriptGenerator\Dashboard\FormInput::inputText($label, $name);
        //$formGroup = \GIndie\ScriptGenerator\Bootstrap3\FormInput\FormGroup::instance($label, $input);
        $formGroup = new \GIndie\ScriptGenerator\Bootstrap3\FormInput\FormGroup($label, static::getInput($columnName, $columnDefinition));
        return $formGroup;
    }

    /**
     * 
     * @param type $columnName
     * @param ColumnDefinition $columnDefinition
     * @return type
     */
    public static function getInput($columnName, ColumnDefinition $columnDefinition)
    {
        $rtnInput = null;
        //Handle datatype
        switch ($columnDefinition->getDataTypeName()) {
            case DataType::DATATYPE_BIGINT:
            case DataType::DATATYPE_DEC:
            case DataType::DATATYPE_DECIMAL:
            case DataType::DATATYPE_DOUBLE:
            case DataType::DATATYPE_DOUBLE_PRECISION:
            case DataType::DATATYPE_FLOAT:
            case DataType::DATATYPE_INT:
            case DataType::DATATYPE_INTEGER:
            case DataType::DATATYPE_NUMERIC:
            case DataType::DATATYPE_REAL:
            case DataType::DATATYPE_SERIAL:
            case DataType::DATATYPE_SMALLINT:
            case DataType::DATATYPE_TINYINT:
                $rtnInput = \GIndie\ScriptGenerator\Bootstrap3\FormInput::inputNumber();
                break;
            case DataType::DATATYPE_TEXT:
            case DataType::DATATYPE_MEDIUMTEXT:
            case DataType::DATATYPE_VARCHAR:
            case DataType::DATATYPE_CHAR:
                $rtnInput = \GIndie\ScriptGenerator\Bootstrap3\FormInput::inputText();
                break;
            case DataType::DATATYPE_TIMESTAMP:
            case DataType::DATATYPE_TIME:
                $rtnInput = \GIndie\ScriptGenerator\Bootstrap3\FormInput::inputTime();
                break;
            case DataType::DATATYPE_DATE:
                $rtnInput = \GIndie\ScriptGenerator\Bootstrap3\FormInput::inputDate();
                break;
            case DataType::DATATYPE_DATETIME:
                $rtnInput = \GIndie\ScriptGenerator\Bootstrap3\FormInput::inputDateTimeLocal();
                break;
            case DataType::DATATYPE_ENUM:
                $enum = [];
                foreach ($columnDefinition->getDataType()->getValuesUnformatted() as $value) {
                    $enum[$value] = $value;
                }
                $rtnInput = new \GIndie\ScriptGenerator\HTML5\Category\FormElement\Select($enum);
                break;
            case DataType::DATATYPE_SET:
                $rtnInput = \GIndie\ScriptGenerator\Bootstrap3\FormInput::inputText();
                break;
            default:
                \trigger_error("@todo handle DATATYPE_" . $columnDefinition->getDataType()->getDatatype(),
                    \E_USER_ERROR);
        }
        $rtnInput->setId($columnName);
        $rtnInput->setName($columnName);
        return $rtnInput;
    }

}
