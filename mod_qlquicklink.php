<?php
/**
 * @package		mod_qlquicklink
 * @copyright	Copyright (C) 2022 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ql\Module\Qlquicklink\Site;

// no direct access
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Ql\Module\Qlquicklink\Site\QlquicklinkHelper;

defined('_JEXEC') or die;
require_once dirname(__FILE__).'/QlquicklinkHelper.php';
require_once dirname(__FILE__).'/php/classes/QlquicklinkButton.php';

?>
<style>
    option::before {content:'asd'!important;}

</style>
<?php

/** @var $module  */
/** @var $params  */
$qlquicklinkHelper = new QlquicklinkHelper($module, $params);
$buttons = $qlquicklinkHelper->getButtonsByParams($params, $qlquicklinkHelper->getNumberOfButtons());
$styles = $qlquicklinkHelper->getStyles($params);

require ModuleHelper::getLayoutPath('mod_qlquicklink', $params->get('layout', 'default'));
