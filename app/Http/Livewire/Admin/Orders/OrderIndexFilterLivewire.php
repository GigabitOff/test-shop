<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
