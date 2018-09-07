<?php
namespace MenuManager\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\Behavior\Translate\TranslateTrait;

/**
 * Menu Entity
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \MenuManager\Model\Entity\MenuLink[] $menu_links
 */
class Menu extends Entity
{
    use TranslateTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'alias' => true,
        'created' => true,
        'modified' => true,
        'menu_links' => true,
        '_translations' => true
    ];
}
