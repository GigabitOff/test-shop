<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('1E028E894756B26EAAQAAAAXAAAABIgAAACABAAAAAAAAAD/yDsLFFDFVv3d+re/UklnrlqYjDSG0WJ1yDqHRc2GFDs7QXpQv3tfGdeZ18hzvGXT+833MMUVRo6Q2EIn2DE2jg33MQmZXOkWy33v9fR+NybqlX1PoHcOEcv3YILE4+8vl/lozalTHUbDSe/EEkInYWQkXazURIR7KatQ5o7YmeCMzzR16j3pWUoAAABoAgAA+ZCljT62MHha+6HZKVPo2FJykbYO/Mu74fqmO7h09h9Dx5XkDb7xpFLAcaRLWVaYXiUpKrTaR+7vRBK2lLhgENp8mVZ9EV0a1gtdwoo2Re1YBw5B0tJi3AuZtlL/YcTfrUb4pky7S11Nv8PySfkHOX98pCCgDDjylYeSio7G/UpJr6eso/YX33+w2Ha0kAqguyzNvceu8xqdHkNnfzDM6f66/FeUhZaRxTbO867gvsrTh0vi2LiYtV4DpOS+l8eaxSyUmpWn9pK1odHoPMvPzLkWip41d75bHmgeOATO68emNaKLX41czfZnA2oN1dkP/oRza89XnWRNkXgqViw8y5tv9aJxAOhWZQFLnFys1+QeaZwqVH6gwUGB6KZsPbfXhlfBwdq1PQgWgeyuGPCkyJt1UdEcjaOyv19VgQ8J/6OEPn3uEPXg21Y6GRXT+mafv86QH5ca6yFJ/z8NLUpKuQXvACRDcv1l/sIqo0pgrbo8N4MOIU1opI0fhDkm4SWNaJbkj0MHYgFFsurXX+L4aXstfuuu42U77r1NiuDBADkWxIpgJj4yAgjK+P9AK9CbN7BcGXUQYvew0oGkIvrEVOBFBiC2L2mPCxgBpqMgvqJ9MCy+cxFw8u2OggutLfppIMjDNz/YSwF7rOTZPc8fcCON8UqmwLOAm3s5QWwB6K2nZDcb7DFVPzJPP4+WGS8rm8YXJD16w6hhJ623j/eQxcHeDjRWSqS+SwOIksHn/TdkY1ggCHUtaJH5I3t/IiMfIWpMtKd10QvnFrCuJ41eEUqtkWRWYaui4ubWeWuG4MwCaxfSfunAAAgAAABoAgAA1qtAZzHWtMc3E/JCrQh2RJCiBCxuIQeIEZPQDQ9yI8Ptld/8uUa0S1mSTb6Xr/QgKgVVvNp1I/DgJGyJ7Lkshj7oRAxEuaBC/xDYLcAGxv0KjFr9cUOLzwr7abSt/guFs12JUYLe/sK8Xv4zA2PwSu8o6bV5a21jnUAkf5hnjepftpHp+zmL/LmC+pC74foOxQXArMFH1ZN7J9sQSvOX8Td55r/TJHXjMdStxs221F/qyshgOxUvCz1n96Ehyc9AmMI7cSswVusmgh+4KiYlfs8k43aIwmVcR/CNY86rwfd8xxZN2XMGBoZceW9h+TlDbpINHCdDIuHXhH/eujWskBtUnuhV2pPODUXiQUfiBr7c0F10glRlQxNPBxldwr+tP+0j0sKbFrUnY9ArrGRpUSeL/r8CIXdmdy7VH/AH6X5PxtiHf5lZYwUFhZJlAqNHQsXm3ICs2j8q9VXEx9+iJR1wHARIT3AAmx/IQKXEmJqyww0twetWZabkaNUHN2NaoI/0p529F1PkX6GBuj4KWQ8sv2Ts0kte9vYQr1R5rD6zgJmpWRt68ZHjpyuuICbGim6o/HB5fBYyy9jRZ6LwxMGYJ/GelvtP8+z2xHdpy4dQ/atecxydR429pTl/aJvOuDLZfXswrkRPg+QR9MvLFQqhQtSAUCuKuRXff0GhegCnPy0apoWhh1lKpt/KU9oY4qz/BEgqnc6o9zf/esE65VXcsB9XOVFxfNolol9ce76ch03mx5M0PMoiU/v3uZhcO72aAroEzUu3p26NB5Kt4u/7Jt0UeXfF0IzgLWpayQiRprv1JoFsSAAAAAA=');
