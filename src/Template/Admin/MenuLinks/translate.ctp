<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $menuLink
 * @var array $languages
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
        <li><?= $this->Html->link(__('Back to Menu'), ['controller' => 'Menus', 'action' => 'view', $menuLink->menu_id]) ?> </li>
    </ul>
</nav>
<div class="menuLinks translate large-9 medium-8 columns content">
    <h3><?= __('Translate Menu Link') ?></h3>
    <p class="subheader lead"><?= __('Menu Link: {0}', $menuLink->title) ?></p>
    <hr />
    <?= $this->Form->create($menuLink, []) ?>
    <?= $this->Form->control('translation._locale', ['options' => $languages, 'label' => __('Language'), 'empty' => __('(Please select)'), 'required' => TRUE]) ?>
    <?= $this->Form->control('translation.title') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
