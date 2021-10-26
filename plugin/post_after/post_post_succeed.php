$qm = $username . '回复了' . $thread['subject'] . '， 快点击这里查看吧。' . '?thread-index-fid-' . $fid . '-tid-' . $tid . '.htm';
file_get_contents('http://127.0.0.1:8080/?message=' . urlencode($qm));
