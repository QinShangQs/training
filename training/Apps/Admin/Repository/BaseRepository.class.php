<?php

namespace Admin\Repository;

class BaseRepository {
	 /**
	  * 产品经理
	  * @var unknown
	  */
	 const PRO_PRODUCT = 1;
	 
	 /**
	  * UI讲师
	  * @var unknown
	  */
	 const PRO_UI = 2;
	 
	 public static function getProfileName($profile_id){
	 	switch ($profile_id){
	 		case 1:
	 			return "产品经理";
	 		case 2:
	 			return "UI设计师";
	 		default:
	 			return "";
	 	}
	 }
	 
	 
	 protected static function format($datas, $single=false){
	 	if($single){
	 		if(array_key_exists('profile_id', $datas)){
	 			$datas['profile'] = static::getProfileName($datas['profile_id']);
	 		}
	 	}else{
	 		foreach ($datas as $key=> $val){
	 			if(array_key_exists('profile_id', $val)){
	 				$datas[$key]['profile']	= static::getProfileName($val['profile_id']);
	 			}	 			
	 		}
	 	}
	 	return $datas;
	 }
}