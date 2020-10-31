<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($user->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Senha') ?></th>
                    <td><?= h($user->senha) ?></td>
                </tr>
                <tr>
                    <th><?= __('Situacao Cadastro') ?></th>
                    <td><?= $user->has('situacao_cadastro') ? $this->Html->link($user->situacao_cadastro->id, ['controller' => 'SituacaoCadastros', 'action' => 'view', $user->situacao_cadastro->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registrado Em') ?></th>
                    <td><?= h($user->registrado_em) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado Em') ?></th>
                    <td><?= h($user->modificado_em) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
