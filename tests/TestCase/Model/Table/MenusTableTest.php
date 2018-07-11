<?php
namespace MenuManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MenuManager\Model\Table\MenusTable;

/**
 * MenuManager\Model\Table\MenusTable Test Case
 */
class MenusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \MenuManager\Model\Table\MenusTable
     */
    public $Menus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.menu_manager.menus',
        'plugin.menu_manager.menu_links'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Menus') ? [] : ['className' => MenusTable::class];
        $this->Menus = TableRegistry::getTableLocator()->get('Menus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Menus);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->assertEquals('menus', $this->Menus->getTable(), __('Wrong table. Must use table menus.'));
        $this->assertEquals('title', $this->Menus->getDisplayField(), __('Wrong display field. Set it to "title".'));
        $this->assertEquals('id', $this->Menus->getPrimaryKey(), __('Wrong primary key. Expect "id", but got {0} instead.', $this->Menus->getPrimaryKey()));
    }
    
    /**
     * Test if Model Menus has Timestamp behavior
     * 
     * @param none
     * @return void.
     */
    public function testModelHasTimestampBehavior()
    {
        $this->assertTrue($this->Menus->hasBehavior('Timestamp'), __('Missing Timestamp behavior. Add it to model.'));
    }
    
    /**
     * Test if Model Menus is associated with MenuLinks model and association options.
     * 
     * @param none
     * @return void
     */
    public function testHasManyMenuLinksAssociation()
    {
        $this->assertTrue($this->Menus->hasAssociation('MenuLinks'), __('Missing Association to MenuLinks model.'));
        
        $association = $this->Menus->getAssociation('MenuLinks');
        
        $this->assertEquals(TRUE, $association->getDependent(), __('Dependent option for association is not set to TRUE.'));
        $this->assertEquals('INNER', $association->getJoinType());
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $validator = $this->Menus->getValidator();
        $fields = ['id', 'title', 'alias'];
        
        $this->assertEquals(count($fields), $validator->count(), __('Missing or additionl filds for validation.'));
    }
}
