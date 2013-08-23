<?php
App::uses('AppModel', 'Model');
/**
 * BookMaster Model
 *
 * @property Color $Color
 */
class VideoMaster extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'video_master';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(	
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'タイトルは必須項目です',
				//'allowEmpty' => false,
				//'required' => false,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength', 100),
				'message' => 'タイトルは100文字以上入力できません',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title_kana' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 300),
				'message' => 'タイトルかなは300文字以上入力できません',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),	
		'location' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 100),
				'message' => '格納場所は100文字以上入力できません',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	//　タイトル設定
	public function cutData($queryData) {
		$conditions = array();
		$_titles = array();
		
		if (!empty($queryData['conditions']['title'])) {
			// タイトルが入力されてる時
			// 半角スペースで統一
                	$queryData['conditions']['title'] = str_replace("　", " ", $queryData['conditions']['title']);
			// 半角スペースで区切る
			$_titles = explode(" ", $queryData['conditions']['title']);
			
			foreach($_titles as $_title) {
				$conditions['AND'][] = array('title LIKE' => '%'. $_title. '%');
			}
		}
		
		unset($queryData['conditions']['title']);

		$queryData['conditions'] = array_merge($queryData['conditions'], $conditions);

		return $queryData;
	}
	
	public function delete($id = null, $cascade = true) {
		// 0 破棄済み
		return $this->save(array('id' => $id, 'status' => '0'), false, array('id', 'status'));
	}
	
	public function afterFind($results, $primary = false) {
		$data = array();
		foreach($results as $result) {
			switch($result['VideoMaster']['status']) {
				case 0:
					$result['VideoMaster']['status'] = '破棄済み';
					break;
				case 1:
					$result['VideoMaster']['status'] = '閲覧可能';
					break;
				default:
					$result['VideoMaster']['status'] = '異常あり';
			}
			$data[] = $result;
		}
		return $data;
	}
}
