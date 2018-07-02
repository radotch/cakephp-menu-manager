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
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu Link'), ['controller' => 'MenuLinks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($menu->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alias') ?></th>
            <td><?= h($menu->alias) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($menu->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($menu->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Menu Links') ?></h4>
        <?php if (!empty($menu->menu_links)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Menu Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menu->menu_links as $menuLinks): ?>
            <tr>
                <td><?= h($menuLinks->id) ?></td>
                <td><?= h($menuLinks->title) ?></td>
                <td><?= h($menuLinks->url) ?></td>
                <td><?= h($menuLinks->menu_id) ?></td>
                <td><?= h($menuLinks->parent_id) ?></td>
                <td><?= h($menuLinks->lft) ?></td>
                <td><?= h($menuLinks->rght) ?></td>
                <td><?= h($menuLinks->is_active) ?></td>
                <td><?= h($menuLinks->created) ?></td>
                <td><?= h($menuLinks->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MenuLinks', 'action' => 'view', $menuLinks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MenuLinks', 'action' => 'edit', $menuLinks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MenuLinks', 'action' => 'delete', $menuLinks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuLinks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
