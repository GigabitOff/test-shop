<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
