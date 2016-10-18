	protected function init_app() {
		if($this->appkey) {
			$app = $this->open_app->get_app_by_appkey($this->appkey);
			if(empty($app)) {
				$this->appkey = NULL;
				$this->seckey = NULL;
			}
			$this->app = $app;
		}
	}

