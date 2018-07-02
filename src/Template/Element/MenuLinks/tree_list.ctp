<?php
/**
 * 
 * 
 * @var $menuLinks
 */
?>
<ul>
    <?php foreach($menuLinks as $link): ?>
    <li>
       <?php
       echo $this->Html->link(h($link->title), ['controller' => 'MenuLinks', 'action' => 'view', $link->id], []);
       if($link->has('children') && !empty($link->children)) {
           echo $this->element('MenuLinks/tree_list', ['menuLinks' => $link->children]);
       }
       ?>
    </li>
    <?php endforeach; ?>
</ul>
