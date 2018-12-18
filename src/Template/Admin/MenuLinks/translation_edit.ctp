<?php
/**
 * 
 * @var Cake\View\View $this
 * @var MenuManager\Model\Entity\MenuLink $menuLink
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('View Menu Link'), ['action' => 'view', $menuLink->id]) ?></li>
        <li><?= $this->Html->link(__('List Parent Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Child Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('View Menu'), ['controller' => 'Menus', 'action' => 'view', $menuLink->menu_id]) ?> </li>
    </ul>
</nav>
<div class="menuLinks form translation-edit large-9 medium-8 columns content">
    <h3><?= __('Edit Menu Link Translation') ?></h3>
    <?= $this->Form->create($menuLink, []) ?>
    
    <fieldset>
        <legend><?= __('Menu Link: {0}', $menuLink->title) ?></legend>
        <?= $this->Form->control('menu_id', ['type' => 'hidden']) ?>
        <?= $this->Form->control('_translations.' . $locale . '.title', []) ?>
    </fieldset>
    
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
