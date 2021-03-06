<?php

namespace Admin\Repository;

class ApplyTeacherRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'ApplyTeacher' );
	}
	
	public function getById($id) {
		return $this->_repository->getById ( $id );
	}
	public function getByName($name) {
		return $this->_repository->getByName ( $name );
	}
	public function add($name, $mobile, $tencent,$profile_id) {
		$instance = new \stdClass ();
		$instance->name = $name;
		$instance->mobile = $mobile;
		$instance->mobile = $mobile;
		$instance->tencent = $tencent;
		$instance->profile_id = $profile_id;
		return $this->_repository->data ( $instance )->add ();
	}
	
	public function remove($id){
		return $this->_repository->delete($id);
	}
	
	public function findAll($profileId=0) {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId 
			);
		}
		return $data = $this->_repository->where ( $conditions )->select ();
	}
	
	public function page($key = null, $profileId = 0, $rows = 25, $page = 1, $order = 'add_time desc') {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId
			);
		}

		if(!empty($key)){
			$conditions['_string'] = ' (name like "%'.$key.'%")  OR ( mobile like "%'.$key.'%") OR (tencent like "%'.$key.'%") ';
		}
	
		$startRow = $rows * ($page - 1);
		$count = $this->_repository->where ( $conditions )->count ();
		$data = $this->_repository->where ( $conditions )->order ( $order )->limit ( $startRow, $rows )->select ();
		if (empty ( $data ))
			$data = array ();
		$data = parent::format($data);
		$result = array (
				'total' => $count,
				'rows' => $data
		);
	
		return $result;
	}
}