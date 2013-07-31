<?php

	class User extends AppModel{
		
		public $name = 'User';
		public $belongsTo = array('Group');
		public $actsAs = array('Acl' => 'requester');
		
		public	$validate = array(
			"username"=>array(
				"required"=>array(
					"rule"=>array("notEmpty"),
					"message"=>"ユーザ名を入力してください。",
					"last" => true
				),
				"maxLength" => array(
					"rule" => array("maxLength", 128),
					"message" => "ユーザ名は128文字までです"
				),
				"isUnique" => array(
					"rule" => "isUnique",
					"message" => "このユーザ名は使用されています"
				)
			),
			"new_password"=>array(
				"required"=>array(
					"rule"=>array("notEmpty"),
					"message"=>"パスワードを入力してください。",
					"last" => true
				)
			),
			"confirm_password"=>array(
				"required"=>array(
					"rule"=>array("notEmpty"),
					"message"=>"パスワードを入力してください。",
					"last" => true
				),
				"correspond"=>array(
					"rule"=>array("correspond"),
					"message"=>array("パスワードが一致しません")
				)
			)
		);
		
		// パスワードチェック
		public function correspond($check) {
			return ($check["confirm_password"] == $this->data["User"]["new_password"]);
		}
		
		// パスワードのハッシュ化
		//保存前にハッシュ値変換を行います
		public function beforeSave($options=array()) {
				if (isset($this->data[$this->alias]['password'])) {
				$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
			}
			return true;
		}
		
		function parentNode() {
			if (!$this->id && empty($this->data)) {
				return null;
			}
			$data = $this->data;
			if (empty($this->data)) {
				$data = $this->read();
			}
			if (!$data['User']['group_id']) {
				return null;
			} else {
				return array('Group' => array('id' => $data['User']['group_id']));
			}
		}
		
		// パスワードのバリデート無効化
		public function passwordValidateChange() {
			$this->validator()->remove('new_password');
			$this->validator()->remove('confirm_password');
		}
		
		// ユーザ名のバリデート変更
		public function usernameValidateChange() {
			$this->validator()->remove('username', 'isUnique');
		}
	}
?>
