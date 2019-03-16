<?php
/**
 * Sets of functions and classes to work with email messages
 *
 * Author: Andrii Biriev
 * Author: Andrii Karepin
 * Copyright � Brilliant IT corporation, www.it.brilliant.ua
 */
if(DEBUG_MODE){
	bimport('debug.general');
	}


class BMailQueues_msg{
	public $id;
	protected $fields=array();



	public function load($obj){
		
	}

	public function dbinsert(){
		$db=BFactory::getDBO();
		if(empty($db)){
			return false;
			}
		$qr='insert into `mailqueues_msg` (queue,`status`,subject,text,email,`user`,sent,created) VALUES ';
	}
	/**
	 *
	 */
	public function savetodb(){
		if(DEBUG_MODE){
			BDebug::message('[BFirm]: savetodb()');
		}
		if(empty($this->id)){
			return $this->dbinsert();
		}else{
			return $this->dbupdate();
		}
	}
}