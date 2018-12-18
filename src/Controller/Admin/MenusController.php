<?php
namespace MenuManager\Controller\Admin;

use MenuManager\Controller\AppController;

/**
 * Menus Controller
 *
 * @property \MenuManager\Model\Table\MenusTable $Menus
 *
 * @method \MenuManager\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @method AppController _getTranslationLanguages()
 */
class MenusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $menus = $this->paginate($this->Menus);

        $this->set(compact('menus'));
    }

    /**
     * View method get Menu which contain Menu Links. Menu Links finder is based
     * on URL query.
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $relatedLinksPreview = $this->request->getQuery('related_links_preview') !== 'tree' ? 'list' : 'tree';
        $menuLinksFinder = $relatedLinksPreview === 'tree' ? 'threaded' : 'all';
        $menu = $this->Menus->get($id, [
            'contain' => [
                'MenuLinks' => ['finder' => $menuLinksFinder],
                'MenuLinks.ParentMenuLinks'
            ],
            'finder' => 'translations'
        ]);

        $this->set('menu', $menu);
        $this->set('relatedLinksPreview', $relatedLinksPreview);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menu = $this->Menus->newEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }

    /**
     * Edit Menu. Method disable access to 'alias' field.
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => []
        ]);
        
        $menu->setAccess('alias', FALSE);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * Get Menu by id.
     * Save Menu Translation on POST request.
     * To be able to save Translation method set access to _locale property
     * which is used in Translate behavior according CakePHP documentation.
     * Also the method check are there translations about all supported languages.
     * If TRUE return to the menu preview.
     * 
     * 
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function translate(string $id)
    {
        $menu = $this->Menus->get($id, ['finder' => 'translations']);
        
        if ($this->request->is(['patch', 'put', 'post'])) {
            $menu->setAccess('_locale', TRUE);
            $menu = $this->Menus->patchEntity($menu, $this->request->getData('translation'));
            
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The translation of Menu was saved successful.'));
                
                return $this->redirect(['action' => 'view', $menu->id]);
            }
            
            $this->Flash->error(__('Failed to save translation. Please, try again.'));
        }
        
        $translationLanguages = $this->_getTranslationLanguages();
        $translations = $menu->_translations;
        
        $languages = array_diff_key($translationLanguages, $translations);
        if (count($languages) === 0) {
            $this->Flash->success(__('There are translations about all supported languages.'));
            
            return $this->redirect(['action' => 'view', $menu->id]);
        }
        
        $this->set(compact('menu', 'languages'));
    }
    
    /**
     * Get Menu by id and its translation about language by locale.
     * After data edit save it.
     * 
     * @param string $id Menu id.
     * @param string $locale Translation locale
     */
    public function editTranslation(string $id, string $locale)
    {
        $this->Menus->setLocale($locale);
        $menu = $this->Menus->get($id, []);
        
        if ($this->request->is(['patch', 'put', 'post'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('Menu Translation was updated.'));
                
                return $this->redirect(['action' => 'view', $menu->id]);
            }
            
            $this->Flash->error(__('Menu Translation update faied. Please, try again.'));
        }
        
        $languages = array_filter($this->_getTranslationLanguages(), function ($key) use ($locale) { return $key === $locale; }, ARRAY_FILTER_USE_KEY);
        $this->set(compact('menu', 'languages'));
    }
}
