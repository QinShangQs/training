<?php

namespace Admin\Repository;

class TeacherRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'Teacher' );
	}
	public function getById($id) {
		return $this->_repository->getById ( $id );
	}
	public function add($name, $come, $degree, $profile_id, $header_image) {
		$instance = new \stdClass ();
		$instance->name = $name;
		$instance->come = $come;
		$instance->degree = $degree;
		$instance->header_image = $header_image;
		$instance->profile_id = $profile_id;
		return $this->_repository->data ( $instance )->add ();
	}
	public function save($id, $name, $come, $degree, $profile_id, $header_image) {
		$instance = new \stdClass ();
		$instance->id = $id;
		$instance->name = $name;
		$instance->come = $come;
		$instance->degree = $degree;
		$instance->header_image = $header_image;
		$instance->profile_id = $profile_id;
		return $this->_repository->data ( $instance )->save ();
	}
	public function remove($id) {
		return $this->_repository->delete ( $id );
	}
	public function findAll($profileId) {
		$conditions = array ();
		if (is_numeric ( $profileId ) && $profileId > 0) {
			$conditions ['profile_id'] = array (
					'eq',
					$profileId 
			);
		}
		return $data = $this->_repository->where ( $conditions )->select ();
	}
}