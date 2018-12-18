<?php
namespace MenuManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * MenuLinks Model
 *
 * @property \MenuManager\Model\Table\MenusTable|\Cake\ORM\Association\BelongsTo $Menus
 * @property \MenuManager\Model\Table\MenuLinksTable|\Cake\ORM\Association\BelongsTo $ParentMenuLinks
 * @property \MenuManager\Model\Table\MenuLinksTable|\Cake\ORM\Association\HasMany $ChildMenuLinks
 *
 * @method \MenuManager\Model\Entity\MenuLink get($primaryKey, $options = [])
 * @method \MenuManager\Model\Entity\MenuLink newEntity($data = null, array $options = [])
 * @method \MenuManager\Model\Entity\MenuLink[] newEntities(array $data, array $options = [])
 * @method \MenuManager\Model\Entity\MenuLink|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MenuManager\Model\Entity\MenuLink|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MenuManager\Model\Entity\MenuLink patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MenuManager\Model\Entity\MenuLink[] patchEntities($entities, array $data, array $options = [])
 * @method \MenuManager\Model\Entity\MenuLink findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class MenuLinksTable extends Table
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

        $this->setTable('menu_links');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');
        $this->addBehavior('Translate', [
            'fields' => ['title'],
            'translationTable' => 'MenuManager.MenuI18n'
        ]);

        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id',
            'joinType' => 'INNER',
            'className' => 'MenuManager.Menus'
        ]);
        $this->belongsTo('ParentMenuLinks', [
            'className' => 'MenuManager.MenuLinks',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildMenuLinks', [
            'className' => 'MenuManager.MenuLinks',
            'foreignKey' => 'parent_id'
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
            ->scalar('url')
            ->maxLength('url', 255)
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->integer('menu_id')
            ->requirePresence('menu_id')
            ->notEmpty('menu_id');
        
        $validator
                ->integer('position')
                ->requirePresence('position', 'create')
                ->allowEmpty('position');

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
        $rules->add($rules->existsIn(['menu_id'], 'Menus'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentMenuLinks'));

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
