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
		if (!empty($this->request->data['BookMaster'])) {
			// 蔵書条件が入力された時
			$this->Search->create();
			$this->Search->set($this->data['BookMaster']);
			// 年の配列解除
			$this->request->data['Search'] = $this->Search->changeYear();

			if($this->Search->myValidates()) {
				$this->Session->write('search_condition', $this->request->data);
				$this->redirect(array('action' => 'summary'));
			}
		}
	}

	// 検索結果一覧
	public function summary() {
		$this->set('title_for_layout', "一覧ページ");
		// 検索条件の設定
		if (empty($this->request->data) && $this->Session->check('search_condition')) {
			$this->request->data = $this->Session->read('search_condition');
		}

		if (!empty($this->request->data)) {
			$this->Session->write('search_condition', $this->request->data);
		}

		$this->BookMaster->recursive = 0;
		$this->set('bookMasters', $this->paginate('BookMaster', $this->request->data['BookMaster']));
	}

	// 蔵書詳細
	public function view($id = null) {
		$this->set('title_for_layout', "詳細ページ");
                $this->BookMaster->id = $id;
                if (!$this->BookMaster->exists()) {
                        LogError("詳細ページで不正なIDが指定されました");
			$this->redirect(array('action' => 'index'));
                }
                $this->set('bookMaster', $this->BookMaster->read(null, $id));
        }
}
