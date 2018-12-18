<?php
namespace MenuManager\Controller\Admin;

use MenuManager\Controller\AppController;

/**
 * MenuLinks Controller
 *
 * @property \MenuManager\Model\Table\MenuLinksTable $MenuLinks
 *
 * @method \MenuManager\Model\Entity\MenuLink[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @method AppController _getTranslationLanguages()
 */
class MenuLinksController extends AppController
{
    /**
     * Get Menu Link by id.
     *
     * @param string|null $id Menu Link id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menuLink = $this->MenuLinks->get($id, [
            'contain' => ['Menus', 'ParentMenuLinks', 'ChildMenuLinks'],
            'finder' => 'translations'
        ]);

        $this->set('menuLink', $menuLink);
    }

    /**
     * Add Menu Link to Menu.
     * 
     * @param int $menuId
     * @param int|NULL $parentLinkId
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(int $menuId, int $parentLinkId = NULL)
    {
        $menuLink = $this->MenuLinks->newEntity();
        $menuLink->menu_id = $menuId;
        $menuLink->parent_id = $parentLinkId;
        
        if ($this->request->is('post')) {
            $menuLink = $this->MenuLinks->patchEntity($menuLink, $this->request->getData());
            if ($this->MenuLinks->save($menuLink)) {
                $this->Flash->success(__('The menu link has been saved.'));

                return $this->redirect(['controller' => 'Menus', 'action' => 'view', $menuLink->menu_id]);
            }
            $this->Flash->error(__('The menu link could not be saved. Please, try again.'));
        }
        
        $menus = $this->MenuLinks->Menus->find('list', ['limit' => 200]);
        $parentMenuLinks = $this->MenuLinks->ParentMenuLinks->find('treeList', ['spacer' => '-- '])
                ->where(['menu_id' => $menuId]);
        
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

                return $this->redirect(['action' => 'view', $menuLink->id]);
            }
            $this->Flash->error(__('The menu link could not be saved. Please, try again.'));
        }
        
        $menus = $this->MenuLinks->Menus->find('list', ['limit' => 200])->where(['id' => $menuLink->menu_id]);
        $parentMenuLinks = $this->MenuLinks->ParentMenuLinks->find('treeList', ['spacer' => '-- '])
                ->where(['menu_id' => $menuLink->menu_id]);
        
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

        return $this->redirect(['controller' => 'Menus', 'action' => 'view', $menuLink->menu_id]);
    }
    
    /**
     * Method gets all Menu Link as 'threaded' and grouped by Menu title.
     * 
     * @param none
     * @return \Cake\Http\Response|void
     */
    public function tree()
    {
        $menuLinksGroups = $this->MenuLinks->find('threaded')
                ->contain(['Menus'])
                ->groupBy('menu.title');
        
        $this->set('menuLinksGroups', $menuLinksGroups);
    }
    
    /**
     * Get MenuLink entity with translations.
     * Filter translation languages to all that Menu Link is not translated.
     * When save Menu Link data, on success redirect to Menu Link preview.
     * The method do the same when Menu Link has translations about all supported
     * languages.
     * 
     * @param string $id Menu Link id
     * @return \Cake\Http\Response|\Cake\View\View
     */
    public function translate(string $id)
    {
        $menuLink = $this->MenuLinks->get($id, [
            'finder' => 'translations'
        ]);
        
        if ($this->request->is(['patch', 'put', 'post'])) {
            $this->request = $this->request->withData('translation.menu_id', $menuLink->menu_id);
            $menuLink->setAccess('_locale', TRUE);
            $menuLink = $this->MenuLinks->patchEntity($menuLink, $this->request->getData('translation'));
            
            if ($this->MenuLinks->save($menuLink)) {
                $this->Flash->success(__('Menu Link Translation was saved successful.'));
                
                return $this->redirect(['action' => 'view', $menuLink->id]);
            }
            
            $this->Flash->error(__('Menu Link Translation failed to save. Please, try again.'));
            
        }
        
        $translationLanguages = $this->_getTranslationLanguages();
        $languages = array_diff_key($translationLanguages, $menuLink->_translations);
        
        if (count($languages) === 0) {
            $this->Flash->success(__('Menu Link "{0}" has translations about all supported languages.', $menuLink->title));
            
            return $this->redirect(['action' => 'view', $menuLink->id]);
        }
        
        $this->set(compact('menuLink', 'languages'));
    }
    
    /**
     * Method get MenuLink entity with translation by passed language (locale)
     * and save it after edit.
     * 
     * @param string $id Menu Link id
     * @param string $locale Locale about translation
     * @return void|\Cake\Http\Client\Response 
     */
    public function translationEdit(string $id, string $locale)
    {
        $menuLink = $this->MenuLinks->get($id, [
            'finder' => 'translations',
            'locales' => $locale
        ]);
        
        if (empty($menuLink->_translations)) {
            $this->Flash->error(__('The Translation Not Found'));
            
            return $this->redirect(['action' => 'view', $menuLink->id]);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menuLink = $this->MenuLinks->patchEntity($menuLink, $this->request->getData());
            
            if ($this->MenuLinks->save($menuLink)) {
                $this->Flash->success(__('The Translation was updated successful.'));
                
                return $this->redirect(['action' => 'view', $menuLink->id]);
            }
            
            $this->Flash->error(__('The Translation update failed.'));
        }
        
        $this->set('locale', $locale);
        $this->set('menuLink', $menuLink);
    }
}
