<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
