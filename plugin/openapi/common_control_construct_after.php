	if($this->format == "json") $_GET["ajax"] = 1;
	$this->appkey = core::gpc("appkey","R");
	$this->seckey = core::gpc("seckey","R");
if(core::gpc("auth","R")) {
$auth = core::gpc("auth","R");
$_GET[$this->conf['cookie_pre'] . 'auth'] = $auth;
}