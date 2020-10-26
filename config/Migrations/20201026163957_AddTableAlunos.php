<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTableAlunos extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        if (!$this->hasTable('alunos')) {
            $table = $this->table('alunos');
            $table->addColumn('nome', 'string', ['null' => false]);
            $table->addColumn('rga', 'string', ['limit' => 15, 'null' => false]);
            $table->addColumn('curso', 'string', ['null' => true]);

            $table->addColumn('situacao_id', 'integer', ['default' => 1, 'null' => true]);
            $table->addColumn('registrado_por', 'integer', ['null' => true]);
            $table->addColumn('modificado_por', 'integer', ['null' => true]);
            $table->addColumn('registrado_em', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => true]);
            $table->addColumn('modificado_em', 'datetime', ['null' => true]);

            $table->addForeignKey('situacao_id', 'situacao_cadastros', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION']);
            $table->addForeignKey('registrado_por', 'users', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION']);
            $table->addForeignKey('modificado_por', 'users', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION']);

            $table->create();
        }
    }
}
