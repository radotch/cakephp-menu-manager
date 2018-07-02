<?php
use Migrations\AbstractSeed;

/**
 * MenuLink seed.
 */
class MenuLinkSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
//                'id' => '1',
                'title' => 'Home',
                'url' => '/home',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '1',
                'rght' => '2',
                'is_active' => '1',
                'created' => '2018-06-30 22:32:25',
                'modified' => '2018-07-02 13:24:13',
            ],
            [
//                'id' => '2',
                'title' => 'Services',
                'url' => '/services',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '3',
                'rght' => '10',
                'is_active' => '1',
                'created' => '2018-06-30 22:32:50',
                'modified' => '2018-06-30 22:32:50',
            ],
            [
//                'id' => '3',
                'title' => 'Blog',
                'url' => '/blog',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '11',
                'rght' => '12',
                'is_active' => '1',
                'created' => '2018-06-30 22:33:25',
                'modified' => '2018-06-30 22:33:25',
            ],
            [
//                'id' => '4',
                'title' => 'About',
                'url' => '/about',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '13',
                'rght' => '14',
                'is_active' => '1',
                'created' => '2018-06-30 22:33:52',
                'modified' => '2018-06-30 22:33:52',
            ],
            [
//                'id' => '5',
                'title' => 'Contact',
                'url' => '/contacts',
                'menu_id' => '1',
                'parent_id' => NULL,
                'lft' => '15',
                'rght' => '16',
                'is_active' => '1',
                'created' => '2018-06-30 22:34:26',
                'modified' => '2018-06-30 22:34:26',
            ],
        ];

        $table = $this->table('menu_links');
        $table->insert($data)->save();
    }
}
