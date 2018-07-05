<?php
namespace MenuManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MenuLinksFixture
 *
 */
class MenuLinksFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'title' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'url' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'menu_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'parent_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'lft' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rght' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'is_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
//                'id' => '1',
                'title' => 'Menu1-Link1',
                'url' => '/',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '1',
                'rght' => '2',
                'is_active' => '1',
                'created' => '2018-07-05 07:29:36',
                'modified' => '2018-07-05 07:29:36',
            ],
            [
//                'id' => '2',
                'title' => 'Menu1-Link2',
                'url' => '/',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '3',
                'rght' => '4',
                'is_active' => '1',
                'created' => '2018-07-05 07:29:59',
                'modified' => '2018-07-05 07:29:59',
            ],
            [
//                'id' => '3',
                'title' => 'Menu1-Link3',
                'url' => '/',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '5',
                'rght' => '6',
                'is_active' => '1',
                'created' => '2018-07-05 07:30:11',
                'modified' => '2018-07-05 07:30:11',
            ],
            [
//                'id' => '4',
                'title' => 'Menu1-Link4',
                'url' => '/',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '7',
                'rght' => '8',
                'is_active' => '1',
                'created' => '2018-07-05 07:30:21',
                'modified' => '2018-07-05 07:30:21',
            ],
            [
//                'id' => '5',
                'title' => 'Menu1-Link5',
                'url' => '/',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '9',
                'rght' => '10',
                'is_active' => '1',
                'created' => '2018-07-05 07:30:33',
                'modified' => '2018-07-05 07:30:54',
            ],
        ];
        parent::init();
    }
}
