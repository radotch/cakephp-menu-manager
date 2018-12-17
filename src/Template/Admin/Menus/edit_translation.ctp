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
    </ul>
</nav>
<div class="menus form large-9 medium-8 columns content">
    <h3><?= __('Translate Menu') ?></h3>
    
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __('Menu') . ': ' . h($menu->title) ?></legend>
        <?php
            echo $this->Form->control('_locale', ['required' => TRUE, 'options' => $languages, 'label' => __('Language')]);
            echo $this->Form->control('title', ['label' => __('Title')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
