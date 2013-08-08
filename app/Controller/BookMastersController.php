<?php
App::uses('AppController', 'Controller');
/**
 * BookMasters Controller
 *
 * @property BookMaster $BookMaster
 */
class BookMastersController extends AppController {

	public $name = "BookMasters";
	
	// モデル指定
	public $uses = array('BookMaster', 'Color');

	// ヘルパー指定
	public $helpers = array('Time');

	// 認証処理が行われる前の処理
        public function beforeFilter() {
                // レイアウト変更
                $this->layout = 'management';
                // Auth関連
                $this->Auth->loginRedirect = array('controller' => 'management', 'action' => 'index');
                $this->Auth->logoutRedirect = array('controller' => 'management', 'action' => 'login');
                $this->Auth->loginAction = array('controller' => 'management', 'action' => 'login');
                $loginUser = $this->Auth->user();
                if (!empty($loginUser)) {
                        // ログインしている場合
                        $this->Auth->authError = 'アクセス権がありません';
                } else {
                        // ログインしていない場合
                        $this->Auth->authError = 'ログインしてください';
                }
                $this->Auth->loginError = 'ログインに失敗しました。';
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BookMaster->recursive = 0;
		$this->set('bookMasters', $this->paginate('BookMaster'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException(__('Invalid book master'));
		}
		$this->set('bookMaster', $this->BookMaster->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BookMaster->create();
			if ($this->BookMaster->save($this->request->data)) {
				$this->Session->setFlash(__('The book master has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book master could not be saved. Please, try again.'));
			}
		}
		$colors = $this->BookMaster->Color->find('list');
		$this->set(compact('colors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException(__('Invalid book master'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BookMaster->save($this->request->data)) {
				$this->Session->setFlash(__('The book master has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book master could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->BookMaster->read(null, $id);
		}
		$colors = $this->BookMaster->Color->find('list');
		$this->set(compact('colors'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException(__('Invalid book master'));
		}
		if ($this->BookMaster->delete()) {
			$this->Session->setFlash(__('Book master deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Book master was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
