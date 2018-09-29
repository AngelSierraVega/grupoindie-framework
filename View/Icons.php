<?php

/**
 * GI-Framework-DVLP - Icons
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2019 Angel Sierra Vega. Grupo INDIE.
 *
 * @package \GIndie\Framework\View
 *
 * @version 00.04
 * @since 19-02-04
 */

namespace GIndie\Framework\View;

use GIndie\ScriptGenerator\Bootstrap3\Instance\Glyphicon;

/**
 * Description of Icons
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class Icons
{

    /**
     * 
     * @param array $attributes
     * @return \GIndie\ScriptGenerator\Bootstrap3\Instance\Glyphicon
     * 
     * @since 19-02-04
     */
    public static function underConstruction(array $attributes = [])
    {
        return new Glyphicon(Glyphicon::GLYPHICON_COG, $attributes);
    }

}
