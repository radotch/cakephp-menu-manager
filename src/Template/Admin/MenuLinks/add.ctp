<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $menuLink
 * @var array $translationLocales
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('View Menu'), ['controller' => 'Menus', 'action' => 'view', $menuLink->menu_id]) ?></li>
    </ul>
</nav>
<div class="menuLinks form large-9 medium-8 columns content">
    <h3><?= __('Add Menu Link') ?></h3>
    <?= $this->Form->create($menuLink) ?>
    <fieldset>
        <legend><?= __('Menu Link data') ?></legend>
        <?php
        echo $this->Form->control('title', ['label' => __('Title')]);
        echo $this->Form->control('url', ['label' => __('Url')]);
        echo $this->Form->control('position', ['label' => __('Position'), 'step' => '1']);
        echo $this->Form->control('menu_id', ['options' => $menus, 'empty' => __('(Select menu)'), 'label' => __('Menu')]);
        echo $this->Form->control('parent_id', ['options' => $parentMenuLinks, 'empty' => __('(No parent link)'), 'label' => __('Parent')]);
        echo $this->Form->control('is_active', ['label' => __('Active')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
