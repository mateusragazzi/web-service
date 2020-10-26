<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aluno $aluno
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Aluno'), ['action' => 'edit', $aluno->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Aluno'), ['action' => 'delete', $aluno->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aluno->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Alunos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Aluno'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="alunos view content">
            <h3><?= h($aluno->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($aluno->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rga') ?></th>
                    <td><?= h($aluno->rga) ?></td>
                </tr>
                <tr>
                    <th><?= __('Curso') ?></th>
                    <td><?= h($aluno->curso) ?></td>
                </tr>
                <tr>
                    <th><?= __('Situacao Cadastro') ?></th>
                    <td><?= $aluno->has('situacao_cadastro') ? $this->Html->link($aluno->situacao_cadastro->id, ['controller' => 'SituacaoCadastros', 'action' => 'view', $aluno->situacao_cadastro->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($aluno->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registrado Por') ?></th>
                    <td><?= $this->Number->format($aluno->registrado_por) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado Por') ?></th>
                    <td><?= $this->Number->format($aluno->modificado_por) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registrado Em') ?></th>
                    <td><?= h($aluno->registrado_em) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado Em') ?></th>
                    <td><?= h($aluno->modificado_em) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
