<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $menuLinks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('New Menu Link'), ['action' => 'add']) ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menuLinks index large-9 medium-8 columns content">
    <h3><?= __('Menu Links') ?></h3>
    <div><?= $this->Html->link(__('View as Tree'), ['action' => 'tree'], ['class' => 'button small secondary']) ?></div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('menu_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menuLinks as $menuLink): ?>
            <tr>
                <td><?= h($menuLink->title) ?></td>
                <td><?= h($menuLink->url) ?></td>
                <td><?= $menuLink->has('parent_menu_link') ? $this->Html->link($menuLink->parent_menu_link->title, ['controller' => 'MenuLinks', 'action' => 'view', $menuLink->parent_menu_link->id]) : '' ?></td>
                <td><?= $menuLink->has('menu') ? $this->Html->link($menuLink->menu->title, ['controller' => 'Menus', 'action' => 'view', $menuLink->menu->id]) : '' ?></td>
                <td><?= h($menuLink->is_active) ?></td>
                <td><?= h($menuLink->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $menuLink->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuLink->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menuLink->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuLink->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
