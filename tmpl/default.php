<?php
/**
 * @package        mod_qlquicklink
 * @copyright    Copyright (C) 2022 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Ql\Module\Qlquicklink\Site\php\classes\QlquicklinkButton;

// no direct access
defined('_JEXEC') or die;

/** @var array $buttons */
/** @var stdClass $module */
/** @var string $styles */
/** @var \Ql\Module\Qlquicklink\Site\php\classes\QlquicklinkButton $button */
/** @var \Joomla\Registry\Registry $params */
/** @var Ql\Module\Qlquicklink\Site\QlquicklinkHelper $qlquicklinkHelper */

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerAndUseScript('qlquicklink', 'mod_qlquicklink/script.js');
if ($params->get('styles_active', true)) {
    $wa->registerStyle('qlquicklink', 'mod_qlquicklink/styles.css');
    $wa->useStyle('qlquicklink');
    $wa->addInlineStyle($styles);
}
if ($params->get('jquery', false)) {
    HTMLHelper::_('jquery.framework');
}
?>
<div class="qlquicklink <?= $params->get('shape', 'round') === 'round' ? 'round' : 'rectangular' ?>" id="module<?php echo $module->id ?>">
    <ul>
        <?php foreach ($buttons as $button) : ?>
            <li>
                <a href="<?= $button->getLink() ?>" title="<?= $button->getLabel() ?>">
                    <span href="<?= $button->getLink() ?>" title="<?= $button->getLabel() ?>" type="button" class="btn btn-primary">
                        <?php if (!empty($button->getFa())): ?><i class="fa fa-<?= $button->getFa() ?>"></i><?php endif; ?>
                        <?php if (!empty($button->getImage())): ?>
                            <img src="<?= $button->getImage() ?>" alt="<?= Text::_('MOD_QLQUICKLINK_LINKTO') ?><?= $button->getLabel() ?>"/>
                        <?php endif; ?>
                        <?php if (empty($button->getFa()) && empty($button->getImage())): ?><?= $button->getLabel() ?><?php endif; ?>
                    </span>
                    <span title="<?= $button->getLabel() ?>" class="qlquicklink-label">
                        <?= $button->getLabel() ?>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
