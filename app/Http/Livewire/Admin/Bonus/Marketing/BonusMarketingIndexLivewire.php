<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
