<?php
/**
 * @package		mod_qlquicklink
 * @copyright	Copyright (C) 2022 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ql\Module\Qlquicklink\Site;

// no direct access
use Joomla\CMS\Helper\ModuleHelper;
use Ql\Module\Qlquicklink\Site\QlquicklinkHelper;

defined('_JEXEC') or die;
require_once dirname(__FILE__).'/QlquicklinkHelper.php';

/** @var $module  */
/** @var $params  */
$qlquicklinkHelper = new QlquicklinkHelper($module, $params);

require ModuleHelper::getLayoutPath('mod_qlquicklink', $params->get('layout', 'default'));
