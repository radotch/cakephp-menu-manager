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
        ];

        $table = $this->table('menus');
        $table->insert($data)->save();
    }
}
