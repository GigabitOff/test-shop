<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
