<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
