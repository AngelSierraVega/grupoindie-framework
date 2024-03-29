<?php

/**
 * GI-Framework-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package \GIndie\Framework\View
 *
 * @version 00.B1
 * @since 18-04-10
 */

namespace GIndie\Framework\View;

/**
 * @edit 18-04-10
 * - Created displayArray(), selectable()
 * @edit 18-09-29
 * - Upgraded class dockblock
 * @edit 18-11-01
 * - Class extends \GIndie\ScriptGenerator\Dashboard\Tables\Table
 */
class Table extends \GIndie\ScriptGenerator\Dashboard\Tables\Table {

    /**
     * 
     * @since 18-04-10
     * 
     * @param array $data
     * @param mixed|null $caption
     * @param int|null $breakPoint
     * 
     * @return \GIndie\Framework\View\Table
     * 
     * @edit 18-08-04
     * - Added functional param $caption
     * @edit 18-11-01
     * - Displays strong tag on array key if is not a node
     * @edit 18-11-11
     * - Added param $breakPoint
     * - Handles automatic columns for displaying data
     * @edit 18-12-02
     * - Debuged auto-columns
     */
    public static function displayArray(array $data, $caption = null, $breakPoint = null) {
        $table = new static();
        if (!\is_null($caption)) {
            $table->addContent("<caption>{$caption}</caption>");
        }
        foreach ($data as $key => $value) {
            if (!\is_subclass_of($key, \GIndie\ScriptGenerator\DML\Node\NodeAbs::class, false)) {
                unset($data[$key]);
                $key = \GIndie\ScriptGenerator\HTML5\Category\Phrase::strong($key);
            }
            $data[$key . ""] = $value;
        }
        if (\count($data) > 4) {
            if (\is_null($breakPoint)) {
                $breakPoint = \round((\count($data) / 2));
            }
            $iterator = 0;
            $currentRow = 0;
            foreach ($data as $key => $value) {
                if ($iterator < $breakPoint) {
                    $table->addRow([$key, $value]);
                } else {
                    if ($table->getRow($currentRow)) {
                        $table->getRow($currentRow)->addContent($key);
                        $table->getRow($currentRow)->addContent($value);
                        $currentRow++;
                    }
                }
                $iterator++;
            }
        } else {
            foreach ($data as $key => $value) {
                $table->addRow([$key, $value]);
            }
        }
        return $table;
    }

    /**
     * 
     *
     * 
     * @return \GIndie\Framework\View\Table
     *  @since 18-04-10
     * @edit 18-11-01
     * - Removed class table
     */
    public static function selectable() {
        $table = new Table();
        $table->addClass("table-hover"); //table-condensed
        return $table;
    }

    /**
     * 
     * @param string $classname
     * @param array $selectors
     * @param array $conditions
     * @param array $params
     * @return \GIndie\Framework\View\Table
     * @since 21-06-01
     */
    public static function instanceFromPlatformRecord($classname, array $selectors, array $conditions = [], array $params = []) {
        $record = $classname::instance();
        $table = new Table();
        $totales = [];
        $header = [];
        foreach ($selectors as $colName) {
//            var_dump($colName);
//            var_dump($record->getLabelOf($colName));
            $header[] = $record->getLabelOf($colName);
        }
        $table->addHeader($header);
        $queryRows = $record->fetchAssoc($record->getSelectorsDisplay(), $conditions, $params);
        foreach ($queryRows as $key => $row) {
            $rowData = [];
            foreach ($selectors as $columnName) {
                $column = $record->getAttribute($columnName);
                $record->setValueOf($columnName, $row[$columnName]);
                switch ($column->getType()) {
                    case \GIndie\Platform\Model\Attribute::TYPE_CURRENCY:
                        if (!isset($totales[$columnName])) {
                            $totales[$columnName] = 0;
                        }
                        $totales[$columnName] += \floatval($row[$columnName]);
                        \GIndie\ScriptGenerator\HTML5\Tables\Row::TYPE_CONTENT_ONLY;
                        $rowData[] = \GIndie\ScriptGenerator\HTML5\Tables\Cell::standard($record->getDisplayOf($columnName))->setAttribute("align", "right");
                        break;
                    default:
                        $rowData[] = $record->getDisplayOf($columnName);
                }
            }
            $table->addRow($rowData);
        }
        if (\sizeof($totales) > 0) {
            $rowData = [];
            foreach ($selectors as $columnName) {
                $column = $record->getAttribute($columnName);
                switch ($column->getType()) {
                    case \GIndie\Platform\Model\Attribute::TYPE_CURRENCY:
                        $rowData[] = \GIndie\ScriptGenerator\HTML5\Tables\Cell::standard(\GIndie\Common\Parser\Currency::formatFull($totales[$columnName]))->setAttribute("align", "right");
                        break;
                    default:
                        $rowData[] = "";
                        break;
                }
            }
            $table->addRow($rowData);
        }
        return $table;
    }

}
