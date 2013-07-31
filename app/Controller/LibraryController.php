<?php

// 一般公開用
// 図書一覧

class LibraryController extends AppController {
	
	// 認証処理が行われる前の処理
	public function beforeFilter() {
		// Auth関連
		$this->Auth->allow('*');
	}
	
	public function index() {
		$this->set('title_for_layout', "トップページ");
	}
}
