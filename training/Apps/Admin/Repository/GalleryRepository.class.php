<?php

namespace Admin\Repository;

class GalleryRepository extends BaseRepository {
	private $_repository = null;
	public function __construct() {
		$this->_repository = M ( 'Gallery' );
	}
	public function getById($id) {
		return $this->_repository->getById ( $id );
	}
	
	public function findAll(){
		return $data = $this->_repository->select ();
	}
}