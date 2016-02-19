<?php

namespace Admin\Repository;

class LessonRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'Lesson' );
	}
	const STATE_READY = '报名中';
	const STATE_FULL = '已爆满';
	public function getById($id) {
		$instance = $this->_repository->getById ( $id );
		$instance = static::formater ( $instance ,true);
		return $instance;
	}
	
	public function add($name, $open_date, $profile_id) {
		$instance = new \stdClass ();
		$instance->name = $name;
		$instance->open_date = $open_date;
		$instance->profile_id = $profile_id;
		$instance->state = static::STATE_READY;
		return $this->_repository->data ( $instance )->add ();
	}
	
	public function save($id,$name, $open_date, $profile_id, $state) {
		$instance = new \stdClass ();
		$instance->id = $id;
		$instance->name = $name;
		$instance->open_date = $open_date;
		$instance->profile_id = $profile_id;
		$instance->state = $state;
		return $this->_repository->data ( $instance )->save ();
	}
	
	public function findAll($profileId = 0, $state = null) {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId 
			);
		}
		if (! empty ( $state )) {
			$conditions ['state'] = array (
					'eq',
					$state 
			);
		}
		return $data = $this->_repository->where ( $conditions )->select ();
	}
	public function remove($id){
		return $this->_repository->delete($id);
	}
	
	public function page($key = null, $profileId = 0, $state = null, $rows = 25, $page = 1, $order = 'add_time desc') {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId 
			);
		}
		if (! empty ( $key )) {
			$conditions ['_string'] = ' (name like "%' . $key . '%")  OR ( open_date like "%' . $key . '%") ';
		}
		if (! empty ( $state )) {
			$conditions ['state'] = array (
					'eq',
					$state 
			);
		}
		
		$startRow = $rows * ($page - 1);
		$count = $this->_repository->where ( $conditions )->count ();
		$data = $this->_repository->where ( $conditions )->order ( $order )->limit ( $startRow, $rows )->select ();
		if (empty ( $data ))
			$data = array ();
		$data = static::formater ( $data );
		$result = array (
				'total' => $count,
				'rows' => $data 
		);
		
		return $result;
	}
	private static function formater($datas, $single = false) {
		$lessonRegisterRepository = new LessonRegisterRepository ();
		
		if ($single) {
			$datas ['peoples'] = $lessonRegisterRepository->countByProperty ( 'lesson_id', $datas ['id'] );
		} else {
			foreach ( $datas as $dk => $dv ) {
				$datas [$dk] ['peoples'] = $lessonRegisterRepository->countByProperty ( 'lesson_id', $dv ['id'] );
			}
		}
		
		$datas = parent::format ( $datas );
		return $datas;
	}
}