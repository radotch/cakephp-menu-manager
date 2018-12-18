<?php
namespace MenuManager\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\Behavior\Translate\TranslateTrait;

/**
 * MenuLink Entity
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property int $menu_id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property bool $is_active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * 
 * @property array $_translations MenuLink Translations
 *
 * @property \MenuManager\Model\Entity\Menu $menu
 * @property \MenuManager\Model\Entity\ParentMenuLink $parent_menu_link
 * @property \MenuManager\Model\Entity\ChildMenuLink[] $child_menu_links
 */
class MenuLink extends Entity
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
        'url' => true,
        'menu_id' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true,
        'position' => true,
        'menu' => true,
        'parent_menu_link' => true,
        'child_menu_links' => true,
        '_translations' => true
    ];
}
