<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
