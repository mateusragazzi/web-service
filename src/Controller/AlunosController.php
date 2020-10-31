<?php
declare(strict_types=1);

namespace App\Controller;

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
        $this->autoRender = false;
        
        $alunos = $this->Alunos->find();
        $json = array();

        try{
            $alunos->where(['Alunos.id' => $id])->first();
            if(empty($alunos)){
                throw new Exception('Usuário não foi encontrado.');
            }
            else{
                if(!empty($this->request->getQuery('nome'))){
                    $alunos->andWhere(['Alunos.nome' => $this->request->getQuery('nome')]);
                }
                if(!empty($this->request->getQuery('pagina'))){
                    // $alunos->limit($this->request->getQuery('pagina'));

                    //Deve usar aquela paradinha de paginação
                }

                // O isset estava dando erro kkkk
                if($this->request->getQuery('limite') >= 0){
                    $alunos->limit($this->request->getQuery('limite'));
                }
                $this->response->statusCode(200);
                $json = $alunos;
                
            }

        }catch(Exception $e){
            $json = [
                'msg' => 'Não foi encontrado aluno com essas informações :(',
            ];
            $this->response->statusCode(400);
        }
      
        return $this->response->withType('json')->withStringBody(json_encode($json));
    }

    /**
     * View method
     *
     * @param string|null $id Aluno id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $aluno = $this->Alunos->get($id, [
            'contain' => ['SituacaoCadastros'],
        ]);

        $this->set(compact('aluno'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $aluno = $this->Alunos->newEmptyEntity();
        if ($this->request->is('post')) {
            $aluno = $this->Alunos->patchEntity($aluno, $this->request->getData());
            if ($this->Alunos->save($aluno)) {
                $this->Flash->success(__('The aluno has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The aluno could not be saved. Please, try again.'));
        }
        $situacaoCadastros = $this->Alunos->SituacaoCadastros->find('list', ['limit' => 200]);
        $this->set(compact('aluno', 'situacaoCadastros'));
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
        $aluno = $this->Alunos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $aluno = $this->Alunos->patchEntity($aluno, $this->request->getData());
            if ($this->Alunos->save($aluno)) {
                $this->Flash->success(__('The aluno has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The aluno could not be saved. Please, try again.'));
        }
        $situacaoCadastros = $this->Alunos->SituacaoCadastros->find('list', ['limit' => 200]);
        $this->set(compact('aluno', 'situacaoCadastros'));
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
        // $this->request->allowMethod(['post', 'delete']);
        $aluno = $this->Alunos->find()->where(['Alunos.id' => $id])->first();

        try{
            if ($this->Alunos->delete($aluno)) {
                $this->Flash->success(__('The aluno has been deleted.'));
            } else {
                throw new Exception('The aluno could not be deleted. Please, try again.');
            }
        }catch(Exception $e){
            $json = [
                ''
            ]
        }
        

        return $this->redirect(['action' => 'index']);
    }
}
