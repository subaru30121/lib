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
			"rule" => array("naturalNumber", false),
                        "message" => "正しい年を入力してください",
                        "allowEmpty" => true
		)
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

	function myValidates() {
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
				return false;
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
                                return false;
                        }
                }
                $this->data['Search']['author_name'] = $_escape['author'];
		// 発行年のバリデート
		if (!$this->validates(array('fieldList' => array('publication_date_start', 'publication_date_end')))) {
			return false;
		}
		return true;
	}
}
?>
