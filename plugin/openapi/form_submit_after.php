		if($this->seckey && isset($this->app['seckey'])) {
			return $this->seckey == $this->app['seckey'];
		}
