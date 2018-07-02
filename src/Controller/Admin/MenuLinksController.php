<?php
namespace MenuManager\Controller\Admin;

use MenuManager\Controller\AppController;

/**
 * MenuLinks Controller
 *
 * @property \MenuManager\Model\Table\MenuLinksTable $MenuLinks
 *
 * @method \MenuManager\Model\Entity\MenuLink[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MenuLinksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Menus', 'ParentMenuLinks']
        ];
        $menuLinks = $this->paginate($this->MenuLinks);

        $this->set(compact('menuLinks'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu Link id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menuLink = $this->MenuLinks->get($id, [
            'contain' => ['Menus', 'ParentMenuLinks', 'ChildMenuLinks']
        ]);

        $this->set('menuLink', $menuLink);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menuLink = $this->MenuLinks->newEntity();
        if ($this->request->is('post')) {
            $menuLink = $this->MenuLinks->patchEntity($menuLink, $this->request->getData());
            if ($this->MenuLinks->save($menuLink)) {
                $this->Flash->success(__('The menu link has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu link could not be saved. Please, try again.'));
        }
        $menus = $this->MenuLinks->Menus->find('list', ['limit' => 200]);
        $parentMenuLinks = $this->MenuLinks->ParentMenuLinks->find('treeList', ['spacer' => '-- ']);
        $this->set(compact('menuLink', 'menus', 'parentMenuLinks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu Link id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menuLink = $this->MenuLinks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuLink = $this->MenuLinks->patchEntity($menuLink, $this->request->getData());
            if ($this->MenuLinks->save($menuLink)) {
                $this->Flash->success(__('The menu link has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu link could not be saved. Please, try again.'));
        }
        $menus = $this->MenuLinks->Menus->find('list', ['limit' => 200]);
        $parentMenuLinks = $this->MenuLinks->ParentMenuLinks->find('treeList', ['spacer' => '-- ']);
        $this->set(compact('menuLink', 'menus', 'parentMenuLinks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu Link id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menuLink = $this->MenuLinks->get($id);
        if ($this->MenuLinks->delete($menuLink)) {
            $this->Flash->success(__('The menu link has been deleted.'));
        } else {
            $this->Flash->error(__('The menu link could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * Add Menu Link as parent or sub Link. When second parameter is not passed
     * it appear as Parent Link. Otherwise sub link.
     * 
     * Also when second parameter is not passed method will redirect to Menu preview,
     * otherwise to Parent Link preview.
     * 
     * @param int $menuId
     * @param int $parentId
     * @return @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addTo(int $menuId, int $parentId = NULL)
    {
        $menuLink = $this->MenuLinks->newEntity();
        
        $menuLink->menu_id = $menuId;
        $menuLink->parent_id = $parentId;
        
                $redirectUrl = $parentId === NULL ? 
                    ['controller' => 'Menus', 'action' => 'view', $menuId] : 
                    ['controller' => 'MenuLinks', 'action' => 'view', $parentId];
                
        if ($this->request->is('post')) {
            $menuLink = $this->MenuLinks->patchEntity($menuLink, $this->request->getData());
            if ($this->MenuLinks->save($menuLink)) {
                $this->Flash->success(__('The menu point has been saved.'));
                
                return $this->redirect($redirectUrl);
            }
            $this->Flash->error(__('The menu point could not be saved. Please, try again.'));
        }
        
        $menus = $this->MenuLinks->Menus->find('list', ['conditions' => ['id' => $menuId]]);
        $parentMenuLinks = $this->MenuLinks->ParentMenuLinks->find('treeList', [
            'spacer' => '-- ',
            'conditions' => ['menu_id' => $menuId]
        ]);
        
        $this->set(compact('menuLink', 'menus', 'parentMenuLinks'));
        
        $this->viewBuilder()->setTemplate('add');
    }
}
