<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $menu
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('View Menu'), ['action' => 'view', $menu->id]) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu Link'), ['controller' => 'MenuLinks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menus form large-9 medium-8 columns content">
    <h3><?= __('Translate Menu') ?></h3>
    
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __('Menu') . ': ' . h($menu->title) ?></legend>
        <?php
            echo $this->Form->control('translation._locale', ['required' => TRUE, 'options' => $languages, 'empty' => __('(Select Language)')]);
            echo $this->Form->control('translation.title');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
