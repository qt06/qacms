
		$friendlinklist = array();
		$friendlinklist[0] = $this->friendlink->index_fetch(array('type'=>0), array('rank'=>1), 0, 1000);
		foreach($friendlinklist[0] as &$friendlink) {
			$this->friendlink->format($friendlink);
		}
		
		$friendlinklist[1] = $this->friendlink->index_fetch(array('type'=>1), array('rank'=>1), 0, 1000);
		foreach($friendlinklist[1] as &$friendlink) {
			$this->friendlink->format($friendlink);
		}
		
		$this->view->assign('friendlinklist', $friendlinklist);