<?php

namespace Admin\Controller;

use Think\Controller;

class MainController extends Controller {

	public function index() {
		if (! isset ( $_SESSION ['username'] )) {
			$this->redirect ( '/' );
		} else {	
			$this->assign ( 'username', $_SESSION ['username'] );
			$this->display ();
		}
	}
}