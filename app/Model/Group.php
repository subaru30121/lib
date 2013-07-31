<?php

	class Group extends AppModel{
		
		public $name = 'Group';
		public $actsAs = array('Acl' => 'requester');
		
		public	$validate = array(
			"name"=>array(
				"required"=>array(
					"rule"=>array("notEmpty"),
					"message"=>"グループ名を入力してください。",
					"last" => true
				),
				"maxLength" => array(
					"rule" => array("maxLength", 30),
					"message" => "グループ名は128文字までです"
				),
				"isUnique" => array(
					"rule" => "isUnique",
					"message" => "このグループ名は使用されています"
				)
			)
		);
		
		function parentNode() {
			return null;
		}
	}
?>
