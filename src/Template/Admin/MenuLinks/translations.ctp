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
        <li><?= $this->Html->link(__('View Menu Link'), ['action' => 'view', $menuLink->id]) ?></li>
        <li><?= $this->Form->postLink(__('Delete Menu Link'), ['action' => 'delete', $menuLink->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuLink->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menu Links'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu Link'), ['action' => 'add']) ?> </li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Parent Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Menu Link'), ['controller' => 'MenuLinks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Menu Link'), ['controller' => 'MenuLinks', 'action' => 'addTo', $menuLink->menu_id, $menuLink->id]) ?> </li>
    </ul>
</nav>
<div class="menuLinks view large-9 medium-8 columns content">
    <h3><?= __('Menu Link Translations') ?></h3>
    
    <div class="">
        <p class="subheader lead"><?= __('Menu Link') ?></p>
        <div>
            <?= $this->Html->link($menuLink->title, ['action' => 'view', $menuLink->id]) ?>
        </div>
    </div>
    <hr />
    <div class="related">
        <h4><?= __('Translations') ?></h4>
        <?php if (!empty($menuLink->_translations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Language') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menuLink->_translations as $locale => $translation): ?>
            <tr>
                <td><?= h($translation->locale) ?></td>
                <td><?= h($translation->title) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MenuLinks', 'action' => 'translationEdit', $menuLink->id, $locale]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
