<?php
namespace MenuManager\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;
use MenuManager\Controller\Admin\MenuLinksController;
use Cake\ORM\TableRegistry;

/**
 * MenuManager\Controller\Admin\MenuLinksController Test Case
 * 
 * @property \MenuManager\Model\Table\MenuLinksTable $MenuLinks 
 */
class MenuLinksControllerTest extends IntegrationTestCase
{
    /**
     * 
     */
    public function setUp() {
        parent::setUp();
        
        $this->MenuLinks = TableRegistry::getTableLocator()->get('MenuManager.MenuLinks');
    }
    
    /**
     * 
     */
    public function tearDown() {
        parent::tearDown();
        
        unset($this->MenuLinks);
    }
    
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
     * Test index method
     *
     * @return void
     */
    public function testAdminIndex()
    {
        $this->get('/admin/menu-manager/menu-links');
        
        $this->assertResponseOk();
    }

    /**
     * Test index method no redirect
     *
     * @return void
     */
    public function testAdminIndexNoRedirect()
    {
        $this->get('/admin/menu-manager/menu-links');
        
        $this->assertNoRedirect();
    }
    
    /**
     * Test index method is set $menuLinks variable (to the view).
     * 
     * @param none
     * @return void
     */
    public function testAdminIndexSetViewVariableMenuLinks()
    {
        $this->get('/admin/menu-manager/menu-links');
        
        $menuLinks = $this->viewVariable('menuLinks');
        
        $this->assertNotNull($menuLinks, __('$menuLinks variable is not set in yndex method.'));
    }
    
    /**
     * Test index method view variable $menuLinks type.
     * 
     * @param none
     * @return void
     */
    public function testAdminIndexTypeOfViewVariableMenuLinks()
    {
        $this->get('/admin/menu-manager/menu-links');
        
        $menuLinks = $this->viewVariable('menuLinks');
        
        $this->assertInstanceOf(\Cake\ORM\ResultSet::class, $menuLinks);
    }

    /**
     * Test view method. The record that get is defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminView()
    {
        $this->get('/admin/menu-manager/menu-links/view/1');
        
        $this->assertResponseOk();
    }

    /**
     * Test view method. The record is not defined in fixtures and must not present in table.
     * 
     * @param none
     * @return void
     */
    public function testAdminViewWithRecordThatNotExists()
    {
        $menuLinkId = 99999999;
        
        $this->disableErrorHandlerMiddleware();
        // Ensure that record does not exists
        $this->assertFalse($this->MenuLinks->exists(['id' => $menuLinkId]));
        
        $this->expectException(\Cake\Datasource\Exception\RecordNotFoundException::class);
        $this->get('/admin/menu-manager/menu-links/view/99999999');
    }
    
    /**
     * Test view method set variable $menuLinks to the view.
     * The record that find is defined in fixtures.
     * 
     * @param none
     * @return \MenuManager\Model\Entity\MenuLink
     */
    public function testAdminViewSetViewVariableMenuLink()
    {
        $menuLinkId = 1;
        $this->get('/admin/menu-manager/menu-links/view/' . $menuLinkId);
        
        $menuLink = $this->viewVariable('menuLink');
        $this->assertNotNull($menuLink, __('Variable $menuLink is not set to the view.'));
        
        return $menuLink;
    }
    
    /**
     * Test view method type of view variable $menuLink
     * 
     * @depends testAdminViewSetViewVariableMenuLink
     * @param \MenuManager\Model\Entity\MenuLink $menu
     * @return void
     */
    public function testAdminViewTypeOfViewVariableMenuLink($menuLink)
    {
        $this->assertInstanceOf(\MenuManager\Model\Entity\MenuLink::class, $menuLink);
    }

    /**
     * Test add method on GET request
     *  
     * @param none
     * @return void
     */
    public function testAdminAdd()
    {
        $this->get('/admin/menu-manager/menu-links/add');
        
        $this->assertResponseOk();
    }
    
    /**
     * Test add method on GET request no redirect.
     *  
     * @param none
     * @return void
     */
    public function testAdminAddNoRedirect()
    {
        $this->get('/admin/menu-manager/menu-links/add');
        
        $this->assertNoRedirect(__('Add menthod must not redirect on GET reuest.'));
    }

    /**
     * Test add method set view variable $menuLink
     *  
     * @param none
     * @return void
     */
    public function testAdminAddSetViewVariableMenuLink()
    {
        $this->get('/admin/menu-manager/menu-links/add');
        
        $menuLink = $this->viewVariable('menuLink');
        
        $this->assertNotNull($menuLink, __('$menuLink variable is not set to the view in add method.'));
    }

