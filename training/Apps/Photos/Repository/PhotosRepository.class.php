<?php

namespace Photos\Repository;

class PhotosRepository{
	private $_repository = null;
	public function __construct(){
		$this->_repository = M('Photos');
	}
	
	public function getById($id){
		return $this->_repository->getById($id);
	}
	
	public function add($img_name,$img_path, $img_desc = ''){
		$instance = new \stdClass();
		$instance->img_name = $img_name;
		$instance->img_path = $img_path;
		$instance->img_desc = $img_desc;
		return $this->_repository->data($instance)->add();		
	}
	
	public function remove($id){
		return $this->_repository->delete($id);
	}
	
	public function page($key = '', $rows = 10, $page = 1, $order = 'add_time desc') {
		$conditions = array ();
		if (! empty ( $key )) {
			$conditions ['img_name'] = array (
					'like',
					'%' . $key . '%'
			);
		}
	
		$startRow = $rows * ($page - 1);
		$count = $this->_repository->where ( $conditions )->count ();
		$data = $this->_repository->where ( $conditions )->order ( $order )->limit ( $startRow, $rows )->select ();
		if (empty ( $data ))
			$data = array ();
		$result = array (
				'total' => $count,
				'rows' => $data
		);
	
		return $result;
	}
	
}