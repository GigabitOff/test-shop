<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
