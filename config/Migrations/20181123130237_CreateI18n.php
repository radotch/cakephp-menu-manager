<?php
use Migrations\AbstractMigration;

class CreateI18n extends AbstractMigration
{
    /**
     * Change Method.
     * Check if table exists. If NOT call method which create it.
     * Check is necessary because the table may have already been created by 
     * another module.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('i18n');
        
        if (! $table->exists()) {
            $this->_createTable($table);
        }
        
    }
    
    /**
     * Create table with defined columns.
     * 
     * @param Migrations\Table $table
     * @return void
     */
    protected function _createTable(Migrations\Table $table)
    {
        $table->addColumn('locale', 'string', [
            'default' => null,
            'limit' => 9,
            'null' => false,
        ]);
        $table->addColumn('model', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('foreign_key', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('field', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('content', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
