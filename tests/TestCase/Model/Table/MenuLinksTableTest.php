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
        $this->assertEquals('menu_links', $this->MenuLinks->getTable(), __('Wrong table. Must use table menus.'));
        $this->assertEquals('title', $this->MenuLinks->getDisplayField(), __('Wrong display field. Set it to "title".'));
        $this->assertEquals('id', $this->MenuLinks->getPrimaryKey(), __('Wrong primary key. Expect "id", but got {0} instead.', $this->MenuLinks->getPrimaryKey()));
    }
    
    /**
     * Test the behaviors required from MenuLinks model.
     * 
     * @param none
     * @return void
     */
    public function testBehaviors()
    {
        $this->assertTrue($this->MenuLinks->hasBehavior('Timestamp'), __('The bavavior Timestamp is not attached to MenuLinks model.'));
        $this->assertTrue($this->MenuLinks->hasBehavior('Tree'), __('The bahavior Tree is not attached to MenuLinks model.'));
    }
    
    
    public function testAssociations()
    {
        $this->assertTrue($this->MenuLinks->hasAssociation('Menus'), __('Missing association with Menus model.'));
        $this->assertEquals('manyToOne', $this->MenuLinks->getAssociation('Menus')->type(), __('Wrong kind of association. Must set MenuLinks belongsTo Menus.'));
        
        $this->assertTrue($this->MenuLinks->hasAssociation('ParentMenuLinks'), __('Missing association with Menus model.'));
        $this->assertEquals('manyToOne', $this->MenuLinks->getAssociation('ParentMenuLinks')->type(), __('Wrong kind of association. Must set MenuLinks belongsTo ParentMenuLinks.'));
        
        $this->assertTrue($this->MenuLinks->hasAssociation('ChildMenuLinks'), __('Missing association with Menus model.'));
        $this->assertEquals('oneToMany', $this->MenuLinks->getAssociation('ChildMenuLinks')->type(), __('Wrong kind of association. Must set MenuLinks hasMany ChildMenuLinks.'));
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $validator = $this->MenuLinks->getValidator();
        $fields = ['id', 'title', 'url', 'is_active', 'menu_id'];
        
        $this->assertEquals(count($fields), $validator->count(), __('Missing or additionl fields for validation.'));
    }

    /**
     * Test buildRules method. Here set menu_id and parent_id fields with values
     * that already exist in associated tables.
     *
     * @return void
     */
    public function testBuildRules()
    {
        $data = [
            'title' => 'New Menu Link',
            'url' => '/',
            'menu_id' => 1,
            'parent_id' => 1,
            'is_active' => TRUE
        ];
        
        $entity = $this->MenuLinks->newEntity($data);
        $rulesCheck = $this->MenuLinks->checkRules($entity);
        
        $this->assertTrue($rulesCheck);
        
        $expected = [];
        
        $this->assertEquals($expected, $entity->getErrors());
    }

    /**
     * Test buildRules method. Here set menu_id and parent_id fields with values
     * that do not exist in associated tables.
     *
     * @return void
     */
    public function testBuildRulesWhenAssociatedRecordsDoNotExist()
    {
        $data = [
            'title' => 'New Menu Link',
            'url' => '/',
            'menu_id' => 999999999, // or NULL
            'parent_id' => 999999999, // or NULL
            'is_active' => TRUE
        ];
        
        $entity = $this->MenuLinks->newEntity($data);
        $rulesCheck = $this->MenuLinks->checkRules($entity);
        
        $this->assertFalse($rulesCheck);
        
        $expected = [
            'menu_id' => [
                    '_existsIn' => 'This value does not exist'
            ],
            'parent_id' => [
                    '_existsIn' => 'This value does not exist'
            ]
        ];
        
        $this->assertEquals($expected, $entity->getErrors());
    }
}