    /**
     * Test add method type of view variable $menuLink
     *  
     * @param none
     * @return void
     */
    public function testAdminAddTypeOfViewVariableMenuLink()
    {
        $this->get('/admin/menu-manager/menu-links/add');
        
        $menuLink = $this->viewVariable('menuLink');
        
        $this->assertInstanceOf(\MenuManager\Model\Entity\MenuLink::class, $menuLink);
    }

    /**
     * Test add method set view variable $menus
     *  
     * @param none
     * @return void
     */
    public function testAdminAddSetViewVariableMenus()
    {
        $this->get('/admin/menu-manager/menu-links/add');
        
        $menus = $this->viewVariable('menus');
        
        $this->assertNotNull($menus, __('$menus variable is not set to the view in add method.'));
    }

    /**
     * Test add method type of view variable $menus
     *  
     * @param none
     * @return void
     */
    public function testAdminAddTypeOfViewVariableMenus()
    {
        $this->get('/admin/menu-manager/menu-links/add');
        
        $menus = $this->viewVariable('menus');
        
        $this->assertInstanceOf(\Cake\ORM\Query::class, $menus);
    }

    /**
     * Test add method set view variable $parent_menu_links
     *  
     * @param none
     * @return void
     */
    public function testAdminAddSetViewVariableParentMenuLinks()
    {
        $this->get('/admin/menu-manager/menu-links/add');
        
        $parentMenuLinks = $this->viewVariable('parentMenuLinks');
        
        $this->assertNotNull($parentMenuLinks, __('$parentMenuLinks variable is not set to the view in add method.'));
    }

    /**
     * Test add method type of view variable $parentMenuLinks
     *  
     * @param none
     * @return void
     */
    public function testAdminAddTypeOfViewVariableParentMenuLinks()
    {
        $this->get('/admin/menu-manager/menu-links/add');
        
        $parentMenuLinks = $this->viewVariable('parentMenuLinks');
        
        $this->assertInstanceOf(\Cake\ORM\Query::class, $parentMenuLinks);
    }

    /**
     * Test add method on POST request and valid data. Menu's record used to 
     * set 'menu_id' property is defined in fixtures.
     *  
     * @param none
     * @return void
     */
    public function testAdminAddPost()
    {
        $data = [
            'title' => 'NewLink',
            'url' => '/',
            'menu_id' => 1,
            'parent_id' => NULL,
            'is_active' => 1
        ];
        
        $this->post('/admin/menu-manager/menu-links/add', $data);
        
        $this->assertResponseSuccess();
        //Ensure that new record exists
        $this->assertTrue($this->MenuLinks->exists(['title' => $data['title']]), __('Method finished with success but record is not present in DB.'));
        
        return $data;
    }
    
    /**
     * Test add method redirect after save data successfully.
     * 
     * @depends testAdminAddPost
     * @param none
     * @return void
     */
    public function testAdminAddPostRedirectWhenSaveData(array $data)
    {
        $this->post('/admin/menu-manager/menu-links/add', $data);
        
        $this->assertRedirect();
    }

    /**
     * Test add method on POST request and invalid data.
     *  
     * @param none
     * @return void
     */
    public function testAdminAddPostWithInvalidDataNoRedirect()
    {
        // Invalid fields are url and menu_id
        $data = [
            'title' => 'WrongLink',
            'url' => NULL,
            'menu_id' => NULL,
            'parent_id' => NULL,
            'is_active' => 1
        ];
        
        $this->post('/admin/menu-manager/menu-links/add', $data);
        
        $this->assertNoRedirect();
        // Ensure that record with invalid data does not exists in DB table.
        $this->assertFalse($this->MenuLinks->exists(['title' => $data['title']]), __('Method must not to save invalid data, but data presents in table.'));
    }

