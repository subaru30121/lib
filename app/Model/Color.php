<?php
App::uses('AppModel', 'Model');
/**
 * Color Model
 *
 * @property BookMaster $BookMaster
 */
class Color extends AppModel {
	
	public $useTable = 'color';
	
	public $displayField = 'code';
	
	public $validate = array(
		'code' => array(
			'custom' => array(
				'rule' => array('custom', '/^#[a-zA-Z0-9]{6}$/'),
				'message' => '色コードを入力してください',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'BookMaster' => array(
			'className' => 'BookMaster',
			'foreignKey' => 'color_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	* function addStyle
	*
	* selectboxの背景を追加
	* find('list')のあとに呼ぶ
	*/
	public function addStyle($data) {
		$results = array();
		foreach($data as $key => $value) {
			$result = array();
			$result['name'] = $value;
			$result['value'] = $key;
			$result['style'] = 'background-color:'. $value;
			$results[] = $result;
		}
		return $results;
	}

}
