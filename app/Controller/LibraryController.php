<?php
App::uses('AppController', 'Controller');
// 一般公開用
// 図書一覧


class LibraryController extends AppController {
	
	// 使用するモデル
	public $uses = array('BookMaster', 'Search', 'VideoMaster');

	// 認証処理が行われる前の処理
	public function beforeFilter() {
		// Auth関連
		$this->Auth->allow('*');
	}
	
	public function index() {
		$this->set('title_for_layout', "検索ページ");
		if (!empty($this->request->data['BookMaster'])) {
			//$this->log("test2", LOG_DEBUG);
			// 蔵書条件が入力された時
			$this->Search->create();
                        $this->Search->set($this->data['BookMaster']);
                        // 年の配列解除
                        $this->request->data['Search'] = $this->Search->changeYear();

                        if($this->Search->myValidates()) {
                                // 入力が正常な場合
				$this->Session->write('search_condition', $this->request->data);
				$this->Session->write('search_flg', true);
				$this->redirect(array('action' => 'summary'));
			} else {
				$this->Session->write('search_flg', false);
			}
		}
		// 検索許可フラグ
		$this->Session->write('search_flg', false);
	}

	// 検索結果一覧
	public function summary() {
		$this->set('title_for_layout', "一覧ページ");
		// 検索条件の設定
		if (empty($this->request->data['BookMaster']) && $this->Session->check('search_condition')) {
			// 条件が変わっていない場合
			$this->request->data = $this->Session->read('search_condition');
		}

		if (!empty($this->request->data['BookMaster']) && $this->Session->read('search_condition') != $this->request->data) {
			// 条件が変わった場合
			// ページネイト条件のリセット
			$this->request->params['named'] = array();
                        $this->Search->create();
                        $this->Search->set($this->data['BookMaster']);
                        // 年の配列解除
                        $this->request->data['Search'] = $this->Search->changeYear();

                        if(!$this->Search->myValidates()) {
                                // 入力が正常な場合
                                $this->Session->setFlash('異常な検索を検知しました。');
				$this->redirect(array('action' => 'index'));
                        }
		}
		$this->BookMaster->recursive = 0;
		$this->set('bookMasters', $this->paginate('BookMaster', $this->request->data['BookMaster']));
	}

	// 蔵書詳細
	public function view($id = null) {
		if ($this->request->is('post')) {
			// 検索フォームが使用された場合
			$this->setAction('index');
		}
		$this->set('title_for_layout', "詳細ページ");
                $this->BookMaster->id = $id;
                if (!$this->BookMaster->exists()) {
                        LogError("詳細ページで不正なIDが指定されました");
			$this->redirect(array('action' => 'index'));
                }
                $this->set('bookMaster', $this->BookMaster->read(null, $id));
        }

	// 映像検索
	public function index_video() {
                $this->set('title_for_layout', "映像検索");
                if (!empty($this->request->data['VideoMaster'])) {
                        // 蔵書条件が入力された時
                        $this->Search->create();
                        $this->Search->set($this->data['VideoMaster']);

                        if($this->Search->titleValidate()) {
                                // バリデートに引っかかった場合
                                $this->Session->write('search_condition', $this->request->data);
                                $this->Session->write('search_flg', true);
                                $this->redirect(array('action' => 'summary_video'));
                        } else {
                                $this->Session->write('search_flg', false);
                        }
                }
                // 検索許可フラグ
                $this->Session->write('search_flg', false);
        }

	// 映像一覧
        public function summary_video() {
                $this->set('title_for_layout', "映像一覧");
                // 検索条件の設定
                if (empty($this->request->data['VideoMaster']) && $this->Session->check('search_condition')) {
                        // 条件が変わっていない場合
                        $this->request->data = $this->Session->read('search_condition');
                }

                if (!empty($this->request->data['VideoMaster']) && $this->Session->read('search_condition') != $this->request->data) {
                        // 条件が変わった場合
                        $this->setAction('index_video');
                }

                $this->VideoMaster->recursive = 0;
                $this->set('videoMasters', $this->paginate('VideoMaster', $this->request->data['VideoMaster']));
        }

        // 映像詳細
        public function view_video($id = null) {
                if ($this->request->is('post')) {
                        // 検索フォームが使用された場合
                        $this->setAction('index_video');
                }
                $this->set('title_for_layout', "映像詳細");
                $this->VideoMaster->id = $id;
                if (!$this->VideoMaster->exists()) {
                        LogError("詳細ページで不正なIDが指定されました");
                        $this->redirect(array('action' => 'index'));
                }
                $this->set('videoMaster', $this->VideoMaster->read(null, $id));
        }
}
