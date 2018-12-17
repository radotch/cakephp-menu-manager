<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $menuLink
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('Edit Menu Link'), ['action' => 'edit', $menuLink->id]) ?></li>
        <li><?= $this->Html->link(__('Add Child Link'), ['action' => 'add', $menuLink->menu_id, $menuLink->id]) ?></li>
        <li><?= $this->Html->link(__('Translate Menu Link'), ['action' => 'translate', $menuLink->id]) ?></li>
        <li><?= $this->Form->postLink(__('Delete Menu Link'), ['action' => 'delete', $menuLink->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuLink->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parent Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Child Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Back to Menu'), ['controller' => 'Menus', 'action' => 'view', $menuLink->menu_id]) ?> </li>
    </ul>
</nav>
<div class="menuLinks view large-9 medium-8 columns content">
    <h3><?= __('Menu Link preview') ?></h3>
    
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($menuLink->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($menuLink->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Menu') ?></th>
            <td><?= $menuLink->has('menu') ? $this->Html->link($menuLink->menu->title, ['controller' => 'Menus', 'action' => 'view', $menuLink->menu->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Menu Link') ?></th>
            <td><?= $menuLink->has('parent_menu_link') ? $this->Html->link($menuLink->parent_menu_link->title, ['controller' => 'MenuLinks', 'action' => 'view', $menuLink->parent_menu_link->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($menuLink->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($menuLink->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($menuLink->rght) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($menuLink->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($menuLink->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $menuLink->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Menu Link Translations') ?></h4>
        <?php if (count($menuLink->_translations) > 0): ?>
        <table>
            <tr>
                <th><?= __('Language') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
            <tbody>
                <?php foreach ($menuLink->_translations as $locale => $translation): ?>
                <tr>
                    <td><?= Locale::getDisplayLanguage($language) ?></td>
                    <td><?= $translation->title ?></td>
                    <td><?= $this->Html->link(__('Edit', ['action' => 'editTranslation', $menuLink->id])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Menu Links') ?></h4>
        <p class="subheader" style="margin-top: -0.75rem; margin-bottom: 1.5rem;"><?= __('(Only direct children)')  ?></p>
        
        <?php if (!empty($menuLink->child_menu_links)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menuLink->child_menu_links as $childMenuLinks): ?>
            <tr>
                <td><?= h($childMenuLinks->title) ?></td>
                <td><?= h($childMenuLinks->url) ?></td>
                <td><?= h($childMenuLinks->is_active) ?></td>
                <td><?= h($childMenuLinks->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MenuLinks', 'action' => 'view', $childMenuLinks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MenuLinks', 'action' => 'edit', $childMenuLinks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MenuLinks', 'action' => 'delete', $childMenuLinks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childMenuLinks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
