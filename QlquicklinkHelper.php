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
    public int $width = 200;
    public int $numberOfButtons = 5;

    public function __construct($module, $params)
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

    public function getStyles(Registry $params): string
    {
        $liHeight = 50;
        $liMarginLeft = $this->width - $liHeight - 30;

        $style = '';
        $style .= sprintf('.qlquicklink {top:%spx;right:%spx;z-index:%s;}', $params->get('margin_top', 30), $params->get('margin_right', 0), $params->get('zindex', 5));
        $style .= sprintf('.qlquicklink ul {width:%spx;}', $params->get('width', $this->width));
        $style .= sprintf('.qlquicklink ul li {margin-bottom: %spx;width:%spx;margin-left:%spx;}', $params->get('margin_button_bottom', 30), $this->width, $liMarginLeft);
        $style .= sprintf('.qlquicklink ul li.link-visible {color: %s;background-color:%s;}', $params->get('strip_color', '#30a6dc'), $params->get('strip_background_color', '#ffffff'));
        $style .= sprintf('.qlquicklink ul li img {width:%spx;}', $params->get('image_width', 30));
        $style .= sprintf('.qlquicklink ul li i::before {font-size:%spx;color:%s;}', $params->get('icon_size', 30), $params->get('icon_color', '#ffffff'));
        $style .= sprintf('.qlquicklink ul li a.btn {background:%s;}', $params->get('icon_background_color', '#30a6dc'));
        $style .= sprintf('.qlquicklink ul li a.btn {background:%s;}', $params->get('icon_background_color', '#30a6dc'));
        $style .= sprintf('.qlquicklink ul li a.btn {background:%s;}', $params->get('icon_background_color', '#30a6dc'));

        return $style;
    }

    public function getButton(Registry $params, int $i): ?QlquicklinkButton
    {
        $label = sprintf('button%s_label', $i);
        $label = $params->get($label, 'MOD_QLQUICKLINK_LABELDUMMIE_LABEL');

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
