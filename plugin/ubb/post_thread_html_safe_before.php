			$message = preg_replace('#\[url\](.*?)\[\/url\]#i', "<a href=\"\\1\" target=\"_blank\">\\1</a>", $message);
			$message = preg_replace('#\[url=([^]]+?)\](.*?)\[\/url\]#i', "<a href=\"\\1\" target=\"_blank\">\\2</a>", $message);