    /**
     * Test edit method. The record for this test is defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEdit()
    {
        $menuLinkId = 1;
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
        
        $this->assertResponseOk();
    }
    
    /**
     * Test edit method no redirect on GET request. The record for this test 
     * is defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditNoRedirect()
    {
        $menuLinkId = 1;
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
        
        $this->assertNoRedirect(__('On GET request, method must not redirect.'));
    }
    
    /**
     * Test edit method when try to get record that does not exists.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditWhenGetRecordThatDoesNotExists()
    {
        $this->disableErrorHandlerMiddleware();
        
        $this->expectException(\Cake\Datasource\Exception\RecordNotFoundException::class);
        
        $menuLinkId = 99999999;
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
    }
    
    /**
     * Test edit method set view variable $menuLink. The record for this test is
     * defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditSetViewVariableMenuLink()
    {
        $menuLinkId = 1;
        
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
        
        $menuLink = $this->viewVariable('menuLink');
        
        $this->assertNotNull($menuLink, __('May be $menuLink is not set to the template edit'));
    }
    
    /**
     * Test edit method view variable $menuLink type. The record for this test is
     * defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditTypeOfViewVariableMenuLink()
    {
        $menuLinkId = 1;
        
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
        
        $menuLink = $this->viewVariable('menuLink');
        
        $this->assertInstanceOf(\MenuManager\Model\Entity\MenuLink::class, $menuLink);
    }
    
    /**
     * Test edit method - set view variable $menus. The record for this test is
     * defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditSetViewVariableMenus()
    {
        $menuLinkId = 1;
        
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
        
        $menus = $this->viewVariable('menus');
        
        $this->assertNotNull($menus, __('May be $menus is not set to the template edit'));
    }
    
    /**
     * Test edit method - view variable $menus type. The record for this test is
     * defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditTypeOfViewVariableMenus()
    {
        $menuLinkId = 1;
        
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
        
        $menus = $this->viewVariable('menus');
        
        $this->assertInstanceOf(\Cake\ORM\Query::class, $menus);
        
    }

    /**
     * Test edit method - set view variable $parentMenuLinks. The record for this test
     * is defined in fixtures.
     *
     * @param none
     * @return void
     */
    public function testAdminEditSetViewVariableParentMenuLinks()
    {
        $menuLinkId = 1;
        
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
        
        $parentMenuLinks = $this->viewVariable('parentMenuLinks');
        
        $this->assertNotNull($parentMenuLinks, __('May be variable $parentmenuLinks is not set to the template in edit metod.'));
    }
    
    /**
     * Test edit method - type of $parentMenuLinks view variable. The record for 
     * this test is defined in fixtures.
     *
     * @return void
     */
    public function testAdminEditTypeOfViewVariableParentMenuLinks()
    {
        $menuLinkId = 1;
        
        $this->get('/admin/menu-manager/menu-links/edit/' . $menuLinkId);
        
        $parentMenuLinks = $this->viewVariable('parentMenuLinks');
        
        $this->assertInstanceOf(\Cake\ORM\Query::class, $parentMenuLinks);
    }
    
    /**
     * Test edit method when POST request and valid data.
     * 
     * The record for this test is defined in fixtures. And also menu record used
     * for menu_id property.
     * 
     * @param none
     * @return array
     */
    public function testAdminEditPost()
    {
        $menuLinkId = 1;
        $data = [
            'title' => 'New Menu link Title',
            'url' => '/path/to/new/target',
            'menu_id' => 1,
            'parent_id' => NULL,
            'is_active' => TRUE
        ];
        
        $this->post('/admin/menu-manager/menu-links/edit/' . $menuLinkId, $data);
        
        $this->assertResponseSuccess();
        
        return $data;
    }
    
    /**
     * Test edit method redirect when successfully update record.
     * 
     * The record for this test is defined in fixtures. And also menu record used
     * for menu_id property.
     *
     * @depends testAdminEditPost
     * @param array $data
     * @return void
     */
    public function testAdminEditPostRedirectWhenDataIsSavedSuccessfully(array $data)
    {
        $menuLinkId = 1;
        $this->post('/admin/menu-manager/menu-links/edit/' . $menuLinkId, $data);
        
        $this->assertRedirect();
    }
    
    /**
     * Test edit method no redirect when saving updated data failed. To achieve
     * that, passed data is invalid.
     * 
     * The record for this test is defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminEditPostNoRedirectWhenDataSaveFiled()
    {
        $menuLinkId = 1;
        $data = [
            'title' => NULL,
            'url' => NULL,
            'menu_id' => NULL
        ];
        
        $this->post('/admin/menu-manager/menu-links/edit/' . $menuLinkId, $data);
        
        $this->assertNoRedirect();
    }
    
    /**
     * Test delete method. The record for this test is defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminDelete()
    {
        $menuLinkId = 1;
        
        $this->post('/admin/menu-manager/menu-links/delete/' . $menuLinkId);
        
        $this->assertResponseSuccess();
    }
    
    /**
     * Test delete method redirect on success. The record for this test is 
     * defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminDeleteRedirect()
    {
        $menuLinkId = 1;
        
        $this->post('/admin/menu-manager/menu-links/delete/' . $menuLinkId);
        
        $this->assertRedirect();
    }
    
    /**
     * Test delete method when get record that not exists
     *
     * @return void
     */
    public function testAdminDeleteRecordThatNotExists()
    {
        $this->disableErrorHandlerMiddleware();
        
        $menuLinkId = 99999999;
        
        $this->expectException(\Cake\Datasource\Exception\RecordNotFoundException::class);
        $this->post('/admin/menu-manager/menu-links/delete/' . $menuLinkId);
    }
    
