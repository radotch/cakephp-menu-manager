<?php
namespace MenuManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MenuI18n Model
 *
 * @method \MenuManager\Model\Entity\MenuI18n get($primaryKey, $options = [])
 * @method \MenuManager\Model\Entity\MenuI18n newEntity($data = null, array $options = [])
 * @method \MenuManager\Model\Entity\MenuI18n[] newEntities(array $data, array $options = [])
 * @method \MenuManager\Model\Entity\MenuI18n|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MenuManager\Model\Entity\MenuI18n|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MenuManager\Model\Entity\MenuI18n patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MenuManager\Model\Entity\MenuI18n[] patchEntities($entities, array $data, array $options = [])
 * @method \MenuManager\Model\Entity\MenuI18n findOrCreate($search, callable $callback = null, $options = [])
 */
class MenuI18nTable extends Table
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

        $this->setTable('menu_i18n');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('locale')
            ->maxLength('locale', 9)
            ->requirePresence('locale', 'create')
            ->notEmpty('locale');

        $validator
            ->scalar('model')
            ->maxLength('model', 255)
            ->requirePresence('model', 'create')
            ->notEmpty('model');

        $validator
            ->integer('foreign_key')
            ->requirePresence('foreign_key', 'create')
            ->notEmpty('foreign_key');

        $validator
            ->scalar('field')
            ->maxLength('field', 255)
            ->requirePresence('field', 'create')
            ->notEmpty('field');

        $validator
            ->scalar('content')
            ->maxLength('content', 255)
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        return $validator;
    }
}
