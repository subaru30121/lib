<?php
App::uses('AppController', 'Controller');

class VideoMastersController extends AppController {

	public $name = "VideoMasters";
	
	// モデル指定
	public $uses = array('VideoMaster');

	// ヘルパー指定
	// public $helpers = array('Time');

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

	// 映像一覧(トップ)
	public function index() {
		$this->set('title_for_layout', "映像一覧");
		$this->VideoMaster->recursive = 0;
		$this->set('videoMasters', $this->paginate('VideoMaster'));
	}

	// 映像詳細
	public function view($id = null) {
		$this->set('title_for_layout', "映像詳細");
		$this->VideoMaster->id = $id;
		if (!$this->VideoMaster->exists()) {
			$this->log('映像が見つからない：映像詳細', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		$this->set('videoMaster', $this->VideoMaster->read(null, $id));
	}

	// 映像追加
	public function add() {
		$this->set('title_for_layout', "映像追加");
		if ($this->Session->check('video_data')) {
			// すでにデータが有る場合補填する
			$this->request->data = $this->Session->read('video_data');
		}
		if ($this->request->is('post')) {
			$this->VideoMaster->create();
			$this->VideoMaster->set($this->request->data['VideoMaster']);
			if ($this->VideoMaster->validates()) {
				// 確認画面へ
				$this->Session->write('video_data', $this->request->data);
				$this->Session->write('back_url', 'add');
				$this->redirect(array('action' => 'confirm'));
			} else {
				$this->Session->setFlash('登録情報に不備があります。該当箇所を確認してください。');
			}
		}
	}

	// 映像編集
	public function edit($id = null) {
		$this->set('title_for_layout', "映像編集");
		$this->VideoMaster->id = $id;
		if (!$this->VideoMaster->exists()) {
			$this->log('映像が見つからない：映像編集', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		$this->request->data['VideoMaster']['id'] = $id;
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->VideoMaster->create();
			$this->VideoMaster->set($this->request->data['VideoMaster']);
			if ($this->VideoMaster->validates()) {
				// 確認画面へ
                                $this->Session->write('video_data', $this->request->data);
                                $this->Session->write('back_url', 'edit/'. $id);
                                $this->redirect(array('action' => 'confirm'));
			} else {
				$this->Session->setFlash('登録情報に不備があります。該当箇所を確認してください。');
			}
		} else {
			if ($this->Session->check('video_data')) {
                                // すでにデータが有る場合補填する
                                $this->request->data = $this->Session->read('video_data');
                                $this->Session->delete('video_data');
                        } else {
                                $this->request->data = $this->VideoMaster->read(null, $id);
                        }
		}
	}

	// 確認画面
	public function confirm() {
		if (!$this->Session->check('video_data')) {
			// データがない場合はトップページへ
			$this->log('不正侵入：確認画面(video)', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		$this->set('title_for_layout', "映像確認");
		$this->set('back', $this->Session->read('back_url'));
		$this->set('videoMaster', $this->Session->read('video_data'));
	}

	// 映像登録
	public function save() {
		if (!$this->Session->check('video_data')) {
                        // データがない場合はトップページへ
                        $this->log('不正侵入：登録処理(video)');
                        $this->redirect(array('action' => 'index', 'controller' => 'management'));
                }
		// Viewは使わない
		$this->autoRender = false;
		if ($this->VideoMaster->save($this->Session->read('video_data'))) {
			$message = "「". AuthComponent::user('username'). "」が以下の内容で登録\n";
			$message .= print_r($this->Session->read('video_data'), true);
			$this->log("$message", LOG_DEBUG);
			$this->Session->delete('video_data');
			$this->Session->setFlash('登録に成功しました');
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		} else {
			$message = "「". AuthComponent::user('username'). "」が以下の内容で登録に失敗\n";
			$message .= print_r($this->Session->read('video_data'), true);
			$this->log("$message", LOG_DEBUG);
			$this->Session->setFlash('登録に失敗しました。もう一度試してみてください');
			$this->redirect(array('action' => 'confirm'));
		}
	}

	// 論理削除
	public function delete($id = null) {
		$this->set('title_for_layout', "映像破棄");
		if (!$this->request->is('post')) {
			$this->log('不正侵入:削除処理(video)', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		$this->Video->id = $id;
		if (!$this->Video->exists()) {
			$this->log('映像が見つからない:削除処理', LOG_DEBUG);
			$this->redirect(array('action' => 'index', 'controller' => 'management'));
		}
		if ($this->Video->delete($id)) {
			$message = "「". AuthComponent::user('username'). "」が".$id. "番の映像を削除状態にしました";
			$this->log("$message", LOG_DEBUG);
			$this->Session->setFlash('映像は削除されました');
			$this->redirect(array('action' => 'index'));
		} else {
			$message = "「". AuthComponent::user('username'). "」が".$id. "番の映像を削除状態にできませんでした";
			$this->log("$message");
			$this->Session->setFlash('映像は削除されませんでした。データを確認の上もう一度削除してください。');
			$this->redirect(array('action' => 'index'));
		}
	}
}
