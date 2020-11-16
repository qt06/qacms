function increase($uid, $k, $v=1) {
return $this->crease('+', $uid, $k, $v);
}

function decrease($uid, $k, $v=1) {
return $this->crease('-', $uid, $k, $v);
}

function crease ($op, $uid, $k, $v=1) {
if(empty($uid) || empty($k)) return false;
$need_update = false;
$user = $this->read($uid);
if(empty($user)) return false;
if(is_array($k)) {
foreach($k as $k1 => $v1) {
if(array_key_exists($k1, $user)) {
$user[$k1] = $op == '+' ? $user[$k1] + $v1 : $user[$k1] - $v1;
$need_update = true;
}
}
} else if(is_string($k)) {
if(array_key_exists($k, $user)) {
$user[$k] = $op == '+' ? $user[$k] + $v : $user[$k] - $v;
$need_update = true;
}
}
if($need_update) {
return $this->update($user);
} else { 
return false;
}
}
