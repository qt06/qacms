			$post['message'] = preg_replace('#<a href="(.*?)" target="_blank">\\1</a>#i', '[url]\\1[/url]', $post['message']);
			$post['message'] = preg_replace('#<a href="(.*?)" target="_blank">(.*?)</a>#i', '[url=\\1]\\2[/url]', $post['message']);
