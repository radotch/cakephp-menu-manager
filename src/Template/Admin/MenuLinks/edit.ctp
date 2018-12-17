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
        <li>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $menuLink->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $menuLink->id)]
            )
            ?>
        </li>
        <li><?= $this->Html->link(__('View Menu Link'), ['action' => 'view', $menuLink->id]) ?></li>
        <li><?= $this->Html->link(__('List Parent Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Children Menu Links'), ['controller' => 'MenuLinks', 'action' => 'index']) ?></li>
        <li class="divider"></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Back to Menu'), ['controller' => 'Menus', 'action' => 'view', $menuLink->menu_id]) ?></li>
    </ul>
</nav>
<div class="menuLinks form large-9 medium-8 columns content">
    <h3><?= __('Edit Menu Link') ?></h3>
    <?= $this->Form->create($menuLink) ?>
    <fieldset>
        <legend><?= __('Menu Link') . ': ' . h($menuLink->title) ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('url');
            echo $this->Form->control('menu_id', ['options' => $menus]);
            echo $this->Form->control('parent_id', ['options' => $parentMenuLinks, 'empty' => __('(No parent link)')]);
            echo $this->Form->control('is_active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
