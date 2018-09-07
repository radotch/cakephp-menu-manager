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
        <li><?= $this->Html->link(__('List Menu Links'), ['action' => 'index']) ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Parent Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Menu Link'), ['controller' => 'MenuLinks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menuLinks form large-9 medium-8 columns content">
    <h3><?= __('Add Menu Link') ?></h3>
    <?= $this->Form->create($menuLink) ?>
    <fieldset>
        <legend><?= __('Menu Link data') ?></legend>
        <?php
        echo $this->Form->control('title');
        echo $this->Form->control('url');
        echo $this->Form->control('menu_id', ['options' => $menus, 'empty' => __('(Select menu)')]);
        echo $this->Form->control('parent_id', ['options' => $parentMenuLinks, 'empty' => __('(No parent link)')]);
        echo $this->Form->control('is_active');
        ?>
    </fieldset>

    <?php if (!empty($translationLocales)): ?>
    <h4><?= __('Menu Link Translations') ?></h4>
        <?php foreach ($translationLocales as $locale): ?>
            <fieldset>
                <legend><?= Locale::getDisplayName($locale) ?></legend>
                    <?= $this->Form->control('_translations.' . $locale . '.title', [
                        'required' => false,
                        'label' => __('Title')
                    ]) ?>
            </fieldset>
        <?php endforeach; ?>
    <?php endif; ?>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
