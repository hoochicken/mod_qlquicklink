<?php
/**
 * @package		mod_qlquicklink
 * @copyright	Copyright (C) 2022 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
use Joomla\CMS\Factory;
// no direct access
defined('_JEXEC') or die;
/** @var stdClass $module */
/** @var \Joomla\Registry\Registry $params */
/** @var QlquicklinkHelper $qlquicklinkHelper */
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerStyle('qlquicklink', 'mod_qlquicklink/styles.css');
$wa->useStyle('qlquicklink');
?>

<div class="qlquicklink" id="module<?php echo $module->id ?>">
    asdasdasd
</div>