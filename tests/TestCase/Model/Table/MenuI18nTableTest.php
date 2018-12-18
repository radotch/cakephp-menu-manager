<?php
namespace MenuManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MenuManager\Model\Table\MenuI18nTable;

/**
 * MenuManager\Model\Table\MenuI18nTable Test Case
 */
class MenuI18nTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \MenuManager\Model\Table\MenuI18nTable
     */
    public $MenuI18n;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.menu_manager.menu_i18n'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MenuI18n') ? [] : ['className' => MenuI18nTable::class];
        $this->MenuI18n = TableRegistry::getTableLocator()->get('MenuI18n', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenuI18n);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
