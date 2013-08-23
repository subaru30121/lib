<?php
App::uses('AppController', 'Controller');

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

	// 蔵書一覧(トップ)
	public function index() {
		$this->set('title_for_layout', "蔵書一覧");
		$this->BookMaster->recursive = 0;
		$this->set('bookMasters', $this->paginate('BookMaster'));
	}

	// 蔵書詳細
	public function view($id = null) {
		$this->set('title_for_layout', "蔵書詳細");
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException('蔵書は見つかりませんでした。');
		}
		$this->set('bookMaster', $this->BookMaster->read(null, $id));
	}

	// 蔵書追加
	public function add() {
		$this->set('title_for_layout', "蔵書追加");
		if ($this->Session->check('book_data')) {
			// すでにデータが有る場合補填する
			$this->request->data = $this->Session->read('book_data');
		}
		if ($this->request->is('post')) {
			if (!empty($this->request->data['Color']['code'])) {
				$this->Color->create();
				$this->Color->set($this->request->data['Color']);
				if ($this->Color->isUnique(array('code'))) {
					$this->Color->saveAll($this->request->data['Color']);
					$this->request->data['BookMaster']['color_id'] = $this->Color->getLastInsertID();
				} else {
					$_color_data = $this->Color->find('first', array('conditions' => array('code' => $this->request->data['Color']['code'])));
					$this->request->data['BookMaster']['color_id'] = $_color_data['Color']['id'];
				}
			}
			// 発行年の整形
			$this->request->data['BookMaster']['publication_date'] = $this->BookMaster->createYear($this->request->data['BookMaster']['publication_date']);
			// 分類の検索
			if (empty($this->request->data['BookMaster']['category'])) {
				$this->request->data['BookMaster']['category'] = $this->BookMaster->categorySearch($this->request->data['BookMaster']['claim_id']);
			}
			$this->BookMaster->create();
			$this->BookMaster->set($this->request->data['BookMaster']);
			if ($this->BookMaster->validates()) {
				// 確認画面へ
				$this->Session->write('book_data', $this->request->data);
				$this->Session->write('back_url', 'add');
				$this->redirect(array('action' => 'confirm'));
			} else {
				$this->Session->setFlash('登録情報に不備があります。該当箇所を確認してください。');
			}
		}
		$colors = $this->BookMaster->Color->find('list');
		$this->set(compact('colors'));
	}

	// 蔵書編集
	public function edit($id = null) {
		$this->set('title_for_layout', "蔵書編集");
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			$this->log('蔵書が見つからない:蔵書編集', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		$this->request->data['BookMaster']['id'] = $id;
		if ($this->request->is('post') || $this->request->is('put')) {
			if (!empty($this->request->data['Color']['code'])) {
                                $this->Color->create();
                                $this->Color->set($this->request->data['Color']);
                                if ($this->Color->isUnique(array('code'))) {
                                        $this->Color->saveAll($this->request->data['Color']);
                                        $this->request->data['BookMaster']['color_id'] = $this->Color->getLastInsertID();
                                } else {
                                        $_color_data = $this->Color->find('first', array('conditions' => array('code' => $this->request->data['Color']['code'])));
                                        $this->request->data['BookMaster']['color_id'] = $_color_data['Color']['id'];
                                }
                        }
			// 分類の検索
                        if (empty($this->request->data['BookMaster']['category'])) {
                                $this->request->data['BookMaster']['category'] = $this->BookMaster->categorySearch($this->request->data['BookMaster']['claim_id']);
                        }
			$this->BookMaster->create();
			$this->BookMaster->set($this->request->data['BookMaster']);
			if ($this->BookMaster->validates()) {
				// 確認画面へ
                                $this->Session->write('book_data', $this->request->data);
                                $this->Session->write('back_url', 'edit/'. $id);
                                $this->redirect(array('action' => 'confirm'));
			} else {
				$this->Session->setFlash('登録情報に不備があります。該当箇所を確認してください。');
			}
		} else {
			$this->request->data = $this->BookMaster->read(null, $id);
		}
		$colors = $this->BookMaster->Color->find('list');
		$this->set(compact('colors'));
	}

	// 確認画面
	public function confirm() {
		if (!$this->Session->check('book_data')) {
			// データがない場合はトップページへ
			$this->log('不正侵入：確認画面(book)', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		$this->set('title_for_layout', "蔵書確認");
		$this->set('back', $this->Session->read('back_url'));
		$this->set('bookMaster', $this->Session->read('book_data'));
	}

	// 蔵書登録
	public function book_save() {
		if (!$this->Session->check('book_data')) {
                        // データがない場合はトップページへ
                        $this->log('不正侵入：登録処理(book)', LOG_DEBUG);
                        $this->redirect(array('action' => 'index', 'controller' => 'management'));
                }
		// Viewは使わない
		$this->autoRender = false;
		if ($this->BookMaster->save($this->Session->read('book_data'))) {
			$message = "以下の内容で登録\n";
			$message .= print_r($this->Session->read('book_data'), true);
			$this->log("$message", LOG_DEBUG);
			$this->Session->delete('book_data');
			$this->Session->setFlash('登録に成功しました');
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		} else {
			$message = "以下の内容で登録に失敗\n";
			$message .= print_r($this->Session->read('book_data'), true);
			$this->log("$message", LOG_DEBUG);
			$this->Session->setFlash('登録に失敗しました。もう一度試してみてください');
			$this->redirect(array('action' => 'confirm'));
		}
	}

	// 論理削除
	public function delete($id = null) {
		$this->set('title_for_layout', "蔵書破棄");
		if (!$this->request->is('post')) {
			$this->log('不正侵入:削除処理(book)', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			$this->log('蔵書が見つからない:削除処理(book)', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		if ($this->BookMaster->delete($id)) {
			$message = $id. "番の蔵書を削除状態にしました";
			$this->log("$message", LOG_DEBUG);
			$this->Session->setFlash('蔵書は削除されました');
			$this->redirect(array('action' => 'index'));
		} else {
			$message = $id. "番の蔵書を削除状態にできませんでした";
			$this->log("$message" , LOG_DEBUG);
			$this->Session->setFlash('蔵書は削除されませんでした。データを確認の上もう一度削除してください。');
			$this->redirect(array('action' => 'index'));
		}
	}
}
