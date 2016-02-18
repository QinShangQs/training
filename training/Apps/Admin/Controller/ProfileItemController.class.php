<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Repository\ProfileItemRepository;
use Admin\Repository\BaseRepository;

class ProfileItemController extends Controller {
	private $_profileItemRepository;
	public function __construct() {
		parent::__construct ();
		$this->_profileItemRepository = new ProfileItemRepository();
	}
	
	public function index(){
		$this->assign ( "productItems", $this->_profileItemRepository->findAll ( BaseRepository::PRO_PRODUCT ) );
		$this->assign ( "uiItems", $this->_profileItemRepository->findAll ( BaseRepository::PRO_UI ) );
		$this->display();
	}
	
	public function doEdit($p){
		$datas = array();
		foreach ($_REQUEST as $key=>$val){
			$parts = explode('_', $key);
			if(count($parts) == 2){			
				$datas[$parts[0]]['id'] = $parts[0];
				if($parts[1] == 'title'){
					$datas[$parts[0]]['title'] = $val;
				}else if($parts[1] == 'content'){
					$datas[$parts[0]]['content'] = $val;
				}
			}
		}
		
		foreach ($datas as $key=>$val){
			$this->_profileItemRepository->save($val['id'], $val['title'], $val['content']);
		}
		
		$this->success('保存成功！','index');
	}
}