    /**
     * Test addTo method. 
     * 
     * Menu and MenuLink records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddTo()
    {
        $menuId = 1;
        $menuLinkId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $menuLinkId);
        
        $this->assertResponseOk();
    }
    
    /**
     * Test addTo method set $menuLink view variable.
     * 
     * Menu and MenuLink records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToSetViewVariableMenuLink()
    {
        $menuId = 1;
        $menuLinkId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $menuLinkId);
        
        $menuLink = $this->viewVariable('menuLink');
        
        $this->assertNotNull($menuLink, __('May be the view variable $menuLink is not set in addTo method.'));
    }
    
    /**
     * Test addTo method type of $menuLink view variable.
     * 
     * Menu and MenuLink records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToTypeOfViewVariableMenuLink()
    {
        $menuId = 1;
        $parentId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $parentId);
        
        $menuLink = $this->viewVariable('menuLink');
        $expectedType = \MenuManager\Model\Entity\MenuLink::class;
        $actualType = getTypeName($menuLink);
        
        $this->assertInstanceOf($expectedType, $menuLink, __('Wrong variable type of $menuLink. Expect {0} but  got {1} instead', $expectedType, $actualType));
    }
    
    /**
     * Test addTo method set $menus view variable.
     * 
     * Menu and MenuLink records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToSetViewVariableMenus()
    {
        $menuId = 1;
        $menuLinkId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $menuLinkId);
        
        $menus = $this->viewVariable('menus');
        
        $this->assertNotNull($menus, __('May be the view variable $menus is not set in addTo method.'));
    }
    
    /**
     * Test addTo method type of $menus view variable.
     * 
     * Menu and MenuLink records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToTypeOfViewVariableMenus()
    {
        $menuId = 1;
        $parentId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $parentId);
        
        $menus = $this->viewVariable('menus');
        $expectedType = \Cake\ORM\Query::class;
        $actualType = getTypeName($menus);
        
        $this->assertInstanceOf($expectedType, $menus, __('Wrong variable type of $menus. Expect {0} but  got {1} instead', $expectedType, $actualType));
    }
    
    /**
     * Test addTo method set $parentMenuLinks view variable.
     * 
     * Menu and MenuLink records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToSetViewVariableParentMenuLinks()
    {
        $menuId = 1;
        $menuLinkId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $menuLinkId);
        
        $parentMenuLinks = $this->viewVariable('parentMenuLinks');
        
        $this->assertNotNull($parentMenuLinks, __('May be the view variable $menus is not set in addTo method.'));
    }
    
    /**
     * Test addTo method type of $parentMenuLinks view variable.
     * 
     * Menu and MenuLink records are defined in fixtures.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToTypeOfViewVariableParentMenuLinks()
    {
        $menuId = 1;
        $parentId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $parentId);
        
        $parentMenuLinks = $this->viewVariable('parentMenuLinks');
        $expectedType = \Cake\ORM\Query::class;
        $actualType = getTypeName($parentMenuLinks);
        
        $this->assertInstanceOf($expectedType, $parentMenuLinks, __('Wrong variable type of $menus. Expect {0} but  got {1} instead', $expectedType, $actualType));
    }
    
    /**
     * Test addTo method will set $menuLink->menu_id property equal to passed first argument.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToMenuLinkPropertyMenuIdHasValue()
    {
        $menuId = 1;
        $parentId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $parentId);
        
        $menuLink = $this->viewVariable('menuLink');
        
        $this->assertTrue($menuLink->has('menu_id'));
        $this->assertEquals($menuId, $menuLink->menu_id, __('Value of $menuLink->menu_id is not set properly. Expect {0} but got {1} instead', $menuId, $menuLink->menu_id));
    }
    
    /**
     * Test addTo method will set $menuLink->parent_id property equal to passed second argument.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToMenuLinkPropertyParentIdHasValue()
    {
        $menuId = 1;
        $parentId = 2;
        
        $this->post('/admin/menu-manager/menu-links/add-to/' . $menuId . '/' . $parentId);
        
        $menuLink = $this->viewVariable('menuLink');
        
        $this->assertTrue($menuLink->has('parent_id'));
        $this->assertEquals($parentId, $menuLink->parent_id, __('Value of $menuLink->parent_id is not set properly. Expect {0} but got {1} instead', $parentId, $menuLink->parent_id));
    }
    
    /**
     * Test addTo method which template use.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToUseTemplateAdd()
    {
        $this->post('/admin/menu-manager/menu-links/add-to/1/2');
        
        $this->assertEquals('add', $this->_controller->viewBuilder()->getTemplate(), __('Wrong template used.'));
    }
    
    /**
     * Test addTo method with POST request
     * 
     * @param none
     * @return  array
     */
    public function testAdminAddToPost()
    {
        $data = [
            'title' => 'New Link Title',
            'url' => '/',
            'menu_id' => 1,
            'parent_id' => NULL,
            'is_active' => TRUE,
        ];
        
        $this->post('/admin/menu-manager/menu-links/addTo/1/2', $data);
        
        $this->assertResponseSuccess();
        
        return $data;
    }
    
