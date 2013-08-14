<?php

// 図書管理用
// ユーザ管理・蔵書管理

App::import('Controller', 'App');

class ManagementController extends AppController {
	
	public $name = "Management";
	
	// モデル指定
	public $uses = array('User', 'Group');
	
	// 認証処理が行われる前の処理
	public function beforeFilter() {
		// レイアウト変更
		$this->layout = 'management';
		// Auth関連
		$this->Auth->allow('login');
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
	
	// 初期画面
	function index() {
		$this->set('title_for_layout', "管理ページ");
	}

	// ログイン処理
	public function login(){
		$this->set("title_for_layout","ログイン");
		if (!empty($this->request->data)) {
			if($this->Auth->login()){
				return	$this->redirect($this->Auth->redirect());
			}else{
				$this->Session->setFlash(__("ユーザ名かパスワードが違います"),"default",array(),"auth");
			}
		}
	}
	
	// ログアウト処理
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	// ユーザー登録
	public function add_user() {
		$this->set('title_for_layout', "ユーザ登録");
		// セレクトボックス生成
		$this->set('selectBox', $this->Group->find('list', array('fields'=>array('id','name'))));
		if (!empty($this->request->data)) {
			// モデルにデータをセット
			$this->User->create($this->request->data['User']);
			// バリデート
			if (!$this->User->validates()) {return;}
			// パスワードの置き換え
			$this->request->data["User"]["password"] = $this->request->data["User"]["new_password"];
			// DBへ登録
			if ($this->User->save($this->request->data['User'], false)) {
				// 成功した場合
				$this->Session->setFlash(__('登録を完了しました'));
				$this->redirect('./index');
			} else {
				// 失敗した場合
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}
	}
	
	// ユーザ一覧
	public function select_user() {
		$this->set('title_for_layout', "ユーザ一覧");
		$data = $this->User->find('all');
		$this->set('data',$data);
	}
	
	// ユーザ編集
	public function change_user() {
		$this->set('title_for_layout', "ユーザ編集");
		if (!preg_match('/^[1-9][0-9]*$/', $this->params['url']['user_id'])) {
			// 変なもんだったら一覧に戻す
			$this->redirect('./select_user');
		}
		// セレクトボックス生成
		$this->set('selectBox', $this->Group->find('list', array('fields'=>array('id','name'))));
		// ユーザ情報取り出し
		$userData = $this->User->find('all', array('conditions' => array('User.id' => $this->params['url']['user_id'])));
		
		if (!empty($this->request->data)) {
			// モデルにデータをセット
			$this->User->create($this->request->data['User']);
			// パスワードチェック
			if (empty($this->request->data['User']['new_password']) && empty($this->request->data['User']['confim_password'])) {
				// パスワードが設定されていない場合バリデートしない
				$this->User->passwordValidateChange();
			}
			// ユーザ名チェック
			if ($this->request->data['User']['username'] == $userData[0]['User']['username']) {
				// ユーザ名が変わってない場合ユニークチェックしない
				$this->User->usernameValidateChange();
			}
			// バリデート
			if (!$this->User->validates()) {return;}
			// パスワードチェック
			if (empty($this->request->data['User']['new_password']) && empty($this->request->data['User']['confim_password'])) {
				// パスワードが設定されていない場合
				// フィールド設定
				$fields = array('username', 'group_id');
			} else {
				// パスワードが設定されてる場合
				// パスワードの置き換え
				$this->request->data["User"]["password"] = $this->request->data["User"]["new_password"];
				// フィールド設定
				$fields = array('username', 'password', 'group_id');
			}
			// ID追加
			$this->request->data['User']['id'] = $userData[0]['User']['id'];
			// DBへ登録
			if ($this->User->save($this->request->data['User'], false, $fields)) {
				// 成功した場合
				$this->Session->setFlash(__('登録を完了しました'));
				$this->redirect('./select_user');
			} else {
				// 失敗した場合
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		} else {
			// viewに反映
			$this->request->data = $userData[0];
		}
	}
	
	// ユーザ削除
	public function delete_user($id) {
		$this->set('title_for_layout', "ユーザ削除");
		if ($this->request->is('get')) {
			throw new MethoudNotAllowedException();
		}
		$fields = array('group_id');
		$data = array('id' => $id, 'group_id' => 3);
		if ($this->User->save($data, false, $fields)) {
			$this->Session->setFlash(__('削除されました'));
			$this->redirect('./select_user');
		}
	}
	
	// グループ登録
	public function add_group() {
		$this->set('title_for_layout', "グループ登録");
		if (!empty($this->data)) {
			// DBへ登録
			if ($this->Group->save($this->request->data['Group'])) {
				// 成功した場合
				$this->Session->setFlash(__('登録を完了しました'));
				$this->redirect('./index');
			}
		}
	}
	
	// グループ一覧
	public function select_group() {
		$this->set('title_for_layout', "グループ一覧");
		$data = $this->Group->find('all');
		$this->set('data',$data);
	}
}
