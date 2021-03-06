<?php

namespace Admin\Repository;

class MajorRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'Major' );
	}
	public function getById($id) {
		return $this->_repository->getById ( $id );
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
	public function save($id, $name, $descs, $old_price, $price) {
		$instance = new \stdClass ();
		$instance->id = $id;
		$instance->name = $name;
		$instance->descs = $descs;
		$instance->old_price= $old_price;
		$instance->price = $price;		
		return $this->_repository->data ( $instance )->save ();
	}
	public function remove($id) {
		return $this->_repository->delete ( $id );
	}
}