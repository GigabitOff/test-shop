<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
