<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
