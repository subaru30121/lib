<?php
App::uses('AppModel', 'Model');
/**
 * Login Model
 *
 * @property User $User
 */
class Login extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'login';
	
	public $name = 'Login';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	// ログイン時ログ
	public function login_log() {
		$message = "「". AuthComponent::user('username'). "」がログインしました";
                $this->log("$message", LOG_DEBUG);	
		$data = array('user_id' => AuthComponent::user('id'), 'date' => date('y-m-d H:i:s'));
		if ($this->save($data)) {
			$message = "ログイン履歴を更新しました";
		} else {
			$message = "ログイン履歴が更新されませんでした";
		}
		$this->log("$message", LOG_DEBUG);
		return;
	}

	public function beforeFind($query) {
		// 現在ログインしているユーザID
		$id = AuthComponent::user('id');
		$query['conditions'] = array('user_id' => $id);
		// 5件まで表示
		$query['limit'] = 5;
		// 最新のものから表示
		$query['order'] = array('Login.date' => 'desc');
		return $query;
	}
}
