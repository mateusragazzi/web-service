<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aluno[]|\Cake\Collection\CollectionInterface $alunos
 */
?>
<div class="alunos index content">
    <?= $this->Html->link(__('New Aluno'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Alunos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th><?= $this->Paginator->sort('rga') ?></th>
                    <th><?= $this->Paginator->sort('curso') ?></th>
                    <th><?= $this->Paginator->sort('situacao_id') ?></th>
                    <th><?= $this->Paginator->sort('registrado_por') ?></th>
                    <th><?= $this->Paginator->sort('modificado_por') ?></th>
                    <th><?= $this->Paginator->sort('registrado_em') ?></th>
                    <th><?= $this->Paginator->sort('modificado_em') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= $this->Number->format($aluno->id) ?></td>
                    <td><?= h($aluno->nome) ?></td>
                    <td><?= h($aluno->rga) ?></td>
                    <td><?= h($aluno->curso) ?></td>
                    <td><?= $aluno->has('situacao_cadastro') ? $this->Html->link($aluno->situacao_cadastro->id, ['controller' => 'SituacaoCadastros', 'action' => 'view', $aluno->situacao_cadastro->id]) : '' ?></td>
                    <td><?= $this->Number->format($aluno->registrado_por) ?></td>
                    <td><?= $this->Number->format($aluno->modificado_por) ?></td>
                    <td><?= h($aluno->registrado_em) ?></td>
                    <td><?= h($aluno->modificado_em) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $aluno->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aluno->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aluno->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aluno->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
