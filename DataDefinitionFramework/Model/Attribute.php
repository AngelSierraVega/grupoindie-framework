<?php

/**
 * GI-FRMWRK - Attribute
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2019 Angel Sierra Vega. Grupo INDIE.
 *
 * @package \GIndie\Framework\DataDefinition
 *
 * @version DOING
 */

namespace GIndie\Framework\DataDefinitionFramework\Model;

/**
 *
 * @author angel
 * @edit 19-12-20
 * - Added constants from Platform\Model\Attribute
 */
interface Attribute
{

    /**
     * Original: 0
     */
    const TYPE_STRING = "TYPE_STRING";

    /**
     * Original: 1
     */
    const TYPE_NUMERIC = "TYPE_NUMERIC";

    /**
     * @var         type TYPE_BOOLEAN
     */
    const TYPE_BOOLEAN = 2;

    /**
     * @var         type TYPE_DATE
     */
    const TYPE_DATE = 3;

    /**
     * @var         type TYPE_FOREIGN_KEY
     */
    const TYPE_FOREIGN_KEY = 4;

    /**
     * @var         type TYPE_PASSWORD
     */
    const TYPE_PASSWORD = 5;

    /**
     * @var         int TYPE_EMAIL
     */
    const TYPE_EMAIL = 6;

    /**
     * @since       17-04-29
     * @var         int TYPE_TIMESTAMP
     */
    const TYPE_TIMESTAMP = 7;

    /**
     * @since       17-04-29
     * @var         int TYPE_OPTIONGROUP
     */
    const TYPE_OPTIONGROUP = 8;

    /**
     * @since       GIP.00.05
     * @var         int TYPE_OPTIONGROUP
     */
    const TYPE_ENUM = 9;

    /**
     * @since GIP.00.07
     * @var int TYPE_HIDDEN
     */
    const TYPE_HIDDEN = 10;

    /**
     * @since GIP.00.08
     * @var int TYPE_CURRENCY
     */
    const TYPE_CURRENCY = 11;

    /**
     * @var int TYPE_LINK
     */
    const TYPE_LINK = 12;

    /**
     * @since 19-04-13
     */
    const TYPE_FILE = 13;

    /**
     * @since 19-04-13
     */
    const TYPE_COLOR = 14;

}
