<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTableSituacaoCadastros extends AbstractMigration
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
        if (!$this->hasTable('situacao_cadastros')) {
            $table = $this->table('situacao_cadastros');
            $table->addColumn('nome', 'string', ['null' => true]);
            $table->create();

            $this->execute('INSERT INTO situacao_cadastros (nome) VALUES ("Ativo"), ("Inativo");');
        }
    }
}
