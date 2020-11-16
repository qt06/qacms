<?php

/*
 * Copyright (C) qt06.com
 */

class thread_fee_log extends base_model{
	
	function __construct(&$conf) {
		parent::__construct($conf);
		$this->table = 'thread_fee_log';
		$this->primarykey = array('lid');
		$this->maxcol = 'lid';
		
		// hook thread_fee_log_construct_end.php
	}
	

	// hook thread_fee_log_model_end.php
}
?>