<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlunosFixture
 */
class AlunosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'nome' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'rga' => ['type' => 'string', 'length' => 15, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'curso' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'situacao_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'registrado_por' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modificado_por' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'registrado_em' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => 'current_timestamp()', 'comment' => ''],
        'modificado_em' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'situacao_id' => ['type' => 'index', 'columns' => ['situacao_id'], 'length' => []],
            'registrado_por' => ['type' => 'index', 'columns' => ['registrado_por'], 'length' => []],
            'modificado_por' => ['type' => 'index', 'columns' => ['modificado_por'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'alunos_ibfk_3' => ['type' => 'foreign', 'columns' => ['modificado_por'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'alunos_ibfk_2' => ['type' => 'foreign', 'columns' => ['registrado_por'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'alunos_ibfk_1' => ['type' => 'foreign', 'columns' => ['situacao_id'], 'references' => ['situacao_cadastros', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'nome' => 'Lorem ipsum dolor sit amet',
                'rga' => 'Lorem ipsum d',
                'curso' => 'Lorem ipsum dolor sit amet',
                'situacao_id' => 1,
                'registrado_por' => 1,
                'modificado_por' => 1,
                'registrado_em' => '2020-10-26 19:19:51',
                'modificado_em' => '2020-10-26 19:19:51',
            ],
        ];
        parent::init();
    }
}
