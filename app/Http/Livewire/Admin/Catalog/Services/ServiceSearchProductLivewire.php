<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
