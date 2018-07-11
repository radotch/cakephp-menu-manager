<?php
namespace MenuManager\Test\TestCase\Controller\Admin;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Exception\MethodNotAllowedException;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\ResultSet;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\TestSuite\IntegrationTestCase;
use MenuManager\Model\Entity\Menu;
use MenuManager\Model\Table\MenusTable;

/**
 * MenuManager\Controller\Admin\MenusController Test Case.
 * Used records for all tests are defined in MenusFixtures.
 * 
 * @property MenusTable $Menus MenusTable Object
 */
class MenusControllerTest extends IntegrationTestCase
{

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
     * 
     */
    public function setUp() {
        parent::setUp();
        
        $this->Menus = TableRegistry::getTableLocator()->get('MenuManager.Menus');
    }
    
    /**
     * 
     */
    public function tearDown() {
        parent::tearDown();
        
        unset($this->Menus);
    }

    /**
     * Test index method that work properly and not redirect.
     * 
     * @param none
     * @return void
     */
    public function testAdminIndex()
    {
        $this->get('/admin/menu-manager/menus');
        
        $this->assertResponseOk();
        $this->assertNoRedirect(__('Method index does not have to redirect'));
    }
    
    /**
     * Test index method when query page. That means that query have to be paginated.
     * 
     * @param none
     * @return void
     */
    public function testAdminIndexQueryPage()
    {
        $this->get('/admin/menu-manager/menus?page=1');
        
        $this->assertResponseOk();
    }
    
    /**
     * Test index method when query wrong page. That means that query have to be paginated.
     * 
     * @param none
     * @return void
     */
    public function testAdminIndexQueryPageThatNotExists()
    {
        $this->disableErrorHandlerMiddleware();
        
        $this->expectException(NotFoundException::class);
        $this->get('/admin/menu-manager/menus?page=10000');
    }
    
