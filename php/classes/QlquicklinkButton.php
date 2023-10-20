<?php
/**
 * @package        mod_qlqlquicklink
 * @copyright    Copyright (C) 2023 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ql\Module\Qlquicklink\Site\php\classes;
// no direct access
use Joomla\Registry\Registry;
use stdClass;

defined('_JEXEC') or die;

class QlquicklinkButton
{
    private string $label;
    private string $link;
    private string $fa;
    private string $image;

    public function __construct(string $label, string $link, string $fa = '', string $image = '')
    {
        $this->label = $label;
        $this->link = $link;
        $this->fa = $fa;
        $this->image = $image;
    }

    public function getLabel(): string{
        return $this->label;
    }

    public function getLink(): string{
        return $this->link;
    }

    public function getFa(): string{
        return $this->fa;
    }

    public function getImage(): string{
        return $this->image;
    }
}
