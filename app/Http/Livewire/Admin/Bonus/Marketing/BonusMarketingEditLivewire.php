<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
