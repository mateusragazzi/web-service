<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTableUsers extends AbstractMigration
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
        if (!$this->hasTable('users')) {
            $table = $this->table('users');
            $table->addColumn('nome', 'string', ['null' => true]);
            $table->addColumn('senha', 'string', ['null' => true]);
            $table->addColumn('situacao_id', 'integer', ['default' => 1, 'null' => true]);
            $table->addColumn('registrado_em', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => true]);
            $table->addColumn('modificado_em', 'datetime', ['null' => true]);
            $table->addForeignKey('situacao_id', 'situacao_cadastros', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION']);
            $table->create();
        }
    }
}
