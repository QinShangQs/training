<?php

namespace Admin\Repository;

class LessonRegisterRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'LessonRegister' );
	}
	public function getById($id) {
		return $this->_repository->getById ( $id );
	}
	public function getByName($name) {
		return $this->_repository->getByName ( $name );
	}
	public function add($name, $mobile, $tencent, $lesson_id, $profile_id) {
		$instance = new \stdClass ();
		$instance->name = $name;
		$instance->mobile = $mobile;
		$instance->tencent = $tencent;
		$instance->lesson_id = $lesson_id;
		$instance->profile_id = $profile_id;
		return $this->_repository->data ( $instance )->add ();
	}
	public function remove($id) {
		return $this->_repository->delete ( $id );
	}
	public function findAll($profileId = 0, $lessionId = 0) {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId 
			);
		}
		if (is_numeric ( $lessionId ) && $lessionId > 0) {
			$conditions ['lesson_id'] = array (
					'eq',
					$lessionId 
			);
		}
		return $data = $this->_repository->where ( $conditions )->select ();
	}
	
	public function page($key = null, $profileId = 0, $lessionId = 0, $rows = 25, $page = 1, $order = 'add_time desc') {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId 
			);
		}
		if (is_numeric ( $lessionId ) && $lessionId > 0) {
			$conditions ['lesson_id'] = array (
					'eq',
					$lessionId 
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
		$data = static::formater($data);
		$result = array (
				'total' => $count,
				'rows' => $data 
		);
		
		return $result;
	}
	
	private static function formater($datas, $single = false){
		$lessonRepository = new LessonRepository();
		$lessons = $lessonRepository->findAll();
		
		foreach ($datas as $dk=> $dv){
			foreach ($lessons as $lk=> $lv){
				if($lv['id'] == $dv['lesson_id']){
					$datas[$dk]['lesson_name'] = $lv['name'];
					$datas[$dk]['lesson'] = $lv;
				}
			}
		}
		$datas = parent::format($datas);
		return $datas;
	}
}