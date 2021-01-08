<?php
/**
 * GI-Framework-DVLP - Form
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package \GIndie\Framework\View
 *
 * @version 00.A0
 * @since 18-04-09
 */

namespace GIndie\Framework\View\FormInput;

/**
 * @edit 18-04-09
 * - Created defineScript()
 * @edit 18-09-29
 * - Upgraded class dockblock
 */
class Form extends \GIndie\ScriptGenerator\Dashboard\FormInput\Form
{

    /**
     * 
     * @return string
     * @since 18-04-09
     */
    public function defineScript()
    {
        $out = "";
        if (!\is_null($this->getId())) {
            \ob_start();
            ?>
            <script>
                $("#<?= $this->getId(); ?>").validate({debug: false});
            </script>
            <?php
            $out = \ob_get_contents();
            \ob_end_clean();
        }
        return $out;
    }

}
