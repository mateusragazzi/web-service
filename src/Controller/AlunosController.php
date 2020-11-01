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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($id = null)
    {   
        $response = $this->response->withType('application/json');
        
        $alunos = $this->Alunos->find();

        
        if (!empty($id)) {
            $statusCode = 404;               //CONFERIR ANTES DE SUBIR
            $json = "Não foi possível encontrar usuário :(";

            $alunos->where(['Alunos.id' => $id])->first();
            
            
        }
        else{
            $statusCode = 400;               //CONFERIR ANTES DE SUBIR
            $json = "Não foi possível encontrar com esses parâmetros!.";

            $alunos->where(['Alunos.nome !=' =>  '']);
            if(!empty($this->request->getQuery('nome'))){
                $alunos->andWhere(['Alunos.nome' => $this->request->getQuery('nome')]);
            }

            if($this->request->getQuery('limite') >= 0){
                $alunos->limit($this->request->getQuery('limite'));
            }

            // Ver como fazer a paginação com o Mateus

            // if(!empty($this->request->getyQuery('pagina'))){
            //     $alunos->paginate([$this->request->getyQuery('pagina')]);
            // }

        }
        if (!empty($alunos)) {
            $statusCode = 200;
            $json = $alunos;
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
                $json = "Aluno salvo com sucesso!";
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
        $response = $this->response->withType('application/json');

        $statusCode = 405;                   //CONFERIR ANTES DE SUBIR
        $json = "ID Inválido.";

        if (!empty($id)) {
            $statusCode = 400;               //CONFERIR ANTES DE SUBIR
            $json = "Não foi possível modificar :(";
            $aluno = $this->Alunos->get($id, [
                'contain' => [],
            ]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                if (!empty($aluno)) {
                    $statusCode = 200;
                    $json = "Aluno deletado com sucesso!";

                    $aluno = $this->Alunos->patchEntity($aluno, $this->request->getData());
                    $this->Alunos->save($aluno);
                }
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
        $this->request->allowMethod(['post', 'delete']);
        $response = $this->response->withType('application/json');
        
        $statusCode = 405;                   //CONFERIR ANTES DE SUBIR
        $json = "ID Inválido.";

        if (!empty($id)) {
            $statusCode = 400;               //CONFERIR ANTES DE SUBIR
            $json = "Não foi possível excluir :(";

            $aluno = $this->Alunos->find()->where(['Alunos.id' => $id])->first();
            if (!empty($aluno)) {
                $this->Alunos->delete($aluno);
                $statusCode = 200;
                $json = "Aluno deletado com sucesso!";
            }
        }
        $response = $response->withStatus($statusCode);
        return $response->withStringBody(json_encode($json));
      
    }
}
