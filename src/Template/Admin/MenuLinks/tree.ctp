<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $menuLinksGroupes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menu Links'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu Link'), ['action' => 'add']) ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menuLinks links-tree large-9 medium-8 columns content">
    <h3><?= __('Menu Links tree') ?></h3>
    <?php foreach($menuLinksGroups as $group => $menuLinks): ?>
        <h5><?= $group ?></h5>
        <div class="tree-wrapper">
            <?= $this->element('MenuLinks/tree_list', ['menuLinks' => $menuLinks]) ?>
        </div>
    <?php endforeach; ?>
</div>