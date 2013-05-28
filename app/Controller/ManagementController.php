<?php

// 図書管理用
// ユーザ管理・蔵書管理

class ManagementController extends AppController {
	
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
		
		// ログイン情報取得
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
		var_dump(AuthComponent::user());
	}

	// ログイン処理
	public function login(){
		$this->set("title_for_layout","Login");
		if (!empty($this->data)) {
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
	public function add() {
		// セレクトボックス生成
		$this->set('selectBox', $this->Group->find('list', array('fields'=>array('id','name'))));
		if (!empty($this->data)) {
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
			}
		}
	}
	
	// ユーザ一覧
	public function select_user() {
		$data = $this->User->find('all');
		$this->set('data',$data);
	}
	
	// グループ登録
	public function add_group() {
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
		$data = $this->Group->find('all');
		$this->set('data',$data);
	}
}
