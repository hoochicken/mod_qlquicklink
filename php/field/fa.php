<?php
/**
 * @package        mod_qlform
 * @copyright    Copyright (C) 2023 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;
jimport('joomla.html.html');
//import the necessary class definition for formfield
jimport('joomla.form.formfield');

class JFormFieldFa extends JFormField
{
    /**
     * The form field type.
     *
     * @var  string
     * @since 1.6
     */
    protected string $filepath = __DIR__ . '/fa.txt'; //the form field type see the name is the same

    /**
     * Method to retrieve the lists that resides in your application using the API.
     *
     * @return array The field option objects.
     * @since 1.6
     */
    protected function getInput()
    {
        $this->value = trim($this->value);
        $faClassesRaw = $this->getFaClassesByFile($this->filepath);
        $faClasses = [];
        foreach ($faClassesRaw as $faSelector) {
            $key = substr($faSelector, 4);
            $faClasses[$key] = $faSelector;
        }
        $html = '';
        $html .= sprintf('<select class="form-control" name="%s" id="%s">',$this->name, $this->id);
        $html .= sprintf('<option %s value="">%s</option>', empty(trim($this->value)) ? 'selected' : '', Text::_('MOD_QLQUICKLINK_CHOOSEPLZ'));
        foreach ($faClasses as $label => $class) {
            $html .= sprintf('<option %s value="%s">%s</option>', $label === trim($this->value) ? 'selected' : '', $label, $label);
        }
        $html .= '</select>';
        return $html;
    }

    protected function getFaClassesByFile(string $filepath): array
    {
        $raw = file_exists($filepath) ? file_get_contents($filepath) : '';
        $fa = array_filter(explode("\n", (string)$raw));
        array_walk($fa, function(&$item) { $item = trim($item); });
        return $fa;
    }

}