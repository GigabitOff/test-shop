<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
