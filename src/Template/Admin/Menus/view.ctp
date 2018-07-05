<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $menu
 * @var string|NULL $relatedPreview How to preview related Menu Links - as List or Tree
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
        <li><?= $this->Html->link(__('Add Menu Link'), ['controller' => 'MenuLinks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= __('Menu preview') ?></h3>
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
        <div>
            <?php
            echo $this->Html->link(
                    __('Add Menu Link'),
                    ['controller' => 'MenuLinks', 'action' => 'addTo', $menu->id, NULL],
                    ['class' => 'button small secondary']
                );
            echo '&nbsp;';
            echo $relatedLinksPreview === 'list' ?
                    $this->Html->link(__('View as Tree'), ['action' => 'view', $menu->id, '?' => ['related_links_preview' => 'tree']], ['class' => 'button small warning']) :
                    $this->Html->link(__('View as List'), ['action' => 'view', $menu->id], ['class' => 'button small secondary']);
            ?>
        </div>
        <?php if (!empty($menu->menu_links)): ?>
            <?php if ($relatedLinksPreview === 'list'): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Title') ?></th>
                    <th scope="col"><?= __('Url') ?></th>
                    <th scope="col"><?= __('Parent Id') ?></th>
                    <th scope="col"><?= __('Is Active') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($menu->menu_links as $menuLinks): ?>
                <tr>
                    <td><?= h($menuLinks->title) ?></td>
                    <td><?= h($menuLinks->url) ?></td>
                    <td><?= $menuLinks->has('parent_menu_link') ?
                                $this->Html->link(h($menuLinks->parent_menu_link->title), ['controller' => 'MenuLinks', 'action' => 'view', $menuLinks->parent_menu_link->id]) :
                                h($menuLinks->parent_id) ?>
                    </td>
                    <td><?= h($menuLinks->is_active) ?></td>
                    <td><?= h($menuLinks->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'MenuLinks', 'action' => 'view', $menuLinks->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'MenuLinks', 'action' => 'edit', $menuLinks->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'MenuLinks', 'action' => 'delete', $menuLinks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuLinks->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php elseif ($relatedLinksPreview === 'tree'): ?>
                <div class="menu-links tree-preview">
                    <?= $this->element('MenuLinks/tree_list', ['menuLinks' => $menu->menu_links]) ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
