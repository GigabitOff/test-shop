<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');