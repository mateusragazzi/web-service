<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aluno $aluno
 */
?>
<div class="row">
    <aside class="column">
    </aside>
    <div class="column-responsive ">
        <div class="alunos form content">
            <?= $this->Form->create($aluno) ?>
            <fieldset>
                <legend style="padding-bottom:10px"><?= __('Novo Aluno') ?></legend>
                <?php
                    echo $this->Form->text('nome', ['label' => 'Nome Completo', 'class' => 'tamanho-letra']);
                    echo $this->Form->control('rga', ['label' => 'RGA','class' => 'tamanho-letra']);
                    echo $this->Form->control('curso', ['class' => 'tamanho-letra']);
                    // echo $this->Form->control('situacao_id', ['options' => $situacaoCadastros, 'empty' => true]);
                    // echo $this->Form->control('registrado_por');
                    // echo $this->Form->control('modificado_por');
                    // echo $this->Form->control('registrado_em', ['empty' => true]);
                    // echo $this->Form->control('modificado_em', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enviar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
