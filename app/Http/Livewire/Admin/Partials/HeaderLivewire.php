<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
