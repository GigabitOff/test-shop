<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
