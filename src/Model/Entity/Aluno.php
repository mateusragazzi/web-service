<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Aluno Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $rga
 * @property string|null $curso
 * @property int|null $situacao_id
 * @property int|null $registrado_por
 * @property int|null $modificado_por
 * @property \Cake\I18n\FrozenTime|null $registrado_em
 * @property \Cake\I18n\FrozenTime|null $modificado_em
 *
 * @property \App\Model\Entity\SituacaoCadastro $situacao_cadastro
 */
class Aluno extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
        'rga' => true,
        'curso' => true,
        'situacao_id' => true,
        'registrado_por' => true,
        'modificado_por' => true,
        'registrado_em' => true,
        'modificado_em' => true,
        'situacao_cadastro' => true,
    ];
}
