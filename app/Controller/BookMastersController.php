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
                        $this->log('蔵書が見つからない:蔵書詳細', LOG_DEBUG);
                        $this->redirect(array('action' => 'index', 'controller' => 'management'));
                }
		$this->set('bookMaster', $this->BookMaster->read(null, $id));
	}

	// 蔵書追加
	public function add() {
		$this->set('title_for_layout', "蔵書追加");
		if ($this->Session->check('book_data')) {
			// すでにデータが有る場合補填する
			$this->request->data = $this->Session->read('book_data');
			$this->Session->delete('book_data');
		}
		if ($this->request->is('post')) {
/*
			if (!empty($this->request->data['Color']['code'])) {
				$this->Color->create();
				$this->Color->set($this->request->data['Color']);
				if ($this->Color->isUnique(array('code'))) {
					if ($this->Color->saveAll($this->request->data['Color'])) {
						$this->log('色の登録に成功', LOG_DEBUG);
						$this->request->data['BookMaster']['color_id'] = $this->Color->getLastInsertID();
					} else {
						$this->log('色の登録に失敗', LOG_DEBUG);
						$this->Session->setFlash('シールの色の登録に失敗しました。ご確認ください');
						return;
					}
				} else {
					$_color_data = $this->Color->find('first', array('conditions' => array('code' => $this->request->data['Color']['code'])));
					$this->request->data['BookMaster']['color_id'] = $_color_data['Color']['id'];
				}
			}
*/
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
		$colors = $this->Color->find('list');
		$colors = $this->Color->addStyle($colors); // 背景色付与

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
/*
			if (!empty($this->request->data['Color']['code'])) {
                                $this->Color->create();
                                $this->Color->set($this->request->data['Color']);
                                if ($this->Color->isUnique(array('code'))) {
                                        if ($this->Color->saveAll($this->request->data['Color'])) {
						$this->log('色の登録に成功しました', LOG_DEBUG);
                                        	$this->request->data['BookMaster']['color_id'] = $this->Color->getLastInsertID();
					} else {
						$this->log('色の登録に失敗しました', LOG_DEBUG);
						$this->Session->setFlash('シールの色の登録に失敗しました。ご確認ください');
						return;
					}
                                } else {
                                        $_color_data = $this->Color->find('first', array('conditions' => array('code' => $this->request->data['Color']['code'])));
                                        $this->request->data['BookMaster']['color_id'] = $_color_data['Color']['id'];
                                }
                        }
*/
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
			if ($this->Session->check('book_data')) {
                        	// すでにデータが有る場合補填する
                        	$this->request->data = $this->Session->read('book_data');
                        	$this->Session->delete('book_data');
                	} else {
				$this->request->data = $this->BookMaster->read(null, $id);
			}
		}
		$colors = $this->BookMaster->Color->find('list');
		$colors = $this->Color->addStyle($colors); // 背景色付与
		$this->set(compact('colors'));
	}

	// 確認画面
	public function confirm() {
		if (!$this->Session->check('book_data')) {
			// データがない場合はトップページへ
			$this->log('不正侵入：確認画面(book)', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		} else {
			$book_data = $this->Session->read('book_data');
		}
		// 色処理
		$this->Color->recursive = 0;
		if (!empty($book_data['BookMaster']['color_id'])) {
			$color = $this->Color->find('first', array('conditions' => array('id' => $book_data['BookMaster']['color_id'])));
			$book_data['Color']['code'] = $color['Color']['code'];
		} else {
			$book_data['Color']['code'] = null;
		}
		if (!empty($book_data['BookMaster']['color_id_2'])) {
                        $color = $this->Color->find('first', array('conditions' => array('id' => $book_data['BookMaster']['color_id_2'])));
                        $book_data['Color']['code_2'] = $color['Color']['code'];
                } else {
			$book_data['Color']['code_2'] = null;
		}
		$this->set('title_for_layout', "蔵書確認");
		$this->set('back', $this->Session->read('back_url'));
		$this->set('bookMaster', $book_data);

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
	
	// 点検初期化
	public function checking_init() {
		$this->autoRender = false;
		$this->Session->delete('check_data');
		$this->BookMaster->updateAll(array('check_flg' => 0));
		$this->Session->setFlash('点検データを初期化しました');
		$this->redirect(array('action' => 'checking'));		
	}

	// 点検
	public function checking() {
		$this->set('title_for_layout', "蔵書点検");
		if ($this->request->is('post')) {
			$this->BookMaster->recursive = -1;
			$_data = $this->BookMaster->find('first', array('conditions' => array('book_id' => $this->request->data['BookMaster']['book_id'])));
			if (!empty($_data)) {
                       		$_data['BookMaster']['check_flg'] = 1;
                        	if ($this->BookMaster->save($_data, false, array('check_flg'))) {
					$this->Session->write('check_data', $_data);
					$this->set('data', $_data);
					$this->request->data = null;
				} else {
					$this->Session->setFlash('点検が反映されませんでした');
				}
			} else {
				$this->Session->setFlash('該当する図書番号はありません');
			}
		}
	}
	
	// 点検キャンセル
	public function checking_return() {
		$this->autoRender = false;
		if (!$this->Session->check('check_data')) {
			$this->Session->setFlash('蔵書が見つかりませんでした');
		} else {
			$_data = $this->Session->read('check_data');
			$_data['BookMaster']['check_flg'] = 0;
			if ($this->BookMaster->save($_data, false, array('check_flg'))) {
				$this->Session->setFlash('キャンセルされました');
			} else {
				$this->Session->setFlash('キャンセルに失敗しました');
			} 
		}
		$this->redirect(array('action' => 'checking'));
	}

	// 点検一覧
	public function no_checked() {
                $this->set('title_for_layout', "蔵書一覧");
                $this->BookMaster->recursive = 0;
                $this->set('bookMasters', $this->paginate('BookMaster', array('check_flg' => '0')));
        }
}
