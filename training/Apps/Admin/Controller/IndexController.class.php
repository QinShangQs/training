<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index() {		
		if (! isset ( $_SESSION ['username'] )) {
			$this->display ();
		} else {
			$this->redirect ( 'main/index' );
		}
	}
	public function login() {
		if (! IS_POST)
			exit;
		$username = I ( 'userName' );
		$password = I ( 'password', '', 'md5' );
		
		if ($username != 'admin') {
			$this->error ( '用户不存在' );
		} else if ($password != md5 ( '123' )) {
			$this->error ( '密码错误!' );
		} else {
			$_SESSION ['username'] = $username;
			$_SESSION ['expiretime'] = time () + 3600;
			$this->redirect ( 'main:index' );
		}
	}
	public function ajaxCheckLogin() {
		if (! isset ( $_SESSION ['username'] )) {
			unset ( $_SESSION ['username'] );
			unset ( $_SESSION ['expiretime'] );
			echo json_encode ( array (
					'success' => false 
			) );
		} else {
			echo json_encode ( array (
					'success' => true 
			) );
		}
	}
	public function logout() {
		if (! empty ( $_SESSION ['username'] )) {
			unset ( $_SESSION ['username'] );
			unset ( $_SESSION ['expiretime'] );
			$_SESSION = array ();
			session_destroy ();
			$this->redirect ( "/" );
		} else {
			$this->error ( '已经登出了！', '/' );
		}
	}
}