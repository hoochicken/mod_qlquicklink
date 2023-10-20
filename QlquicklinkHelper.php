<?php
/**
 * @package        mod_qlqlquicklink
 * @copyright    Copyright (C) 2023 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ql\Module\Qlquicklink\Site;
// no direct access
use Joomla\Registry\Registry;
use Ql\Module\Qlquicklink\Site\php\classes\QlquicklinkButton;
use stdClass;

defined('_JEXEC') or die;

class QlquicklinkHelper
{
    public Registry $params;
    public stdClass $module;
    public int $numberOfButtons = 5;

    function __construct($module, $params)
    {
        $this->module = $module;
        $this->params = $params;
    }

    /**
     * @param Registry $params
     * @param int $numberOfButtons
     * @return array [QlquicklinkButton]
     */
    public function getButtonsByParams(Registry $params, int $numberOfButtons): array
    {
        $buttons = [];
        for ($i = 0; $i <= $numberOfButtons; $i++) {
            $buttons[] = $this->getButton($params, $i);
        }
        return array_filter($buttons);
    }

    public function getButton(Registry $params, int $i): ?QlquicklinkButton
    {
        $label = sprintf('button%s_label', $i);
        $label = $params->get($label, 'MOD_QLXXXXX_LABELDUMMIE_LABEL');

        $link = sprintf('button%s_link', $i);
        $link = $params->get($link, '');

        $fa = sprintf('button%s_fa', $i);
        $fa = $params->get($fa, '');

        if (empty($link)) return null;

        $image = sprintf('button%s_image', $i);
        $image = $params->get($image, '');

        return new QlquicklinkButton($label, $link, $fa, $image);
    }

    public function getNumberOfButtons(): int
    {
        return $this->numberOfButtons;
    }
}
