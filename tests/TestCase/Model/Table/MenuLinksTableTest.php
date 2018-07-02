<?php
namespace MenuManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MenuManager\Model\Table\MenuLinksTable;

/**
 * MenuManager\Model\Table\MenuLinksTable Test Case
 */
class MenuLinksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \MenuManager\Model\Table\MenuLinksTable
     */
    public $MenuLinks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.menu_manager.menu_links',
        'plugin.menu_manager.menus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MenuLinks') ? [] : ['className' => MenuLinksTable::class];
        $this->MenuLinks = TableRegistry::getTableLocator()->get('MenuLinks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenuLinks);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