    /**
     * Test view variable $menus is passed to the view and variable type.
     * Expected type is \Cake\ORM\ResultSet e.g query is paginated. 
     * 
     * @param none
     * @return void
     */
    public function testAdminIndexSetViewVariableMenus()
    {
        $this->get('/admin/menu-manager/menus');
        
        $menus = $this->viewVariable('menus');
        
        $this->assertNotNull($menus, __('May be variable $menus is not passed to the view in index method.'));
        $this->assertInstanceOf(ResultSet::class, $menus, __('Wrong $menus variable type. Got {0} instead {1}', gettype($menus), ResultSet::class));
        
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testAdminView()
    {
        $this->get('/admin/menu-manager/menus/view/1');
        
        $this->assertResponseOk();
        $this->assertNoRedirect(__('Method view does not have to redirect'));
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testAdminViewWhenRecordDoesNotExists()
    {
        $this->disableErrorHandlerMiddleware();
        
        $this->expectException(RecordNotFoundException::class);
        $this->get('/admin/menu-manager/menus/view/999999999');
        
    }
    
    /**
     * Test if method pass variable $menu to the view and its type.
     * 
     * @param none
     * @return void
     */
    public function testAdminViewSetViewVariableMenu()
    {
        $this->get('/admin/menu-manager/menus/view/1');
        
        $menuVariable = $this->viewVariable('menu');
        
        $this->assertNotNull($menuVariable, __('May be variable $menu is not passed to the view in view method.'));
        $this->assertInstanceOf(Menu::class, $menuVariable, __('Wrong $menu variable type. Got {0} instead {1}', gettype($menuVariable), Menu::class));
    }
    
    /**
     * Test if method pass variable $relatedLinksPreview to the view and its type.
     * 
     * @param none
     * @return void
     */
    public function testAdminViewSetViewVariableRelatedLinksPreview()
    {
        $this->get('/admin/menu-manager/menus/view/1');
        
        $relatedLinksPreview = $this->viewVariable('relatedLinksPreview');
        
        $this->assertNotNull($relatedLinksPreview, __('May be variable $relatedLinksPreview is not passed to the view in view method.'));
        $this->assertInternalType('string', $relatedLinksPreview, __('Variable $relatedLinksPreview must be of type string, but is {0} instead', gettype($relatedLinksPreview)));
    }
    
    /**
     * Test default value of variable $relatedLinksPreview.
     * 
     * @param none
     * @return void
     */
    public function testAdminViewValueOfViewVariableRelatedLinksPreviewWithoutQueryData()
    {
        $this->get('/admin/menu-manager/menus/view/1');
        
        $relatedLinksPreview = $this->viewVariable('relatedLinksPreview');
        
        $this->assertEquals('list', $relatedLinksPreview, __('Default value for $relatedLinksPreview variable have to be "list".'));
    }
    
    /**
     * Test value of variable $relatedLinksPreview when query data is 'tree'.
     * 
     * @param none
     * @return void
     */
    public function testAdminViewValueOfViewVariableRelatedLinksPreviewWhenQueryDataIsTree()
    {
        $this->get('/admin/menu-manager/menus/view/1?related_links_preview=tree');
        
        $relatedLinksPreview = $this->viewVariable('relatedLinksPreview');
        
        $this->assertEquals('tree', $relatedLinksPreview, __('Value for $relatedLinksPreview variable must be tree when query data is "tree", but is "{0}" instead.', $relatedLinksPreview));
    }
    
    /**
     * Test value of variable $relatedLinksPreview when query data is not 'tree'.
     * Have to be 'list' again.
     * 
     * @param none
     * @return void
     */
    public function testAdminViewValueOfViewVariableRelatedLinksPreviewWhenQueryDataIsNotTree()
    {
        $this->get('/admin/menu-manager/menus/view/1?related_links_preview=somthing-elese');
        
        $relatedLinksPreview = $this->viewVariable('relatedLinksPreview');
        
        $this->assertEquals('list', $relatedLinksPreview, __('Value for $relatedLinksPreview variable must be "list" when query data is not "tree", but is "{0}" instead.', $relatedLinksPreview));
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdminAdd()
    {
        $this->get('/admin/menu-manager/menus/add');
        
        $this->assertResponseOk();
        $this->assertNoRedirect(__('Method add does not have to redirect on GET request.'));
    }
    
    /**
     * Test if add method pass $menu variable to the view and its type.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddSetViewVariableMenu()
    {
        $this->get('/admin/menu-manager/menus/add');
        
        $menu = $this->viewVariable('menu');
        
        $this->assertNotNull($menu, __('May be variable $menu is not passed to add view'));
        $this->assertInstanceOf(Menu::class, $menu, __('Variable $menu must be of {0} type, got (1) instaed', Menu::class, gettype($menu)));
    }
    
    /**
     * Test Add Method when add new valid data
     * 
     * @param none
     * @return void
     */
    public function testAdminAddPost()
    {
        $data = [
            'title' => 'New menu that not exists',
            'alias' => 'new-menu-that-not-exists'
        ];
        
        $this->post('/admin/menu-manager/menus/add', $data);
        
        $this->assertResponseSuccess();
        $this->assertRedirect(NULL, __('After entity save, method must redirect.'));
        $this->assertRedirect(['action' => 'index'], __('Wrong redirect url. Must redirect to {0}, but redirect to {1}.', Router::url(['action' => 'index']), Router::url()));
        
        $this->assertTrue($this->Menus->exists(['title' => $data['title']]), __('Something get wrong. Record with tested valid data is mising in table.'));
    }
    
    /**
     * Test Add method when recorded data is invalid. Must not to redirect and save data.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddPostWhenValidationFailed()
    {
        $data = [
            'title' => '',
            'alias' => 'new-menu-that-not-exists'
        ];
        
        $this->post('/admin/menu-manager/menus/add', $data);
        
        $menu = $this->viewVariable('menu');
        $invalidFiels = $menu->getInvalid();
        
        $this->assertArrayHasKey('title', $invalidFiels);
        $this->assertNoRedirect(__('Method must not redirect when validation faild.'));
        $this->assertFalse($this->Menus->exists(['alias' => $data['alias']]), __('Somethig get wrong. Record must not present in table when data validation failed.'));
    }
    
    /**
     * Test add method to save data that already exists.
     */
    public function testAdminAddPostWhenRecordAlreadyExixsts()
    {
        // Data is also in fixtures
        $data = [
            'title' => 'Menu 1',
            'alias' => 'menu-1'
        ];
        
        $this->post('/admin/menu-manager/menus/add', $data);
        $this->assertNoRedirect();
        
        // If by some reason method redirect when validation failed next will failed
        $menu = $this->viewVariable('menu');
        $this->assertArrayHasKey('title', $menu->getErrors(), __('Title field is passed as valid, but it already exists.'));
        $this->assertArrayHasKey('alias', $menu->getErrors(), __('Alias field is passed as valid, but it already exists.'));
    }

    /**
     * Test edit method
     *
     * @param none
     * @return void
     */
    public function testAdminEdit()
    {
        $this->get('/admin/menu-manager/menus/edit/1');
        
        $this->assertResponseOk();
        $this->assertNoRedirect(__('Something get wrong. The method edit does not must to redirect on GET request.'));
    }
    
    /**
     * Test if edit method set view variable $menu and variable type.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditSetViewVariableMenu()
    {
        $this->get('/admin/menu-manager/menus/edit/1');
        
        $menu = $this->viewVariable('menu');
        
        $this->assertNotNull($menu, __('May be variable $menu is not passed to the view in edit method.'));
        $this->assertInstanceOf(Menu::class, $menu, __('Wrong $menu variable type. Got {0} instead {1}', gettype($menu), Menu::class));
    }
    
    /**
     * Test edit method is access to alias property disabled
     * 
     * @param mone
     * @return void
     */
    public function testAdminEditDisableAccessToAliasProperty()
    {
        $this->get('/admin/menu-manager/menus/edit/1');
        
        $menu = $this->viewVariable('menu');
        
        $this->assertFalse($menu->isAccessible('alias'), __('Access to alias property is not disabled.'));
    }
    
    /**
     * Test edit method when try to get record that not exists
     * 
     * @param none
     * @return void
     */
    public function testAdminEditWhenGetRecordThatDoesNotExists()
    {
        $this->disableErrorHandlerMiddleware();
        
        $this->expectException(\Exception::class);
        
        $this->get('/admin/menu-manager/menus/edit/99999999');
    }
    
    /**
     * Test edit method when edit record with valid data. Requested data present in fixtures.
     * Title must be changed, but alias does not.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditPostWithValidData()
    {
        $data = [
            'title' => 'Menu-1-new',
            'alias' => 'menu-1-new'
        ];
        // Record present in fixtures
        $this->post('/admin/menu-manager/menus/edit/1', $data);
        
        $this->assertRedirect();
        
        $menu = $this->Menus->find()->where(['title' => $data['title']])->first();
        // Title is updated
        $this->assertEquals($menu->title, $data['title'], __('Title property is not updated.'));
        // Alias update is disabled (access to property).
        $this->assertNotEquals($menu->alias, $data['alias'], __('Alias property is updated, but is must be disabled.'));
        
    }
    
    /**
     * Test edit method with invalid data. The record is defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditPostWithInvalidData()
    {
        $data = [
            'title' => []
        ];
        
        
        $this->post('/admin/menu-manager/menus/edit/1', $data);
        
        $menu = $this->viewVariable('menu');
        
        $this->assertNoRedirect();
        $this->assertArrayHasKey('title', $menu->getErrors());
    }
    
    /**
     * Test edit method with data that exists in other record. It mustn't to be saved.
     * The records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditPostWithDataThatExistsInOtherRecord()
    {
        $existing = $this->Menus->get(2);
        $data = [
            'title' => $existing->title,
            'alias' => $existing->alias
        ];
        
        $this->post('/admin/menu-manager/menus/edit/1', $data);
        
        $menu = $this->viewVariable('menu');
        $errors = $menu->getErrors();
        
        $this->assertNoRedirect();
        $this->assertArrayHasKey('title', $errors, __('Method must not save data when exists in other record.'));
    }

    /**
     * Test delete method will not delete record with GET request and will redirect.
     * The record is defined in Fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminDelete()
    {
        $menuId = 1;
        // Ensure that record exists
        $this->assertTrue($this->Menus->exists(['id' => $menuId]), __('The record for test is missing.'));
        
        $this->disableErrorHandlerMiddleware();
        
        $this->expectException(MethodNotAllowedException::class);
        $this->expectExceptionMessage('Method Not Allowed');
        $this->get('/admin/menu-manager/menus/delete/' . $menuId);
        
        $this->assertResponseCode(405, __('Request method is not allowed, but it is passed.'));
        
        $this->assertTrue($this->Menus->exists(['id' => $menuId]), __('The method must not delete record on GET request, but record is missing.'));
    }
    
    /**
     * Test delete method. The record is defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminDeletePost()
    {
        $menuId = 1;
        // Ensure that record exists.
        $this->assertTrue($this->Menus->exists(['id' => $menuId]), __('The record does not exists in table.'));
        
        $this->post('/admin/menu-manager/menus/delete/' . $menuId);
        
        $this->assertFalse($this->Menus->exists(['id' => $menuId]), __('Something get wrong. The record still exists in table.'));
    }

    /**
     * Test delete method that associated Menu Links will be deleted too 
     * when delete Menu. The records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminDeletePostAssociatedMenuLinksAreDeletedToo()
    {
        $menuId = 1;
        // Ensure that record exists.
        $this->assertTrue($this->Menus->exists(['id' => $menuId]), __('The record does not exists in table.'));
        // Ensure that there are associated Menu Links
        $this->assertGreaterThan(0, $this->Menus->MenuLinks->find()->where(['MenuLinks.menu_id' => $menuId])->count(), __('Missing associated Menu Links to Menu.'));
        
        $this->post('/admin/menu-manager/menus/delete/' . $menuId);
        
        // Actual assertion of the test
        $this->assertEquals(0, $this->Menus->MenuLinks->find()->where(['MenuLinks.menu_id' => $menuId])->count(), __('Associated Menu Links are not deleted when remove Menu.'));
    }
    
    /**
     * Test delete method when record does not exists.
     * 
     * @param none
     * @return void
     */
    public function testAdminDeletePostWhenRecordDoesNotExists()
    {
        $menuId = 999999999;
        
        $this->disableErrorHandlerMiddleware();
        // Ensure that record does not exists
        $this->assertFalse($this->Menus->exists(['id' => $menuId]), __('The record does not have to exists, but present in table.'));
        $this->expectException(RecordNotFoundException::class);
        
        $this->post('/admin/menu-manager/menus/delete/' . $menuId);
    }
}
