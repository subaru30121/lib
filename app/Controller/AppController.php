<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	// コンポネート指定
	public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session'
    );
	// ヘルパー読み込み
	public $helpers = array('Html', 'Form', 'Session');
	
	// 認証処理が行われる前の処理
	public function beforeFilter() {
		// ACLにログインしてるとき
		$this->Auth->loginAction = array('controller' => '../../management', 'action' => 'login');
		// ログイン情報取得
		$loginUser = $this->Auth->user();
		if (!empty($loginUser)) {
			// ログインしている場合
			$this->Auth->authError = 'アクセス権がありません';
		} else {
			// ログインしていない場合
			$this->Auth->authError = 'ログインしてください';
		}
		$this->Auth->loginError = 'ログインに失敗しました。';
	}
}
