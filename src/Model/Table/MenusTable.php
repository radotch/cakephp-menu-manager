<?php
namespace MenuManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * Menus Model
 *
 * @property \MenuManager\Model\Table\MenuLinksTable|\Cake\ORM\Association\HasMany $MenuLinks
 *
 * @method \MenuManager\Model\Entity\Menu get($primaryKey, $options = [])
 * @method \MenuManager\Model\Entity\Menu newEntity($data = null, array $options = [])
 * @method \MenuManager\Model\Entity\Menu[] newEntities(array $data, array $options = [])
 * @method \MenuManager\Model\Entity\Menu|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MenuManager\Model\Entity\Menu|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MenuManager\Model\Entity\Menu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MenuManager\Model\Entity\Menu[] patchEntities($entities, array $data, array $options = [])
 * @method \MenuManager\Model\Entity\Menu findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MenusTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('menus');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Translate', [
            'fields' => ['title'],
            'translationTable' => 'MenuManager.MenuI18n'
        ]);

        $this->hasMany('MenuLinks', [
            'foreignKey' => 'menu_id',
            'className' => 'MenuManager.MenuLinks',
            'dependent' => TRUE,
            'cascadeCallbacks' => TRUE
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('alias')
            ->maxLength('alias', 255)
            ->requirePresence('alias', 'create')
            ->notEmpty('alias');

        return $validator;
    }
    
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['title'], __('This title is already in use.')));
        $rules->add($rules->isUnique(['alias'], __('This alaias is already in use.')));

        return $rules;
    }
    
    /**
     * Method removes empty translations from request data.
     * 
     * @param Event $event
     * @param ArrayObject $data
     * @param \MenuManager\Model\Table\Arraybject $options
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        $translations = array_key_exists('_translations', $data) ? $data['_translations'] : [];
        foreach ($translations as $lang => $translation) {
            if ($translation['title'] === '') {
                unset($data['_translations'][$lang]);
            }
        }
    }
}
