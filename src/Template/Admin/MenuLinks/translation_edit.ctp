<?php
/**
 * 
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('View Menu Link'), ['action' => 'view', $menuLink->id]) ?></li>
        <li><?= $this->Html->link(__('Menu Link Translations'), ['action' => 'translations', $menuLink->id]) ?></li>
        <li><?= $this->Html->link(__('List Menu Links'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu Link'), ['action' => 'add']) ?> </li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Parent Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Menu Link'), ['controller' => 'MenuLinks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Menu Link'), ['controller' => 'MenuLinks', 'action' => 'addTo', $menuLink->menu_id, $menuLink->id]) ?> </li>
    </ul>
</nav>
<div class="menuLinks form translation-edit large-9 medium-8 columns content">
    <h3><?= __('Edit Menu Link Translation') ?></h3>
    <?= $this->Form->create($menuLink, []) ?>
    
    <fieldset>
        <legend><?= Locale::getDisplayLanguage($menuLink->_locale, TRUE) ?></legend>
        <?= $this->Form->control('menu_id', ['type' => 'hidden']) ?>
        <?= $this->Form->control('_translations.' . $locale . '.title', []) ?>
    </fieldset>
    
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
