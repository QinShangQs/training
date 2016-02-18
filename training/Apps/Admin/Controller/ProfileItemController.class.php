<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\ProfileItemRepository;

class ProfileItemController extends Controller {
	private $_profileItemRepository;
	public function __construct() {
		parent::__construct ();
		$this->_profileItemRepository = new ProfileItemRepository();
	}
	
	public function index(){
		$this->display();
	}
}