<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('1E028E894756B26EAAQAAAAXAAAABIgAAACABAAAAAAAAAD/yDsLFFDFVv3d+re/UklnrlqYjDSG0WJ1yDqHRc2GFDs7QXpQv3tfGdeZ18hzvGXT+833MMUVRo6Q2EIn2DE2jg33MQmZXOkWy33v9fR+NybqlX1PoHcOEcv3YILE4+8vl/lozalTHUbDSe/EEkInYWQkXazURIR7KatQ5o7YmeCMzzR16j3pWUoAAAAIBAAADu34HNJ05bL5FsGn72FJx/S2mQ/Osxo6WL5DNbZiQZZQue4/OFZ/6T4PVXVOxcK6BvKeQ503irJNpFRb+w6nC0r2raL3YyVSqCr3rljzAro189/I5vY1fsE2d7egh8qhOcIS/YLk/NGiomkC1M3huQFqJBHXBwXyWO9a2OEmwes0escnpooEho2WQXfnirqaQWb48Y0qrEIrI4pPahsfwqSDQiK/THJtD51CLerMfiD5+Wv1qItB07SGW/Or3A1nFY5Hu07TXT18Uz7vDaku5+RHJcgUt++pxf+YgaqO2psoBrfKj+C3o9VkyKdW1KQTFFGmEz1kZj/a13QBWEKK+pdr1KqvU8Ec3076km5rV574uuk+vjKuCdEy6uWWFikwuq0EB/wedibKC21fci8fbIJ4y2/sNKYn9T7SilwMlk2cC1XGk9lDiaIsVBBgT+wbYKXk10LJfqZKmDDTLQR3IAOdQ2vj6EACNeHWxWda3Y0R1k0IOBV8phVIZEBCSJ3HE3rrEn3s+cG/xET0XZpGIE3EhdK9q1rXasdn/S2bV0VdeomPDVEl6qLUcIidTBV6YYG2eD5bpVEthPRdbZ0S+CY6taap+A0R5JcWY0ARPR3ahkAGltnanpUNQQGYIsRqv7yiaaI6ADIiS3eeDATI0r7F/DQIW1jt9O6drXVdcUG7WEUgU3qt/HvIFJcLW7vS9p5k3PYymnFxRMsiV/ykuu7Iz3TdqDVZ0WF5KFz6CdhbFO0Goe90JHx/JyquDSMXB9QSCEhov3QFq85UgKUaRds/1lIdUy6wh4QRuuFM/Ll2BR8z551jDgpILbCH9Jg0bRMY02by4RQnAhe/1EdRjK7yFCiMY2se24brY6iaS1D0yDz6wVi84rSXAQmDEkI32Zjnkj5O6g8SAJsP8YpjK6y9jDjOzbhn2X/VRhad+hedd6aTPukW8ehBpDUzkG65gFdSyZYFAswpMGy8EOTfVrktN3LetxS3l930mRDib/AXL/+EVfh+foJ0Yl7vpQIgOnnCoCgIuRaX3DQ8tVXz/mlJdCvjpRuWKVni4fG6A44qhbDcVwxbbxZrPLw+W7HpVWgtyILyoa+mm8I0OAO1w+lwPR45tCdHAEI5O+wxPpvVSWg9AKEh7qml6W7nbG+XGXK20eV3KxwfLwq07ViqxxNRa12Y3K2g9/DbNAx3a0wT8+oxHzeJluNYo6oHflm8GSXzgRgewmVaDMGobA5UwTidBsIevjsUk54Xdjmtr9w6DKMhKaSgNFSTbmiRRSvn2Ptqq8S4XD17o47HBHfzyvnMr4FgSnbnEuEBsGbRf3ZvnzzMfAiDFnvol+No0NYecZ2Wf38Yru/Y13zExVHQgp7XcpMP8q83CAAAAAgEAABOhZHe7R5LiznXQxfg0xsjl3n2Qqp9GD1G1lb3xV14ktwF8lMEMpB70QcZNGIWPrinG2E975WjXqKZKFfYhpz7qiHENYOkV3e4NW8o97xIuP5zw9/y42kWOmKfxQkwiYZNTfPzR3A7oS1JIlHw8gJG6Tca+30qGoneVxZ8EEt6qquWJbFD1NH/EYFkEzM9AvNpyoRynN/PyYCKWwK5/ABjotatINBRMWdsUJh6Q+aBsHX8ufB4iSZc9INLV9yYKSJ+vz3A9uZ5QXiuLX1bIEDWaqOO0LspgaeBU2gIPmGMS3aqQHcAtXQTQCVRbSeYBAmi829DGDwoAZSymqe6Re5vsBr+//BQDjRkRlj7pspIdFvbV1odcAoa5ojPQe+4r4q9SAkjE+PAcyMIpYlAu9Xe+xpbh+Sob0LzosNkS7PiueoGhm0ujEkXokjV0j9P5yYNV3rpkK6Z7HUTASbJTlv9s1hFpJepZF263OX2yGzuufyqFSTj1HJrcHPac9o1ypswgfApTNGXz1h9D8C7p63cDmEcgbab09D2up7jIZvZYNdx0Q5aDulBYQhp24xA4Oe4RTUmaPPmvJQppstw0QS/qnkp+/S5uVEVzRPWeF7W+Eyysp8zTXnvqotChqROy94Z+hT69myKUh72Ely8QPWiLiZAlyO7t9ijDHLofWaVPQ7AsHCernOaPcQ9OleGHDpUp1rbCSLN7ocVCeeCM/oC2dxiQGTrq3FGFLiJKOodrP7UCy9TTBQFiWuBiaX4lic//3ibq2jaub9MyqrsJWC8Emv/IX1JVQMX1cFeK96mIx4uAZYsFmQMdXHAgtoL6J8171btTRwk9Jikjj0a1UIkRoydnz73MN2AetsTTg3DzgZf/LvLKMdbuOQnI6wUu/hf+ZOARqCH3F7Jj7AIjeuFqR8RrKRucTBgxdRthjBx86fZGgaJ6flIQK+cvwvmMn6AdQYO29INjNGafuuutk7X24TRgpnM102oDO+nhvrcTrxjorBPckNm+rGUKLp/R3Vu9G9U4Wc+ZobGloZOLa5c9/sEOFtkbLWQUAZMDsvACy2cyDOM852SxcUfXEalNWj2uwfHzvjNp1lPQeBpyIXO5nwrw3/DnQ9PDMH+mpthYgKPM7a8m9JFhoCXFDOmZeCyGi93KRuD8ZdaTKx7zFpKHakLm2fA8lVXfRNoYqtCIeGp/BIlwYWcVkyqa8CTtfMHvcFtrmI5iptS2gMkMpUinjWhyw25pnODHiu3bl/sPaVi0KMJmPWbKsveqckh/sMRIYhdNNqjdBiEYatVVOwl2Q3C3VLwckkfwVIDmXLqS/4xt6mVS8Z8m0EzLz/goQZ9YNCxQwrg4FlVX4btCleCNZi5OBqGRdwAAAAA');
