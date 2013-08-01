<?php
App::uses('AppController', 'Controller');
// 一般公開用
// 図書一覧


class LibraryController extends AppController {
	
	// 使用するモデル
	public $uses = array('BookMaster', 'Search');

	// 認証処理が行われる前の処理
	public function beforeFilter() {
		// Auth関連
		$this->Auth->allow('*');
	}
	
	public function index() {
		$this->set('title_for_layout', "検索ページ");
		if (!empty($this->request->data['bookMaster'])) {
			// 蔵書条件が入力された時
			$this->Search->create();
			$this->Search->set($this->data['bookMaster']);
			// 年の配列解除
			$this->Search->changeYear();

			if($this->Search->myValidates()) {
				$this->Session->write('search_condition', $this->request->data);
				$this->redirect(array('action' => 'summary'));
			}
		}
	}

	// 検索結果一覧
	public function summary() {

	}
}
