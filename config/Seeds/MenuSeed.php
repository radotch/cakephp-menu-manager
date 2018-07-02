<?php
use Migrations\AbstractSeed;

/**
 * Menu seed.
 */
class MenuSeed extends AbstractSeed
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
                'title' => 'Main menu',
                'alias' => 'main-menu',
                'created' => '2018-06-30 21:51:40',
                'modified' => '2018-06-30 21:51:40',
            ],
            [
//                'id' => '2',
                'title' => 'Top menu',
                'alias' => 'top-menu',
                'created' => '2018-06-30 21:51:56',
                'modified' => '2018-06-30 21:52:06',
            ],
            [
//                'id' => '3',
                'title' => 'Footer menu',
                'alias' => 'footer-menu',
                'created' => '2018-06-30 21:52:59',
                'modified' => '2018-06-30 21:54:00',
            ],
        ];

        $table = $this->table('menus');
        $table->insert($data)->save();
    }
}
