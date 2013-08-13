<?php
App::uses('AppModel', 'Model');
/**
 * BookMaster Model
 *
 * @property Color $Color
 */
class BookMaster extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'book_master';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'book_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'book_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'userdefined' => array(
				'rule' => array('userdefined'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'claim_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'book_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'book_kana' => array(
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'author_name' => array(
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'author_kana' => array(
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'publisher_name' => array(
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'publisher_kana' => array(
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'publication_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'inlist' => array(
				'rule' => array('inlist'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'page' => array(
			'naturalnumber' => array(
				'rule' => array('naturalnumber'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'annotation' => array(
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Color' => array(
			'className' => 'Color',
			'foreignKey' => 'color_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function beforeFind($queryData) {
		$queryData = $this->fairingYear($queryData);
		return $this->cutData($queryData);
	}

	// 発行年設定
	public function fairingYear($queryData) {
		$conditions = array();

		if (!empty($queryData['conditions']['publication_date_start']['year']) && !empty($queryData['conditions']['publication_date_end']['year'])) {
                        // 以上・以下が設定されてる時
			$start_year = $queryData['conditions']['publication_date_start']['year']. '-1-1';
			$end_year = $queryData['conditions']['publication_date_end']['year']. '-12-31';
			$conditions['publication_date BETWEEN ? AND ?'] = array($start_year , $end_year);
                } else if (!empty($queryData['conditions']['publication_date_start']['year'])) {
			// 以上が設定されてる時
			$conditions['publication_date >='] = $queryData['conditions']['publication_date_start']['year']. '-1-1';
		} else if (!empty($queryData['conditions']['publication_date_end']['year'])) {
			// 以下が設定されてる時
			$conditions['publication_date <='] = $queryData['conditions']['publication_date_end']['year']. '-12-31';
		}
		
		unset($queryData['conditions']['publication_date_start']);
		unset($queryData['conditions']['publication_date_end']);

                $queryData['conditions'] = array_merge($queryData['conditions'], $conditions);

                return $queryData;
	}

	//　蔵書名・著者名設定
	public function cutData($queryData) {
		$conditions = array();
		$_books = array();
		$_acthors = array();
		
		if (!empty($queryData['conditions']['book_name'])) {
			// 蔵書名が入力されてる時
			// 半角スペースで統一
                	$queryData['conditions']['book_name'] = str_replace("　", " ", $queryData['conditions']['book_name']);
			// 半角スペースで区切る
			$_books = explode(" ", $queryData['conditions']['book_name']);
			
			foreach($_books as $_book) {
				$conditions['AND'][] = array('book_name LIKE' => '%'. $_book. '%');
			}
		}

		if (!empty($queryData['conditions']['author_name'])) {
                        // 著者名が入力されてる時
                        // 半角スペースで統一
                        $queryData['conditions']['author_name'] = str_replace("　", " ", $queryData['conditions']['author_name']);
                        // 半角スペースで区切る
                        $_authors = explode(" ", $queryData['conditions']['author_name']);

                        foreach($_authors as $_author) {
                                $conditions['AND'][] = array('author_name LIKE' => '%'. $_author. '%');
                        }
                }	
		
		unset($queryData['conditions']['book_name']);
		unset($queryData['conditions']['author_name']);

		$queryData['conditions'] = array_merge($queryData['conditions'], $conditions);

		return $queryData;
	}
}
