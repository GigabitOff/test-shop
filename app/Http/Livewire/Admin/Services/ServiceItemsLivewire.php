<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('B66F9C404756BFCCAAQAAAAXAAAABIgAAACABAAAAAAAAAD/PNIPwx+ufU7W0rBCXA+QQLKEAL3IhVm2QBNUDesJaM4KbuglwfjYBf/XCbPqq7rGZhsezeeYcOWGtT4+663KY6N7k9qqyPO0Z+/pWrRNvwHgO6E7KOBZDaLFyDGlO+x3O1LuPHYL8mEEealCnLDW6askBSIsLt3LmR2kfohe/m/ti1dqUkC02UoAAADIEQAA0oyThye9Clqnt/MzVZ3cha1gO8fg7e61m0oger/Age/S4GKOsrhg/T1EvgKuYWMgidsdQSfmxLrDGjEGpBv/u8PjiCkv3Gh/vcjyu4Vm1qHMOA0O20u29cUwWBfyx8C9YBBCRo9G3TXbQpjP2iWM8glRpg8kTGJqom0QYQFOihxWG+swf42TZBd5/9c5zuYPq9lDV5qGWHpIf7Plq4sg8fdQXrGgLc7XYY3PRGEU4W4vDBw6sBntexvIKvPUGvD5hA47fjTnpNZaqLCnbg1E9YiM2Tmb0D5Kk5Hj4tMfuEmqkQyd++dUcVMZu79CHr5ZZ79YnYmfubIyAGGsHy98kWpTuqzKtRFIAMl8xmK1Jm9iZP99IbUjEtRG2nvKxAfds9YR7qCUMefWGtOFbdWh9Nz940pjoEl1ZdOIAfhXLFa/8N2DYzEGF1r48fwqOQcWt2bSELcGhK+O4BlsrAFacqoF6988jclRG+dbergzjl2WID+p8RLbPnrVptu/Im6xKhlvTAYzAIeoEnd5KzhxQd0u7Hydm3RdgSCH59tsCoWVOUT5VFIWyO5L8/nTWz+tKJmFztGDsVy3Am5IOZmCbR72PWVTHbY/eGJUtMO0xHvqUrlnGZTmOHUpBvOGlGb4kXHZsiLfO7vAIFJtQHutZH0vi/Jxxc7DRIjAZL+5ej6Hgf83H0IjGKRsHxrWitLojpTAts956uWt5saftvICV7R7EbeHLJY0civoWHI39vrJ4//WJ36xPc0tYWYD8rENQeYM8NBfUtKmoMS1zr/5aDoGAKHBOXjyXatrY7yF0ozcf9k+cUG9/L/uu3G0hztzVqLr6aNGNAyBqm3CBLL2Lvbv/1+R5UYhb2GPO0PxGSregJPVVj7NLxFl5/62Yg+jw4ybUYl7+Nc8pQbW7BK3/WT2sdzGya5TjJEAWsygZpc/Cwdk1F8OmixgPPBDh+byF7rQ/znQuaqZccqqFK92K6piMCfNgC+TRXHgEg8YoK4ZVPYNhMkgrzYb3dmcTjmkfLyUjXk12beChGsVvseFdv3Guw70Ul1ODPUYx6HQ2o646saZABfMKCNjwirILzwXeSmRrLLgUPTRPlxzCiwS0UANvPlGBEpbFKRhuT4sltUliDDuzmzdTu1mCkwmnGqTsZcDYuJeU2ppvV15TPQGqXSP/D2o2Eu/Mx5/lmEMoASEHJ/lVcohi3woWPywo5IWtZTnRYWYuv6INeonykS4ZqNKJWHC9xg8WmSpou3+WeEJYaZDcUdUqB/TXdOeHnYnIaRXkr8X16KAbtpuoNucbEsWPNY2iVozdIxAjKVOjD7nsEq+TqJWLkF+nvvhMfDzLqwykvpIZ+QiTzBnyK9zntZzYgeg3kvFlWkWCLfy7HowqpQiAZwyixS1Kj3x7UfjkQADuOcofF0w/Ae0RMjMjxc/WT2G4qPsj0k/Th04c235T/GQ4e/8I+sNl5VdxURRPgbxUk/dAWvm0H6ebN7JFj8gC2Du7UEpI+aUfq5vNq+IcrzvHA2cDPkQv/5NTBUVtPXWW8BxWrBqqqoj9IfZIohPoQG4lwXAf/vt7NPgqevq3h0MpLax9SlUjLZ7sHr9TLoZOinPDe0gYojEyEQ/xonJnUWBrutGX3ilrh2WPPyrynWOAkIAy9fmTogqGK7jjsr0wWsJrvIZiRpC3J/yctJZNruNqS8q/hmOdufHDxzKe8Ag9LjI+3Rn4Rs7YYrj8W6r1y3+3QkKEylrvtF49Z3AWAWwEWDqKm93OT2v/SnVml5zpVnj1j+ipYb7QesLdjsUQeknbKqcbESl4pgKBaLF3tQ5DVuU6HtGpZXQcQqCL7GorEvjxBpWbUIk2C6kf+zmtGeL42Dxiwk0b7UqL62MbflziCz3gVGPlPnmi4eSKyCht+t/uUdcEqDiRGpzF/AHnAp3MEwW0OsmzJMt2Sh+FiRjE0VTjixkZjTTcCAhF8Ao6BjDgmLxZx7rV4yp9woMEw/C3uYOPJK5CZBzKxlkok+gO6SSo/HtZcFNgQKeYVP95NX0d1bAnzRZaJatcvZqtlo+U+lSql3Q6dDSXbjwhsBlx2RmP0pADBKx9p5qVl3mUMoe4PyoxPq10pBKgNnbRn3fboKrYncCAJth5qCu0NC2wLhWBTM1H5lNO5UtfxsjnUqLjq1+Aq3lsrnGSaMP0sTfhKtAFfVNzKTcbuZ6k+vHeLnVkVeXwbfkMPj4y5MjkWH+3wRnh3mcyW61N/+FnjUKPAXz6TsNIHd3ttf47V+yX7D4js1jDudughoJriqyya+1Ngv2ytdYlwJulFtv0sOgKMomT04wA73LCSDqI+H8dC1RY7vSX4AmGF87w76BC6jaLHKfhk0X7Ur+QgTQOjqFCtFr8zKDEr7EIzq2vCmv7JMso4Dkqfh/gSQqFD2e4Bxx38fOAM0HM6PeCpGHDXRCb21yOZZ3WhkWROb9e+e5uxmrzTUC18r8B/vM8u08xGtNZiByaIL4e96uycNN+1ZV52ZhwnQYg4rNJLWWgz4n82END7hEbZQNuq7UbWWnim6UqXOz689P2ocYGTgVF87bfQq2/5IhUffAYmkzckX0QaK0ZLSvT9uLVGV5t77mSXUjZu0kfGJqynRPWme+VB5i96ZRFNiQJFtlQ4exzwVBlOrmz3W3M/97Kmx9wOks8szW8W69vcNtNVcSGOMd4j1x4qAdOh6hYKfduj29cpGg1XIeVDgENH+4Te0QOQ+oB/cp3xo6JZwKjwDu0yN3atnAD7MTKYMYVXBwofDMz4CdIKfTWZjLsa6/r613rdR1Nnhe9uyHu1dvsad0Vqpwc9ZQGS24vbIsgu4naiDlc4sXw/WtqIggxHOYfv1Uk1t1yDNKWZwmw2m5CbbM9N8YOf2tBrQvq0Vxq2SKDgIriZ+HC3O5zv8wUEAdcy3dD+G0THxc1TuW7HXUzRsOLgVPqrYwh2VAwrA7RsbpHTBmdulZEcSJrspVNObpy0T5yWDqF1a/4Y8bBcq6eXmrGoLEyO8H9DUbYWl6lSr4b6ZpXv2/kkMP7O2zqdskdx0tScLIztEWLpUJlLQdzSbDeiuJrutOAcprGvUoCfgJWZsVToxD41CgXhDK5ilVg0uncmfF3OagW5AJQ+24e+4mc3S0n8IJzfoRLUnw51TDMyByhems661zB2a5wc1n2BJ+GxnpUGca3YO90bL850e8YKlYzPq4ej8hVR0o7IAhF3kW5zvZRUwBWCrRsMN366efwSFBttLalZmd5Jo4bUJvoEyx/CLTSeM5Ti2DpDQOOGXqsosJ++4uYIcHJOVTKEcd2j0uIi/5pUkJ8zUdSGK83xP8BrgKizmHn79RJXGnPXHVbMs4KnfNEO4lFLDUTpyoTPhr6AKvBo2I8rSnyn10Kt4T9soCVtkpQ8CDONOVpjMocu+jbAoC/AqesktAXWBHym0qYxorVMoSMDJBijHS3Jb8c15e44G9HvMjICcVukjRuRmBF7o6MwW4ifvOtP7Im9H4hHWFO7JnmG7lAg8vhF7r29MqvLiF6NzGsHwQKhNgW5mZl08pClK+W08rM3nYiCeOnchU0CEyDcx1FZZ9JmqfvPOHx7XVZpUffapCfX/p1B1oqPPJyLkskfW+LAAaRbeT3S+chYCC0tW7tpqdbwbNt4FZtMUgeOLAt+YAh45gU8H1ydm89qXjxeDfvM7jfn/5g4n92R5tGbdUmnwwS2J2EFxmhBXlUSoUBdpUy4N9+NgYlgE/CG5ojYdGoelzrMx/T9NXxEsk6go5Abkwe0RssOCKztFfHPCXBqFlgxJlitq2yyFFZZPcxPW5r7MDExXEl/oO/IgnFH/G3AsDGXSAzBlI7m4jDdywlxT4cNFsP00DAsrlqfnMT0iyQ6bdawE3E7rQ5uWWHW8oQj7H/ZMy3irkeImx3JnaGDMc2awjCaxU48I4EXT5lTXpy2PYzToVEbUCOctpkahLYOSLCvL7dd/qhdARJAouFq4l0Qf3+KdR1rsFZ170L552675morI9V/ttK+vImkRw7Qn2sk5kbC/IaSn7Y3ezFnew0Mnlh1S6Jz6HwkbphK5Umr3WMECzVFH0RMn6tRSQF1lfvu80jylt1Ceqab45RtQ1yFVnnBh7XJ/KK+zvpaOgVMQoOC+arku2t0K07ZqpQKIoq7t3cuPQn1PiRDS737jIr909wNN7HSPmuhRNjt1cnKyBCvNfsIAngd2oiHPUPR8/rP5s54D/zJbU/+qtZW6tMTE7aP3Ww4RM4gwCj7xmO0yZ8axS4WDFg+7tMloVzqD7V8abkavXuFAj/PBqB3ncmZuc+jtrT7tDBPaI/sl/KioV0EAIZ7qKm7XEaTZyyyNDaFfU76S8Rlf7olfhxiRBbxF30CoKV8ACpLdyov0izVbxmMXHB/XiqZY2rvCMHvCU053RyUC1knEWA7wJoTFxzfXcF8jWzdETD6tD5RfLSANsnsKTQ8zrR3MxQu+6AbLpSCTJzn5zgI552VyD07wH8rL+IvbMrovfQtoN07ZjWD96J5n1HWZAHHeJjMCbhdDw7Jv4ft5t+Fgbmj0p9W3CD/gqWC2XFhmfMZVYwYwSP7yX/TVffud2THGNWXjZNPaCAvhYHYeyT2KXw31jgk7qseDrUrfwJQhCCQ5nUInEUubTTW8DN/YREBniozDwUSxaug9Sqn8I7TR+cFfrNnenycUrBdLHdD5jKJOaEXeKQLcfEz/Xta0yqHvzrR4aEBsHgA2VnXJ07dOec51Hi9GqnFPQFN4O+u4+6dvNMjiN2bBklkSPyq9EeKoo0Go58tYBufXsQyh6ALq7Cz8Wpg6q8EfbhZhR3R8I6jEypJd4u2imdYwBO8Lzc2oRUT5ea0W2bnqPt6m6f1mjiFsHl3Jqp4IhsmS6WJebR2b0sOyawFrzkYPSNy6mOx8q/R3hVzSoaNvtrXH0F1TUWNCUKJSOifSTZsuQohaLvc9x6PNxt+4FOGCtqU9ArCKACLi2zMaWdP3BFbg2btAZIY2bjWAlzABTk8RS4WEtnLbMXFNABbDMjWQgozK4zh7/YArPrcae7bp6NlO2uToW6zymTCegTJvizuud2AbD9nPFA2O7vJ8FPXUVB3PRCPKHXrxcUD6S9Wz7G/cRZDvr/e6jFFYvvCO5xvjaX9Nqim9NEg3L0learvdSLAzxPejDnMEs+AfIU7UZg9kT5K625oAx2NJGHGOHmEiiqqhrXJLY/oGry7IgIAMP2/AgDFN/GZ3xOlA/MxY9anKeC6qjBqgAPAPhns96rl2pY6hKj7Yr9t/6GiuBlGmTQiBB0MJlBc90FtfsmyVGPtkIivUwpH/R6rUzhvV6lqlNYUnvS98bt8OLGEDK87tK8ivFj7q9IFz2VKYN1CVi5aTN0DWiEWOgXODPabFzBKdMSpMFwRQZpDKVqTtGEhQouUB/MZWyg6kUL2huqYk/kd62kKV0Eau6V91H2kVeOQjhoImxFWvTCbw3JtVeJBd91y3cHN097W5zZel0hu/SDURbdI9BHYX5rHAOWB8ATKUDVZc3f3VtNUdE15u2wBlDOcWQ2RlwzIDhlUtHdjfMHsaXI1GUSg+/xgDnjeZd9ZubLFNg4yob7rdyRGEGrItWt+hC+uK2qFmVUKTV4vBwL9v+rsBs/CXLx0OMwkLn87zjvfS75EMJ9kc4KlMI3QG48k1xrPLmuqCJnNXM8K+8QzgBk3fkey/37V93J5M+6vnYW7LXv9CwiPso9V+02m+EK+1/xbRda1RzDprHoajES+R1EWF/uxiQ0wE+/F3DJgYeyNGNPUWumfWavLHEbKqSc8bXUN379Q8Q6DKHcBT2VE7W0O/dTduItpc+3xsr6nAayF5PJHkVp5xuDAllRnXRdqopm/FSzfTwqQh8PsHrbqCvulgcPivAZmpadnthLbOeBAnT+i22meuyEQ6EsMRrN5DHAyqTGiWXHoEcCnGNCMjk+TwV/I5vzK1sl1lPcVAsnabtBpBlwqe8c1cm0N8TPm3aRs3M70YYsS2pqE+YXhOaWZmeNHyMJVF9wbzAgHa9G9a0KbOKRioqEvYe0xlPDDkLwAgAAADwEQAAv06Yus7/iskgin/+Ujktn/jYktNFbq++dtGFAiZhhScbFifulBphUhS2M3yirw8WeQSMU4c8+n5dS8jlGWclzkKAmxT/q5yoZ/ihKi9/+0KWQmjkXJGUo+SBdYRtu73bK7WHDdTvPz12KR3vBDrK2TsLtYKBUhzLKY51uZro7EjnuKLg3oi7i4o83NIixGjrGW1MlsNDsb2GvCFmqVxZhhR/JO2YnUu1sWXEPqySofLIgd2sRqNCabjkn8kv4lEZiICrGEuI6G8DdbiN8vm5XQKzbKSXl+94i6MvDU/nxkQAmVSeishv9mvHhVmtrTnwGR00+M+rBPIqYecO0IiAiO54yo6oNOYdRv+ZoRISBaxdj4ihH29o8B3Mu4oVXXwllbKzSXB8n5Jigcw5OAXlp3226Rt3znF5Cv+MSiXk2XRNJBj3ytBUYkGDdmbAG4bTBFQVKxdpVuBl6kxwpDjT2QTpzC2oeqBGQDGZqR7yD0d601bRxyVqCpwCsxNIzWQG4YcaDu1tdpHeu+jYV//MdBFyLqbi8SKLhrBRC2FnzkHpPIBsKXfbjwPSbP+0PCXRo0nxkE6GTjPDHfbR52Ouax03wtPdchE7XArLpN0RbPZ9S9eqJ9u5Mw+CdROkaDgddXPHpNuaPI+OmxigQoNYxTk/H49Tb8qfNFatuBSPk+sAOEAZIdgvEQ0wzsLrEWBbALLpJZAQ/TIFOmF4qBx2m6r+SjJXz3KCXMTBPN6ZjjJWiiP+LxeW+lbjKtHFHJjgXL6WIDPBKAtgV6D8O/cbtKfCPwluZs/LyGOq9TXz07tzRKOHIL2g2isj43TR5O8JC5jbcFXyw8Vkx12KdfjpSPFHgqv/8npVHMZAH32MLNs+RtSxVxpI16aWgVsoydu3EWR4Bqt5VL0TrLuEuqizrtS4wH58k599OFqm2kKZgAAvmDS6ZxSZ1+Dgo/Em5f2YKmmThsa1Z50WFYj5tIvyXnk/lyRSq1232LhwXheG0ZFxZJPQIdXM+IlMpNVnn7oRLzJ/P471u5kIlsdlIlQQTv/IP6nYDV7xQXsT1FBNEoI3e6+GUwZ5v58T2yv/H0RAkowXpR62SsIesT7gVbhh0pe7rzb2l/GYQMIY6zxP/H0EEI9HQpj00k/0Qxtb4OWe2jfF8d0d5NDK3AXA6UEFU0xEygORm1xloE3mlNcSQP1tg56yuSlVkCb9h9uDY/fCx0q0oSIKiSyD2SwuiSyHQMhEvvw7KSeSSk39f2jLgQjbIfdw3HHYnHc7yxVOyTfj9Pt7cUxyVJNxpkiKAecKq2fKMQg7SEfx0ZXG490pqPOEeQuyhQTk8R8RTbrX3Bw4wLS5BSqJqKJO2xSI7xaoFXdvNaz+BmQ+pHo+IjLBKqqtZ6B1OsuxA0bsIes/Xe9MjWxMJ+bbD2klWHl+Kfr/p1RcQFqcTTXfH5zUu1Va4LEPPOF/1HiaA1E7SN1TU4Y5TltN+0GdE03YW5At09684+l405nL4DNyJpFvRhHvAcXzhJ+Kq3hvzThMyIvWd7OdFdG3YGraTO8+HCVpC3rtlVBlt5+QY20wUfh7w/7P+zKVx9149KV3ntLxKTQXtE0MKH3FEzbN8AD0g0KpBtXU60Fx1N1NSTOEqG4DMgOY2aka7BokdjZLHI8eZKhHcK/bmnK1Hmn1iLlmmGdp0xeA0aIF0+QOCmfvIm1tdZYN3UH7goEyOUfTq3o7RX7H9f8tux/lhR0q3A1T3KJwYP+hZ/FIcbd8LD17CHM47g/BnnZdq+d5HyXUOM+8JIc1Jxs7tr/RujyFMSkYj9F1D5K4dpXrrEau8xCU4TUUJyzqsKTHUc0R/fCiXR87TlpqWKKIhh1JXCoYJcGm5UK2pNAG7gZ2tLA3geLA7sAuooaOEHHu1/jZEllKbVdRuBB9JtjViEXvbc14DX6LFmwYwbqULE66IwEgqFLh+PEIoMk2UwSW2gsoV6RUGf+tZhF9T+ecjdfz8suki3NUp/67dnJU83zgsmTblJ9NUSJCEd6Arom9wa+aq/XCm1SO1wfeYKEZQlRQ+s3CrZXAfQFYDHRqyv1aUqZprFcToO0UnJZHDOdvxQ9Lbnc1FN/ZjcLUaMf573ByArYaPM8Km3tZ/pnrKtdeWjfIbmc2jh47NxBwccTVIyb3fWqkRHLyXVYgZW8QLtK8cfrmuo86v1ZME4h8Jb5lDOdu52/H2f1f44jaKiG557e5omnS/bWcZ4z5/ON/PQMwH2Gk2d/3G5ztLnhmhf/UX6EZv5sosV5gxZcj7B2+ia7ObMMlKYWnqejzU9wF1tNofK4wpFkSbM5W+iaB6ztvKioo8CnyhIwkofQJE90RVXh2eIOwT9v73goxy1l4GB7lMEfA24Z2xrHm49V4xNajpMWXJ8npwlYAO3PW/7uLDn0ZmBw24POYJ1O4tFOTINOwjFiZp0I/rgdiQZ9GQpRkJ1Est0uCV2dBoIXSs9NeICjicwsdOeQcir0uiyUhaRxTgXH3fXEpi5xQzSm/eyH6uazTHNMoMZfBFQFwJw56hu2GpwwXK1wED4J/FCQ8DPzV7td3aq1vE91fyVdxVupq4mLJoVG42OFX+aceAwp7GKj77PycEO3q/vkdQ5XSAIglNzKIPTSeToDr0fQZUZ8b9JNqyLtA4Z0nsJwruZ/vc7Dfy6nd3ewLSfK5mTIug1WGwIwKrFTBeEHweIp9s0oP+3UVLaGGUv2k4pikpVqx6qZpfEbm2LWRdUla7Lh5Y4xVVtKeIQiHTQN/LoiVr4JwEBmGA2MsxD96PCusNIpft3JTivUkc/dhP6dR6UYh3toRkVXa4zPLjTt1obc1ZInrS6pyF3uETaf2u4d+2XcMjRLty09erJtkNUD4Rm5oT/Qg9sw+c+RbSv7JagrV0pvV6+M43Z/BnCAZ73clhs92O2O8BqYR6QT9QdJjGF/aJjEz+KQX75u5+mQ6FBVXwrmCpAuCjRqLG/t37xBAK+GIS1eCwPCtbV1cc46sv33jAXbPuLwnK9yrNdnQqJOzm0n3ysN+bZdFaaYkJ5TXDCfX0kgLdu6ZEwTDQGKRj61merD18ARlAZCA/3Bulfjb/idTdMHJGC88wtZbwwZrYUvKFzLh567C+6floyb4RU2nhglo7Fm31bY82ZCZeLgQYuweaqXMTCL3QJIzhBVBfDmAy2uxBDMQTPiLH7G1EXCeEdV9vXjf2P4Ef+7NWlWalnHUuh52xx5zBELW2eEzzeduTprL/04dmytFbOq0mrtn6SZO07ysxaXvLnn8IUty4R77YnZydlhU6VXrzEcAjgdN4QdoTazwzGwSJ84fkNzPTACmYH7u+lAF3g3j5cYnaiGGKt1Kaq6Ri9WVvOy65XdgK9+88ukesrkc1cbbDTp8i+dNZJwvc0VdkoG+AiCsS1eUJyBBnjsK2yzzMMvhqZR27pYjpVd2ad2nuLNJ+KYXeA9hvNt/TF1S984PjfQ8DbGgJ1bMA0fpg5HuSE4xoyLrQ1xNtsKyt6zxIhdpSOeptatTDv/rPew1qlaYLgUxFFe4drHo23KDIcXZKgjALFE8y2YFJA4UCyK4l4jOLhpuE9s9K1FfDVZM+k2/kwV6lAMJvt5vuMoKwhVd4nal+uFLyrLa66wwWSmBZTZ2SF/jMd5RB2baEwqkg2Uhlo0M5Medo7XsnCD11Prq3Lh9rkOnwKPdQwDGnMT33uiqAtQraiU65gm54OYDGB60q0YAwbGmzPSpmiNbR9QeOqeT+xtkc+gC/94EgRxvTqAguROPEKGmVRuFrNJMNWz1k4M5yszyQWb1yBLACweUeSuDLkAyK1iKzxbbLfRROSiXKzbDuRWKDGXjnO407k8WLzFWvSRcOBKKhvX/hwrmWuOip3xOxj8P+tTzLn7co9qivfO92bsiDpngAX5vVzR10zCGvuPHBkAZg2tlFah1GrUTlMq+wKYoz4qfso9aq5O8w5AQ+jCnyR7peUtWJi2YsnCo15Gv014/De385e3d4HJcoDx+c4bngDN/fa4xqZ4PIJ4JR2aHDimA2AmwONNZPAfU3Rc3XAp33xBVY+7ZpLyrkypXi6GD0upgIgTUo0dhupOxWm7DriKIc6d7dnj+yJ5widgM56o5ck3nIIXR+ERTjaeDo2l7vgE3mdJu/HzhHzL9pIn01uxzpYxt4XXflPjQYxRfcaAQTZeuiIVktKBz8bIwSdZjP3rgHEy4fZrALcizlkliZS4tQBUTydrMlRoLiRMFi5M9Iw6seHx6zDBHfsYb+mhz4xylIBsAS9dCkw9B4ytqhLgIWtTSDaWDh/AacmrmSEZSZJ2h4Osb1Q3JtefLqKLmLK7IWAy/g9e5u2wpFfBd3Uq6DC8QhyPXSdp0BsKOKWgV2l10/Ge7ZUsZBvgwOPtlgNDGopGwKuTVMZPoXzIgl+4nFGiFkQwwYWNSuNcl5dzGAxm51qeNu73hr4Fdc1Ghfy1kK66jhpv4h47hAkVl185S0qeO8cKPpCHP6Dbs0cMqkZJsn3sBuQt+d4fZtTSqYHSKBqFstXVoLPgNzOro0qv3F+16QYC7OLPaeQDycGU+g1pk8oj4EaEACfauNKm4ZOwYUsT8UOpaClt91p/U8HtuDmT7hPk+ks2/RFrucXcu0nRh/iUG5TMTZEr+pjZgJLY5Ilyx7lx7PhMn/FA5CnBivUBgcJnV7F9IIfCPej1q+aeWfFHwS/do2zLjxBqCuUyb9cbK18F5SEZyZhA4tH5fE1N0viVsHQhOFew0qdJ6OlLRDOeSCc2iT4CwGh3DgIL8QcNxMmIwqOydOUbORpsXgYCbvn5dF9WGqP8oHyHVdCq9ByHhxDbc8aRsBxaGRPw1BXe4ExqsogK5yvMRdDPmExIb+UlzKF0jyQio3mSR0Tjm2ZKvCGyn26st0aLvdRdT/QjVnOhbkrG3F+I13c6fm+hmiBZJ6ybyoloDj8uKZvp0T/UYmwfpn3u5s02TzKMjY71y0UWTdwNX/yUHztWgkbDn4c3FaNCuVbFTiipvy8HeLOdTfHF2dodXchpZy86ErnEGdCmjVLiqSHPUYbdjJ9xFXZ4iwMSgabKaLUzyCX7Tv5xQLIaxJ82Nkn/XTYjy32PI7xqJYUb+/qFTshNXhkxBKqqciuEX86wLB0sBH5IC40nCZu5hxkmYo9JHpFhA18kt+xpUDmPg9Ew/4+V/XiWic9kF7Nc6KAay0K0QnnYbkcR4fyn5NUnJbH6Xd8lTFgnUeWSjJ2gVCyYYDCrK7Uq9j6kH2nEl+uHPbROGJEyKHCzTre3ryb9sqRlaI9oEHsakHEomEHP+bGqo8DZfbzQ2K+G5VKLTXEVh+V75EzQJXswKzFP4wGKBWnKGI08IJNyceBGWnQoisX4vL4NFzJFEmsQV+pYfflcg/7qBUezVwn927wHZvsyxEERa/a8Y2Oz9+FY6GgfuGaPv9D67I95cqdrSKtxkhc4o8IGVpF8CMLBDve1QGGg+2kwPE24gxU7ZWdg/BBDGjBFoZviCTKS8JULxoiNL+zqTBxHIdZ0/2K8iB9zka0I7ElLrJ37cl40x1xdRce5bSrW0EhQIl2a98jqoWvzgQXlJztY8ReuWSySC/N7KoQYH8N4K9DUFquT+U1LLhkcC26+NvHKyeHqL62SNwfztOssT2d9xvjPRgTagu6XilnaqaTM4FKfqvE2Vn6hoRrdmoP2xDbYHAg3NRkxffJbxsZQBt6vUH5CB7KS2TUHxt/xeDPkPaGgA5gxNQ08MDZnQ9n2QDKnlewEm5QynT9/iV6PBcUmkVXdOzFtCzZnGJxGxtcf3r6XlUZX6lT5PqCtLiHMnmZ7OJ0U9PFrXPxfAU1B9X18+94zcrFRenXZG14h86JVCYfly0d0B56V0aUIP2op+Psl/nIljw3gKy/Gh4P98Vzi//iDcPtmP6p9McqCGDslvAwRb4J+cV0+FOzgHw0kq6zo4SVFSjOV5ZDChEvDFrjJ61mO1SBrN5KHq0TFlDF+f363rMuL9YvAUTYIJ50ZdnTMvH65n2uQ80ISvTDuD/561BihMpmdXO++Yv2+jIC7PbvaCZlh1ZFA4gcVPTHQ7Z/kUz2x8tbI4xKrC5SCoBnty6EIeNfgEKizjqEkAAAAA');
