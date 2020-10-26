<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Alunos Model
 *
 * @property \App\Model\Table\SituacaoCadastrosTable&\Cake\ORM\Association\BelongsTo $SituacaoCadastros
 *
 * @method \App\Model\Entity\Aluno newEmptyEntity()
 * @method \App\Model\Entity\Aluno newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Aluno[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Aluno get($primaryKey, $options = [])
 * @method \App\Model\Entity\Aluno findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Aluno patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Aluno[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Aluno|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aluno saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aluno[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Aluno[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Aluno[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Aluno[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AlunosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('alunos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SituacaoCadastros', [
            'foreignKey' => 'situacao_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('rga')
            ->maxLength('rga', 15)
            ->requirePresence('rga', 'create')
            ->notEmptyString('rga');

        $validator
            ->scalar('curso')
            ->maxLength('curso', 255)
            ->allowEmptyString('curso');

        $validator
            ->integer('registrado_por')
            ->allowEmptyString('registrado_por');

        $validator
            ->integer('modificado_por')
            ->allowEmptyString('modificado_por');

        $validator
            ->dateTime('registrado_em')
            ->allowEmptyDateTime('registrado_em');

        $validator
            ->dateTime('modificado_em')
            ->allowEmptyDateTime('modificado_em');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['situacao_id'], 'SituacaoCadastros'), ['errorField' => 'situacao_id']);

        return $rules;
    }
}
