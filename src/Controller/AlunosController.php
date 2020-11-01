<?php

declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Alunos Controller
 *
 * @property \App\Model\Table\AlunosTable $Alunos
 * @method \App\Model\Entity\Aluno[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AlunosController extends AppController
{

    public $paginate = [
        'order' => [
            'Alunos.nome' => 'asc'
        ]
    ];

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($id = null)
    {
        $this->request->allowMethod('get');

        $limite = 25;
        $response = $this->response->withType('application/json');

        $alunos = $this->Alunos->find();

        if (!empty($id)) {
            $statusCode = 404;
            $json = "Não foi possível encontrar usuário :(";

            $alunos->where(['Alunos.id' => $id])->first();
        } else {
            $statusCode = 400;
            $json = "Não foi possível encontrar com esses parâmetros!.";

            if (!empty($this->request->getQuery('nome'))) {
                $alunos->andWhere(['Alunos.nome LIKE' => '%' . $this->request->getQuery('nome') . '%']);
            }

            if (($this->request->getQuery('limite')) >= 0) {
                $limite = $this->request->getQuery('limite');
                $alunos->limit($this->request->getQuery('limite'));
            }

            if (!empty($this->request->getQuery('pagina'))) {
                $this->paginate['page'] = $this->request->getQuery('pagina');
                $this->paginate['limit'] = $limite;
            }
        }

        if ($alunos->count() > 0) {
            $statusCode = 200;
            $json = $alunos;
            if ($alunos->count() > 1) {
                $alunos = $this->paginate($alunos);
            }
        }

        $response = $response->withStatus($statusCode);
        return $response->withStringBody(json_encode($json));
    }

    /**
     * 1ª Documentação - 31/10/2020, por Mateus Ragazzi
     * Função que realiza o post do 
     *
     * @return \Cake\Http\Response $response resposta para o cliente, com status e dados.
     */
    public function add($parametroInvalido = null)
    {
        $this->request->allowMethod(['post']);

        $response = $this->response->withType('application/json');
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $statusCode = 405;
        $json = "Método Inválido.";

        if (empty($parametroInvalido)) {
            $statusCode = 400;
            $json = "Parâmetros inválidos.";

            $aluno = $this->Alunos->newEmptyEntity();
            $aluno = $this->Alunos->patchEntity($aluno, $this->request->getData());
            if ($this->Alunos->save($aluno)) {
                $json = $aluno->toArray();
                $statusCode = 200;
                $json = $aluno;
            }
        }

        $response = $response->withStatus($statusCode);
        return $response->withStringBody(json_encode($json));
    }

    /**
     * Edit method
     *
     * @param string|null $id Aluno id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod('put');
        $response = $this->response->withType('application/json');

        $statusCode = 405;                   //CONFERIR ANTES DE SUBIR
        $json = "Erro ao procurar.";
        if (!empty($id)) {
            $statusCode = 404;               //CONFERIR ANTES DE SUBIR
            $json = "Não foi possível modificar :(";
            $aluno = $this->Alunos->get($id);

            $aluno = $this->Alunos->patchEntity($aluno, $this->request->getData());
            if ($this->Alunos->save($aluno)) {
                $statusCode = 200;
                $json = "Aluno editado com sucesso!";
            }
        }
        $response = $response->withStatus($statusCode);
        return $response->withStringBody(json_encode($json));
    }

    /**
     * Delete method
     *
     * @param string|null $id Aluno id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $response = $this->response->withType('application/json');

        $statusCode = 405;                   //CONFERIR ANTES DE SUBIR
        $json = "Erro ao deletar.";

        if (!empty($id)) {
            $statusCode = 404;               //CONFERIR ANTES DE SUBIR
            $json = "Não foi possível excluir :(";

            $aluno = $this->Alunos->find()->where(['Alunos.id' => $id])->first();
            if (!empty($aluno)) {
                $aluno->situacao = 'Inativo';
                if ($this->Alunos->save($aluno)) {

                    $statusCode = 200;
                    $json = $aluno;
                }
            }
        }
        $response = $response->withStatus($statusCode);
        return $response->withStringBody(json_encode($json));
    }
}
