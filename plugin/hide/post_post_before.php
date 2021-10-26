//处理引用时候暴露隐藏内容的问题
$message = preg_replace('#\[hide\].*?\[/hide\]#is', '', $message);
stripos($message,'[hide]') && $message = substr($message,0,stripos($message,'[hide]'));
