<?php
App::uses('AppModel', 'Model');
class Search extends AppModel{
	public $name = 'Search';
        public $useTable = false;

        public  $validate = array(
        	"book_name"=>array(
                	"rule" => array("maxLength", 100),
                        "message" => "一つの言葉は100文字までです",
			"allowEmpty" => true
		),
		"author_name"=>array(
			"rule" => array("maxLength", 100),
			"message" => "一つの言葉は100文字までです",
			"allowEmpty" => true
		),
		"publication_date_start"=>array(
			"rule" => array("naturalNumber", false),
			"message" => "正しい年を入力してください",
			"allowEmpty" => true
		),
		"publication_date_end" => array(
			"Nomal" => array(
				"rule" => array("naturalNumber", false),
                        	"message" => "正しい年を入力してください",
                        	"allowEmpty" => true,
				"last" => true
			),
			"Custom" => array(
				"rule" => "rangeCheck",
				"message" => "発行年の範囲が正しくありません",
			)
		),
		"title"=>array(
                        "rule" => array("maxLength", 100),
                        "message" => "一つの言葉は100文字までです",
                        "allowEmpty" => true
                ),
	);
		
	function changeYear() {
		if (empty($this->data['Search']['publication_date_start']['year'])) {
			$this->data['Search']['publication_date_start']['year'] = "";
		}
		if (empty($this->data['Search']['publication_date_end']['year'])) {
			$this->data['Search']['publication_date_end']['year'] = "";
		}
		$this->data['Search']['publication_date_start'] = $this->data['Search']['publication_date_start']['year'];
		$this->data['Search']['publication_date_end'] = $this->data['Search']['publication_date_end']['year'];
		return $this->data['Search'];
	}
	
	// バリデーションで使用
	public function rangeCheck() {
		// 発行年以上・以下が設定されてる時作動
		if (!empty($this->data['Search']['publication_date_start']) && !empty($this->data['Search']['publication_date_end'])) {
			if ($this->data['Search']['publication_date_start'] > $this->data['Search']['publication_date_end']) {
				// 「以上」が「以下」未満だった場合
				return false;
			} 
		}
		return true;
	}

	function myValidates() {
		// バリデートフラグ
		$_flg = true;
		// 分解後のデータ用
		$_books = array();
		$_authors = array();
		// 元々のデータの避難用
		$_escape = array();
		// 蔵書名のバリデート
		$_escape['book'] = $this->data['Search']['book_name'];
		$this->data['Search']['book_name'] = str_replace("　", " ", $this->data['Search']['book_name']);
		$_books = explode(" ", $this->data['Search']['book_name']);
		foreach($_books as $_book) {
			$this->data['Search']['book_name'] = $_book; 
			if (!$this->validates(array('fieldList' => array('book_name')))) {
				$this->data['Search']['book_name'] = $_escape['book'];
				LogError("蔵書名検索ワードエラー:". $_book);
				$_flg = false;
				break;
			}
		}
		$this->data['Search']['book_name'] = $_escape['book'];
		// 著者のバリデート
		$_escape['author'] = $this->data['Search']['author_name'];
                $this->data['Search']['author_name'] = str_replace("　", " ", $this->data['Search']['author_name']);
                $_authors = explode(" ", $this->data['Search']['author_name']);
                foreach($_authors as $_author) {
                        $this->data['Search']['author_name'] = $_author;
                        if (!$this->validates(array('fieldList' => array('author_name')))) {
                                $this->data['Search']['author_name'] = $_escape['author'];
				LogError("著者名検索ワードエラー");
                                $_flg = false;
				break;
                        }
                }
                $this->data['Search']['author_name'] = $_escape['author'];
		// 発行年のバリデート
		if (!$this->validates(array('fieldList' => array('publication_date_start', 'publication_date_end')))) {
			$_flg = false;
		}
		
		return $_flg;
	}
	
	function titleValidate() {
		$_flg = true;
		// 分解後のデータ用
		$_titles = array();
		// 元々のデータの避難用
                $_escape = array();

		// 蔵書名のバリデート
                $_escape['title'] = $this->data['Search']['title'];
                $this->data['Search']['title'] = str_replace("　", " ", $this->data['Search']['title']);
                $_titles = explode(" ", $this->data['Search']['title']);
                foreach($_titles as $_title) {
                        $this->data['Search']['title'] = $_title;
                        if (!$this->validates(array('fieldList' => array('title')))) {
                                $this->data['Search']['title'] = $_escape['title'];
                                LogError("タイトル検索ワードエラー:". $_title);
                                $_flg = false;
                                break;
                        }
                }
                $this->data['Search']['title'] = $_escape['title'];
		
		return $_flg;
	}
}
?>
