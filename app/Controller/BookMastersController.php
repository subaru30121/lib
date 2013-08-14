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
		$this->set('title_for_layout', "蔵書一覧");
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
		$this->set('title_for_layout', "蔵書詳細");
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException('蔵書は見つかりませんでした。');
		}
		$this->set('bookMaster', $this->BookMaster->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout', "蔵書追加");
		if ($this->request->is('post')) {
			$this->Color->create();
			$this->Color->set($this->request->data['Color']);
			if ($this->Color->isUnique(array('code'))) {
				$this->Color->saveAll($this->request->data['Color']);
				$this->request->data['BookMaster']['color_id'] = $this->Color->getLastInsertID();
			}
			$this->BookMaster->create();
			if ($this->BookMaster->saveAll($this->request->data['BookMaster'])) {
				$this->Session->setFlash('登録に成功しました。');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('蔵書登録に失敗しました。登録事項を確認の上もう一度登録してください。');
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
		$this->set('title_for_layout', "蔵書編集");
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException('蔵書は見つかりませんでした');
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BookMaster->save($this->request->data)) {
				$this->Session->setFlash('蔵書データの更新は成功しました');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('蔵書データの更新に失敗しました。入力事項を確認の上もう一度登録してください。');
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
		$this->set('title_for_layout', "蔵書破棄");
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