    /**
     * Test addTo method will redirect if save record. To achieve this, must pass
     * valid data in POST request.
     * 
     * @depends testAdminAddToPost
     * 
     * @param array $data
     * @return void
     */
    public function testAdminAddToPostRedirect(array $data)
    {
        $this->post('/admin/menu-manager/menu-links/addTo/1/2', $data);
        
        $this->assertRedirect();
    }
    
    /**
     * Test addTo method redirect url when $parentId parameter is NULL.
     * To achieve that must pass valid data in POST request and second parameter
     * must be NULL.
     * 
     * @depends testAdminAddToPost
     * 
     * @param array $data
     * @return void
     */
    public function testAdminAddToPostRedirectUrlWhenParentIdIsNull(array $data)
    {
        $menuId = 1;
        
        $this->post('/admin/menu-manager/menu-links/addTo/' . $menuId, $data);
        
        $this->assertRedirect(['controller' => 'Menus', 'action' => 'view', $menuId]);
    }
    
    /**
     * Test addTo method redirect url when $parentId parameter is not NULL.
     * To achieve that must pass valid data in POST request and second parameter
     * must be passed with valid value.
     * 
     * @depends testAdminAddToPost
     * 
     * @param array $data
     * @return void
     */
    public function testAdminAddToPostRedirectUrlWhenParentIdIsNotNull(array $data)
    {
        $menuId = 1;
        $parentId = 1;
        
        $this->post('/admin/menu-manager/menu-links/addTo/' . $menuId . '/' . $parentId, $data);
        
        $this->assertRedirect(['controller' => 'MenuLinks', 'action' => 'view', $parentId]);
    }
    
    /**
     * Test addTo method with Invalid data. Here $data['url'] and $data['menu_id']
     * are defined as NULL, which will fail validation.
     * 
     * @param none
     * @return void
     */
    public function testAdminAddToPostWithInvalidData()
    {
        $data = [
            'title' => 'New Link Title',
            'url' => NULL,
            'menu_id' => NULL,
            'parent_id' => NULL,
            'is_active' => TRUE,
        ];
        
        $this->post('/admin/menu-manager/menu-links/addTo/1/2', $data);
        
        $this->assertNoRedirect(__('Method must not redirect when Post data is invalid.'));
    }
    
    /**
     * Test tree method.
     * 
     * @param none
     * @return void
     */
    public function testAdminTree()
    {
        $this->get('/admin/menu-manager/menu-links/tree');
        
        $this->assertResponseOk();
    }
    
    /**
     * Test tree method is set $menuLinksGroups view variable.
     * 
     * @param none
     * @return void
     */
    public function testAdminTreeMenuLinksGroupsViewVariable()
    {
        $this->get('/admin/menu-manager/menu-links/tree');
        
        $menuLinksGroups = $this->viewVariable('menuLinksGroups');
        
        $this->assertNotNull($menuLinksGroups, __('View variable $menuLinksGroups is not set to the view.'));
    }
    
    /**
     * Test tree method is set $menuLinksGroups view variable type.
     * 
     * @param none
     * @return void
     */
    public function testAdminTreeMenuLinksGroupsViewVariableType()
    {
        $this->get('/admin/menu-manager/menu-links/tree');
        
        $menuLinksGroups = $this->viewVariable('menuLinksGroups');
        
        $this->assertInstanceOf(\Cake\Collection\Collection::class, $menuLinksGroups);
    }
}
