<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('B66F9C404756BFCCAAQAAAAXAAAABIgAAACABAAAAAAAAAD/O/iLtdRSdfUKbG1j9+68kzf6ySIlW1utuvU+d9kWgxJhAUp/ktu9IFtlNS0MzPqBY6VK3QmuIwE0tefx+4oHvp8M37HdeEVJ/TvGwbRg2Dq+EFx79VIxwKyO86Lqw5974vIL43L7SrYAT3aqbxPyUOY6t20DJD+M9cmwi+oF+UmtdUwSTCmP1koAAACoGwAAuQOFG4JSc6g9DdW2XI2t75vRL5xdK14n9n7UC8AaLAL377lOaOAdzljKiWgINVZ6EtVG+/ep9nsAf8sTXkh4Ly4cBD9DnjlmbUPfqY3YmsoQtr/yKL0+IhJ0B0fBOdxsnVWwpnliSKoGQZHU5A9F61G+itItx7hhyMsrx9ir4lYDUzq/TSRRzd8PiBVHDLLuiVCbKSRQK2vQK/7qfBgSzu1d1w17buk7Zp15mzu1BGujG85QhIx0M37aE2L8LPKGAYn8nachYX1i/SQz9nLbw6kx5AofFfnEQyVL3lRfpGSxJJ1kNHrsje02HIv2hWU6T1l9SufEdxLMV6mFCT8r+CGUnofEVjvQUw5iv8W4Qb4zwbQU7p1hsQW4m4JO2ADpF8m735p1bNF+zpDTtT5TLXwExPGkHyShWMTmP7q/2FOj9nQRiXvd/wQVarzv7GDACmOEXp8WMe/FOo8o9ge9NYZsMG4CQMWUm+219AUFD0MfC+sDrMDip2uV4T3ZFVfLbQWoupGksI8WaR0k9G2eNMIBdLbEsF+R9XYvl5pzNWJ6gxvyvT/b++FVlTijJOpd1FBz907J4jS4mJmT3XqvGZmfgwmQnryHqXgIj49UNzNyH83tYVO9rQzHy7rxqgguGReoouYrvyS+ts3NggrsxvcBSMy3zC9IhYxGdi3vSwBy+PVTvAE0eQWlCPu2v2dWVTfdJOWVjhTniUcC60qn/hnHrEWLTauIv2jC+vSJHmjulzNGq0vLjVYacswPo8aHyFpjFV9clP3IBk0yvurTHroDNWX+r4kSwhzN+zpzbBGmsQVJxrCqCn51tX9FAhcAkhvNizgz4YcermlTTl8BNuNRVk6cSfis/XaL7lFCnKOQCa//0KsU52CgcgyIdPb4Gn7v6hR+P1zFrAzP68AEZZeSZxO5PD3wrCv5sA8xM3DjA9pPdYIw/KlsfZmbNcVaUic67GD8xu17+yBZtBSlSDqolmEoqrZyy4iJ9iRgIytKy3h3empNSTHmLbpN18gymTMYEliQtmg6vBTHzsPrsDdr7tNabCzEyQCZ9e4NlZXhx7XXRbI7wej1IxD++iWqGT/uI0xp+rh/VBMtWQVxkFGI2+YolWIW6U1mILdiDs+/84+B8uWhy0gmnd82OyLIp3DFkZ4qDVXMOhwauvG4e2MCGcJ3TGPELZ7CJioBeIKq5usDlnmcMs0F2FwsmUH4dt8TQ3aCV3WsDKYXKZ8gFcE6k3ofgG3Zbg6Qz43tXgP3LcXbISHZJwfUYAL+vy9EREZ53BAvmCyEij+0AmJJXyyIpJuGHlx0VR1dF5A4RoEjsMKPB+eRiZTLBt6y+3k6ftiixztEMqRSNeK8zv7xT4T9qc5Jqsxy9YVx+HoQNqQ5gS+GUe35zu9t9rZ7em/t+kleopECAXfyNkAsHU5QnekVUSaTY0WT09O5olQCc+FMkH5gR+P9Bk7NGQtABBGIH2pITLYnD3M7MSxy2whmgbobnW8jB4vMdB4Ckjh+03x2N9ENInHqs17xznDAs2Aqv1s9CPBK6nnWutu80OWW0VwWz4QFxmHmpzlWPfutf+RWSCnYEanR6Ee78ctULA2JmTFSE+5FR32DPQvAdbs4hLy87aIRtPpnKK4UfKV2QT7+vW+u4PFNvG16xjqmW2yBjFlHZh6GNysxn73QM7pCY2vwdunlZUFQYkUcXpDlrV3LvIQ+Q8KAdsqWj0ZBl0mXltBh+gOc2KiUhwUbW0sMwwOTIUu4Xv1Vo+MCHgirsNYuAE9faIoVhii7vd0m9ZTQ1zg2zQNEbH9jJvDn/xLOv7f5DASUc6ZKt7pQ0/xYZUTtCELHvcHaoS2fSkhNZx+dZhsku7CVMM7V2yvW+BvmJyYoPMSCKKdJerHm4ImkCDDCYXc6WvZHhoACNJ91F3GhDkLjREpD1xoH2nYq9ChFXUf/JtKGWiiKWUCvTlu2lXiphkNgCvmu/h9za4xndCRvBLFACZyEGE3AYHXtHuP5uafHI4r0nJlCKMh31DhFIs+f3GPvdzoerIgVf8vpq6kpMwGbpDlnl14XmFFFR2oLQdy0XtkXlRGDGAxD5QhYIbgeEfGlrZTDeKGrn4tnGx12Eios9NncxUJVPV0UsFKyMNsniPBJzYbieyE4+98u+2LGXqwp/4yCjotyCH04WDIr2WuA4ekKWtzJzRqiDdpirmkgOmHl9IVLSY65RD+yWzMzPPY5mDFfq5NmFKeVzbAklt5bFwtEYH0YQ6T2duljx+il7z8xuyK4CeXbyDooQDSJh8/C8ieGt2VDEBgDKq4h/eDogPdqVKCtpNnGo936Gw8qNIWviXPcOwP5qgZ6mCSYSK2HnFuwD7mplVZ/2R3l0pekvsSv8U5ptyS0biDotvbTgCdG26w6uV9n+sUZgLxAE9eeP/DQR2URPCWFRqR1CDVB7ECX9KtR3SLOlvDW9/GCdBAbYYwLBhzX4qSnz1WAHhwi0dE3xmvxijmsvzjnGvYfIcL0SwkeJyP8DcPI9zaIS6B3C+JiBEC8hblsdmkvy47rjTlefCRMW7n2q4cRyOYLJLZShSOCTa7cEWdA+Fm4kLeQe24lMHybMhCPE788SQRzs30GPc8uTQDTijgnCE6ecFZm1bHz6r8pGxmN4N2mweZbykJD0GOxn81aX18v/oXnbERK2naWvt6hYpx9bXRSdRKZjJJ+v37MROsJdGNYQ+Es/AMizI2fsWW/uMM4Onq0O/pqgF5SqiAByv9TIJ0myT5eDhde+x4f9Sz/ZK++Ezx0iiQNS3jDwsLYl7I9EbXwaSuCeYiTML1mm9DS0OiATSU5ec2qVsJVAsmyiZ4FkVznbPO6s4R5+Xg/y23jdCCdN9CaYQDKr8U+yIWUzpvIFH58fRWqXUM9l54D8nL4YCwbdWlT1d/SqU2iA8Ku1yYHrMTVAZO4kqSlkNOgLOHcBgfcVU1qVDLtAejIbDkSpydatGHu9F95VlSSvAxr7G+bFYxwu45fz2IxDBTRkVmRKXZYNC+lDuGQbtvjvLwEHLoOIRM/Tt/FoV5HIPsaglbcoptJNKtXiiqCyxnZwdee+RLUyxAoVe8ZjFqg2qgrUgzgfxIuknSoYGks+ykKtnGWbOvubeqM/s8iJaPPcc7Db2pz2qYofMGPAtJZ9PHL/OaTlxaPTZstiqH9htyFGVhgvlrpfgwmEepNqqCnOtTSLmqoSl3mAiGfWgXXRKx1+3Csa4H/mMb5h4t1vyEieUUfpQtDUVey+go8q7GOfkjgc1JvdCbwi2Q1Y3ZycoMUmgnscVDlAvGgE4uTMxibf1f9HIUfTdc37SKtce/95jTunpXbpF/8SyfEy8oZvQEBKUb79aT9zSIG423kk5O4on178CgsyPsafqV1YAIiyDCWd6FgHXciddhswItCaiW7oRPjQBM2tB9fU0rrTgQCV+vIfPRVJpnab3m9LsNgGRStlBA6O6xBUjGfUgOLqUxIBOA9BhzjSiK3BdokkY+C0tDpzwTJqN7RiyNROf9+W6wy9CyFhXQH9pQgLFZH3gW4rCTlbbz1C5N8G282zI3wpEG/vq5Rx7CZbB0iycdQiz5gJ67BCAQJR5U1YCdujgvIZS9aizC/wKaOIev/lqUXkyqApWYX35Ypzuo/WrEHiapCdK/26HzFs875FBIlCmBeQq2vO9bXxvN6lC0zDk2Y6Qc8bf14cbw57u5qZAxAIIzfW26PtLzhhqV2ZoT/arsUWwakWdyu8GChY+K/pvI8VYoV8DaAIFLqEiv6JzA+5nlt9EXeCnxkF/5HNeBny7+yCytlV0eHE1R2zpSQnKDCZDznsvaL2wW4HT1sVTSwPIG+1XwIQVJWwPwfUl2S+e5yLJGeVOxCyRderCo4Drg8BHEuo3GpYxn1nhjJLeh2aq9ZN8pBSU/pXRZro8fd2IJA7ASAGRY0F4PMlNva8LpClmGc5L12+F7N63IH8nGH+o2vr0v425h+Dr1KItWuhSuX3vJclM7vndHQHwy3qo6JXBXhjKHPEUlkTRLSN3FqtdrH2lBFX241iWfGpIYvyV81eBqJ9IJFOyAfotUQDbqK4dzsdBd7oYTFw0V/ZxshlxVT6mel3W1GXPP2VXAuNUfPe8r1Aq3CFKEUSUwfqM3dWAJZhYvq/D5GHiNy6u/bv41IU3w+9UqUHkGAtcrZJ/rsQ8cktsNplrXnAZqqFDE1LORNUS99jzsbwVzYbLXl5aL6yeoBtKFHB1O+2ZIN/lq0kFaRHjlhS13BUR+WgpykcT0EKX2LB9dxY4TyficIfwNASc0uqVAokrsnN+zmWzVG0NAno0i0qd/8icC4dM/8eIyZvsitQW0K2Y8nNtTUyXRvBEyYpyVgjmW0uNN0sxQkizcjEgiJQH/y04NeIR2fq/2PJgamtmsNuH9KcDbVdg1fw7G+YuIiufmCFK04FTL/s/j+iWc6lPv4WP1RV0indCk8FeKrNb+io0pkMy418nYWrITLvS+vrIHl0jpuEGngaGrMYIvRcbEm2661d7YWYdSL6glNlRU73G0wbBx6vPYKAX8ODfZmveRdFioUYi/cH7oehFZVlBAPhO8W/spuXaXKts5a/y5gXrgH+dLgfz1YsOuHqGXn0d+L8JMkXwzBmNs5yQWiUAERCq/FLRT4sbmgI8unkmgk+i+EKGDOzHUi+ATSQW4WEOEujlOe37EfU116pW8TlSYy/vXz0DoEDNUbfa6UY/hxlNoQyRB/w9zYOkjqeqf/bXunW86QUSMxCR7rx2dhuaKqBkjnCiugbA3zD/TfD270rwF3Q4BeYFmB1wYOfvduDzMXAv6NsSuf0IIe/pZvRbSn+D8ihhikTBZh+8asi+6cH9czNPIEXxTjeA4mbjSnjwsyu2GkJo8BcecMOdKoFh2P7jMdoUTSjMm70SOz9bdpKqwaDsuDe3+LRzHvBig1Vp1gqb0REiWW1mPdQbpUy2qctPXGBhi59UUbgeh00Ox5GVusxRpZIfiIRdpYDOIV58EcW09rnQoi9MY89v6QOp9XKIYKjb+coWc5xzPerSliVjz2VUaYU9ZuOSsjcCSmOrt7u8QtA7RnqKYgO/urtAarhN9wTtTAZhVhbcHWT1BC+bvNLAELIdzCVvZppTZfvP2M8cqr2y11LbpkeydUNIkEibVnFWmJy7YW4LQrUCuJdzymMTbbV4dxqjPF+sz8gKkPidwDDLB5MTFjME3krJNsu4CV4bhaX0Bll3ir6b7TChTFL4RzNyBdaEXPj96cAs5sqt/bb/ivvUcVyeI0VKjcU8fDhotaEhchq6pIwBVJTw6TI4DNgS4TiWEMyU1RDdgyJ9JrSv5m7mPjwM2UALRcZQ3Yy78uABLGeYCz/g3VUV0b5OwmFwWemovgmgi/2pJuK3XQJei5r0/bQNPFiHyGWwwTRZ03L0fzmAV4Wxhj9qQRKTolZmFNgu1jjZfmnA1rZia+g/iZFF4cZbl4GIahIorMzmhH2SWnytj5I3krZ/NuznE2KuSI2G7qQl5l5rBdqwPR+NFdCz9DiMyXVbHiKCc29/V0yvCP0k0fPtJnB2BH6G743TNbqCRNiOnvOH2oIr7g4KxcIZvuqRy2f2XAxPr6Q9nIPL++5oa1U0VarKf2ol2hQ/VHWv1s4DjVXBbVTscSRstEXqghC0Wrv2fb/nlc16rWbTUeTFrynlnLQWxrcjquW20Q/u9dpKhK0TXF7OPsyS0+vDgst1EKYZMW2By1XitMH1jU3BsxgiCtg0Zbf7GWqbeun6lOiTk/MZ1a8Hipj5f3vGAq8+NCeU9z7tG+D9Vojbn0nanHlIMr1NaNeCXuePGhq3wof+Wrgg4INimhjFqPLjJs7rWol3BoU+JIvNTi+fEz4gVCpxEsgcHyZGRjB8C3fbvpXOWp5F3gfGTosIiZ8GoYR623yzZ4Nr2M1Ca7KkJxw1clPq6FSKx88v2ul1GpNu8zLFQauUClM++qTq4aNTQ0mhLMBknTIM+snW7MJGuNuNJu8bjzAKH5Whg2p4eMzaTgnNzg4heU37WMdMiLhZKhoJaBCTEJQwpluHVWV1BQhpyrHcrX2ZIshaOKcCUzUE3xldBs5fJgRLS0zwtLwXNiqrFIct6BVoJNVq3EpreQ5RjXq86tHg4xG+xQMfQMRU9e1sg5TYpu6P9yFdhLt2Jx5c01x5PSlgTu6jWGDqTc0yw2djDRGGfv5Bi84RYkFhGk9QLTpp8MwHEgqSnoB7rOG/UaEek4OqXiKXRy+13StRvNNxJ2zHtA9mmU4LESJPywk4pjvbe8wXtXcP7xhWhI1g61sUxhDDWXrHqoxrVYOWL9P2ZyS0tQP4qky7BisNT1hnuEMCmotaO/TeVzRjQhbLam8r3HuaklBSrxGK69J8Pa4E9yUpvOshgyeEp+hQWq78e4WbBGdHTtrFYuwu+YbBhoUJhZnigKnGjuHaq1k2PoqzvNMeMY+FK2FinB0b4VOSctpoyRJt7/P1lsyzY0pVhLEuuRZPHfZxTnFakbwwNjRToG9RaJYq6PpL6HecDIoy2GHyiZSzFTzQNRyoI/1LHvkj9XTzHFyTyLDwwzgxF89HVsSY6iIWJomjeCWhL7NWaO56FmrQiqDcz1VO1FLH00qp6+CoaNSDT/+2YQFdv5/DYyrLN45/CE17R36861SHNfMpScs3rJxCc+Zu8kkYpeV2srkxIdALvBniW3v7BHSgw8LXOMA90j2id1YTprNYWxSnWokpgmMZhGBuYSvBL91vnnm3f6AE1oED/O2gJS5BSPrTh/23zZEX/jvRN3hNe4IqJ7FCEHyrqeBr72myG9zToOQ/nDMFWWI5X3DtTiNqJo67oylESBnkNJ8uBcs/KCB3wMYI8YQe+NlqTAJzpH/Eakuz7QbAlZx7uNMhQTOHdpzMhJaeeDhE3ChEUTWv+Ea1nFSZlQuovM95zHoaIge1o52e1U1C1KR5uymlDhUsoZUuiiIoDRAeHF4l5GcZVd4HB4SBH1XRW30g9LaM7hdpTY9X0mNKpvdXSs9gaVNVmxnAYyWNt2WfaOQaXxBR5xRaqQdYxFaKx26wXcuv2qZvUH7gMhGOE2N2BucCYN1nKMa417hctSpBGZzgqOtKmMqDv2klTEQO8+li0Fn6CsQBMxmnKg8bs/J3UVhRQ74aCS7NpS8gvJap6+wj3YX10hOAA+UPm3nOYdp4i1peLGNNmYAGJFMu2Z/mUbsYAu4hnSHIAG9xrS78sO4Hcpowa1L599DDy0nQJe52DwcdXZzERN18HKAU7PCaPHRcLZ3s/B++fDkFox4vyiSzYo8dlYZuYbfW6LYOjUi2XiPYOGV7M3FPRiwZtFj4TCfHWp0vZ/IP+WE2q1HcKKEL6hvNr0/HVUlzmTWE0YisuHXR7Mt/Ht+5EslbXeD1qm9cpr1mPQht20Nzz7f6g5/qpYeocUpBdkULtAsEmhQ9UgahoC91Zo9js/v6pSgVEW60ma7imffe1qkh8bsCBeYekpglkcxeqsV9aColOj+aU5T6Xlb++X4Tw0onhS6w1FL8d0Noan/MYCyBIlN0UF0DRKFq7PUVBeT/Kk84gyr5OxS8UHKWQfnTFb7CvHNRHNSvitJd1jp2kk/WF/5q7OdNbPsqxRMZfmjKCy1fmB23j8wBi124NuLzLwzr1ZKprbsjjT+InGj6q7sYqO1PJ6WIS9fISD/BCFHEJ1vmNt/DlDHZ6mTwb3+lNz5AWJjRFjn0Xfls46Urg8O9EdfIc/XNkoQ5tnXi3HbPrK/8H9JQytN5sUZZTM1LeJIBZ7/7rRr2+lj1NrxgB5b2IEVrzBWjuAxvkzLNtU16qjPDkMm8piFQsXCjeX7VFhFdZXjFR26l2QfI2sQCUpVplZZ08OdGrg1k389j7zSnqnbZQXcCetTaEVMaf47fq0A+1TQ3tBUWo++gjg83Hu6K/NoaHgoLfo7U5/Zawj7OycsZBXYcojf3G4yfwWOVAZG1Y9jeX3puDx8UVdHdo391/Thy+GYvfoiedIPqgx8dI6vEmRUr9SMyyie6012j3eCY2dki4qk7blxxR4pwlQ/hoAyrG3Wl9g66VgU98AmnVjD+pRvA3PIHWP0BvxntkBYY4JDeWzXQAdf2ocYXMJOsgaoXIb2xXEHcwFEfLPMf7bGGEbGilEe4RL/ENNoxtDr4dHktHQ8onDy75ChI4OYTYsR9XlZ6tkmO0S9hZQhPg30A6D/3+2KsxkBDJoAlQRWUffkwmhnGjBnaYxkeRrt3A7yeXpZsSQsw+Q37lodnxJstgslmuN+y7jDfXxbV1sessxH3ojaBlcmN0TnBpln4CPHVazYFk6aQ+sym6FBXAf4gMAV6sQmLiskWbX7WdioYSWkxcZ53Ykv0+HUsC6FoEyEeLZxJkqeC5HGPVH+hdMYh57aiQuEwsQCYPXfDeaKmXTIoQm3FGw/uG4fTY2jw8+8InG6PYx2f8BRfDtuxDiHeDNlPS7msuBUI0fEp77IdWy57WmVEvNpyjMmm5aSsNo82fHAAn7fpVpgCt0+nXFAcpuDL4w2ADw12hPUDjlef9y3Fyoyeh4XTnYShOkg7mg0vyUASrifgpqIWSvphNXZ5VTImfnfIF4eIkeYDyDC3b2qifR/jKHsERUUVk7eGSWajkuu0MdyX4C3roEnLzWMYmG7EGzmrLG8cqq7lTy6qK8sBeX8x2aUScdhvHTNVVCBmZvkdvkNPGqQqjzp2vit7v2Sdvm7FkyjLnUGoJPy2JHWxPyVvrlCwymD9X/g4MBv5KB46+1Wr+fRgQZkk5yhZ7tiw0FI2CDmWR7mc9snl1qeNnpW34nG4htU+yGBLlV7rNPhjdbtDegL9oPSfIhnGdcZQylrrzyPbe3pgHlDG1tKanCNcdLej88USsQ5ZDdR2uveG9T0GfPupsd2uN1vQzyrPdM3QC0XkX5oeNP0F3g3T1oNC0jRM5q/YyMmYWopWnsowXc6oJzi3P+IbOPJLTrz6vmStwNkxoiPwxqnp/C7a3AWjna0jo4YfKTo2ozPhKqn6XpXw7m7cDRWJq7Hck7MOi2lHR4E07Oa9xq6mbe0HSepeCxsc65PNMZnXbXPvLo9dPT8/GkidkFhAk/v4Z0S4oT658YVuafRpD1ubS6MIniTZLVdG+GO/o9ynMKCvAb2kPXMGQZSC6tTyHBJip+CJDBNwzxp8dxF4XP68uVTPtPMLwE77EtctNfYvCCeeaIi9i7FUVTGIrAfmNxU7sIE5H96VAu3ZltdgtxQbZ3h2cgjH63m7CmP8bHMig3zMTdUGgRpFvNFEDUQZK2QNlpugqp6q5PLTV9nm0nGLNbJoUZ6G4LP1j6bXNzK1pMgAe+W3GQHZV6LHR9TbBaPU5ZxQ/wh5f/V+yjbMHkBFjoWSPc2ho5soF+v8xZaLaehivEiRdorOiV59Ol/p3Yj5BZoU/hXf4ZCAAAAMgbAAApiu7zjTwAfe00KaXfxAAXDCaHlmp0ukqELGBwW3Q8rH1c7XI5wWEKFd0+XVWlMVMWUv8ZSOsEllLF0d03fxyFDx7HdkUihdqf8/HQMEjtD/Y26WYHZbnyzATiSb3Gk0ia5NxVIjwgB8eJ9oujmgYnm9AqHDsfJSkdz3yI+owQ0tyh7bpcVBIXeKvahfXnviPfGNq2Fdx09Oo/+xqNTV6h1mvPMojp5eIg6nWNafRk8Aj/qD+IHMtIsT1MdOy7bwFJY7VKKQW5/tz/MkeZUYOVVc6oe3t+2nVOIrzAa8S3tFUHFZOpZoqXZ7b1H89XvQceyNsUWU5KEFi4Y7figpDy9GDRUU6vqRX/w91Sfx6w3pgxNDruiAmbItwCqkc9SUvtweYLRoItWoTEjEfkf8sKzcouTIpOJ+sGb/6ixqaIbZWczJxM3PdXgRaOKKiKJdvb2nqOe3Xr2/LBghyAK532T5ef89KkJ89526GWL5RKmjGcuT4LE/obv/uc31dQ56Q2xsLt3gkuAp743JHnzo+ZSg6g/dvm0AIF2Z+KZJKkw7LonLRRZSb8QzceF/XnFeMGTVBowsWVchPSS6TKrsY2JPUZnKVrKZFq/n+qRi6B++W282v5Bn9NUDvJw3pUlxF0R3fF++q0Gkr67Ng65eRzn27XNrXrmuvc3P/4/dVRyvd9zvGpAHq+BPE1apWH8JCfkCEemGu/BFazeW1Vfg1c8pBJ3gEOmqJTzaqAcVqubnQAkWoeY9uSgPQ8VePoZwRtdbd7tpEWfdpQZTfqj8fcJAWj/KejTbr0spbcoxl7BAFqKjB7RGkihVwdfaWfBBIGg4cATAxwm/0EtiAhKMaEnCG+PfBjhgY7NB9gdVU8XDYhnwA2XnHK5x8JrRL7ig89ctUBqdX8Z026+40GNoscD1UtKMuQfyl/ZHAsoOALT1R9YRi41G3RpsaWNCl2q5JuZjyeIkQO9iHWxXAUlPEMlIq7PcmhSGMGn3MvyfNcDFq8GoWJZoRLkGRC9SCGuGIT6b7sG4xnoXkNYWq/EwwAVhCcVrwYYYKWt7ng8dkEtqnIyMdUzFPGYVqQ56752YFN+Q5sYB7b56JQPRHqANyCREuvL0KpL9QF4RwhOK0BiA/DMnxrsrrgD48cJly3avQhhpd57LITofd8xTQz+Jm1F7azWpSeFWN9ycJjwcLLBsZ5eQPraKPvfdwrMoZOSdyBl3K4sZgOA6z27XL/sBxecPFYJDeG9YkacAlCTV+GKTfBsJXobzQ2/yJrSvnO5Uwc7j0P6I7UcNe4GBT7GpwuhAGz2tmgIAucJhXWbzXdhnrRFuREolyPHgEr3ph27ht0tggVuDqUiGyyjBmWUzW/O2l0skC+bBUqUTRqhizNfc0HqjxptvCdQuqOWk7rZV+1MtVlu2i1pYXYVMypYYrnXUlZFpq/G4Fi7zcQv7S1IqXUH1Y6TKn4gvcscggNHflv2PxOCc2tUGdTx2gUkv2R5SkLaBnNXxNLFDkzNQkZ+Fr048kgRfILioynBh/zvyjYVMa4U40TjF0IdxCN1vN5+BDhHXI/WQrj5h8J/BoXT2yJ4Q99+zhF85KedaXRRjlvGbrmDfS0NldQU9BtTkIjP1SytrDXfLxOgDUVFMBL0AAa3hWuzY5Qao15D7w1iA+5jZ2iKqI/3h/CwbobJu0JjOVdNMbwjqRWPNIole8GYMYox9eDRp4Jc1MmM6GCsxsqAqd2ellnlnjuGz+ohDPhV8yfreJNJCFVw7aMzJ62b+Zr0eGTOfl+IDxhVAjMlgBQwnVE7QYlk3Fi1c26JyptoA9fO83Dg/d3Qfl0XKaTOaj9g4K7hAiSClAJYMJr9/pVCsNV2UiUTFpoym/QwNbyoIdLv2SS42ftlvcL0L9NfpIAApXWcfGHIzWUpTR8XqF3g/JWPIrmGopDR+LxtS7F4m55qDr/CReM0ycF1XUeR/wgUzCEIYeoKl8TjGgRKqxIInZPbYw7197v1QNg6TgrgNCK+U9bgmYv50znTC788Q22aNGpHHID/RjaWV0xGAjgjnuP5mM/HHYIs83Ksuzw17gFY2zAmmFJwvk6zG/HyoC0WqsIddZOZDaHm59h0spW3aBbW/yq4YY6PSoR/l/2iH/8C9Y0O/0VA6pxJEGgxCxY91S26pRecQqnt37MmHdMxmjYj+3WVoTzkllapFT2JuM/+MYeohy4K7DQaezRkY+7KBrdh/hc4IJRU3Ed52oRy0J3UOw7K+iqhOyt0LfHqW83YF4XfFJ25XF5qpwjE2aLmgFoexH9Lx+rbHaaI08QhWGJbpUDDwjPGLgWu/gCnKkvDUBjuGLF4RQnVKEKPbT5g/OivcRpEBDyVBFkWWFdAoGL3whFyVCFDFZWFbeNewAiEGORRo7VCN20FL8hHe/4VkkgF1YovITNon2BabFT/gvpXaiPsbN3o+wfPoB0t/aco5CEkdBEnnH5QiuLqGTKMfBJQjhFK0PJgIkA37hNH7UUQsBnmM+tvrVljqdb3riuiVroHZ6s3bO8IgG4kZNG8CdVhUl6HJqks0ztnX4jH06tzd77z6h39eUIOgs74VO/wu7isCFC8FyZU397PzaZo6kXr3ckQsCIZzzQ/XTvf+01xEcWHSU3rfPBK3pC9DXU5nQI7pR0q0Wup8wgPJ4WJRieqhHK5XVguqPtUYdgRCN9y84CjHNgI/HgtpNSEMLf4jSvjv+I8ayHfPod40dcBUXa99kz8kI87CGDxmmaK8ljEOK1nretqkIM7s+Ts2uR9mSLvOnSfkswhCxHzkQ5NTUyXL4XzP4GjNMRrz3okxK/kCifgN3cwA/5KJK0pxL1jEx1cchXvh882SsvQVnv0FlMW/YQD97OYP+UEe4O93z6ueTTFD3znKKIkVLXNE1OTORn6BEiLBG2t0CIDUCdsVbQFskVcSfG26gC9ESlN0GuTCskyNLbqgFTBAivzkgvAk/+WyJZgAXLkS+9BHsfKoRfeX/ceY2MY+Jd6JqaedlD72cACmLxvNSbAlsjkHnFOrlsULZ44KihxIKuTl1Ha5M6ofxCJPddJEfdrru039MvLjK35be4cTrOIFbtDj1aQCskkuHR8sMXHg7N6FSOqTGWm/L4qKECIPTMnfVLETvXTQ0FgOp9BBjplIjSc06W28ENlHcakI1473r+jRWA5aMdz3iftRlJmyGoaZk+JUf5ST1ZN9MOenbHhwYXaFNtT6nA3RcVJYUWfb35hX45ET1rgOOHkOLVqau79HYEra28xTdEhj2iY/FjWbuyZnbiFwzsawyg2wwnlj8uEfyjX5NLoDoLKPi4jTvyrRXHzMHu0LfYCG/U/RVwokUwluyMWC2NMCpxO4d7EUOqbAlyST2LurHU7OJjI/Xos75yenJYxG5I1j5Mjojfj+rPdRqOn33I/jqJv4VqOnVHU2Qf05io9Ipe5Hm24Qn8knbdGZYyx6Uf8j6dtAyQ5RBs3PwLBY3GYIXT1uzwSXs40SlPizViWGjchW1+yL3UPcveu7S7ncYAcfz89hygVfpi5nvoqTw3WeolMLmGSmsUR+sZAJ+4ajFDLfbVcJaq6zxz9G64cBuTJP1IZYttrJPh9iy2oqxHD48f8VDjL84SrjJqHGZJrIlkPVfu27R+3ZNVOvoslt14tpETzDptguBzU/TxFo74RKyoEhjsD+WsA3pgz12M2E8Cr7L8YZeJ0XdKKUTd2czJjQE4LGZay+rPF15Z4IJaHVXW1BqH63aaGwt6tItYJvUBQdUgmf1c0QHgN9ZWz88WHzZse5uPzkkgtc+0Nts76NWqDzH7D3mQGWqtBBSCBDzov3xjEj9l7+h/u0nof+wBix8LrNHwfCeA3n/xaYHjwMskPX83unL6urj1PQuUDCEFoRqpNW2qTnLY4Bdn3BWol0G9umLIlY9jJvW8FvmflqLisaBaJhxFPBzllAbA0YuNiuE7xd00ZIJs2c//bAr87g+vu1XjizOzPI26oQcmjpv3mpNV9964+7B3qTZcw8nOepLC1ddfSCQqui74ZI1sm11MPLAfxUtRkBQp/iP5srCAvz/m8IOL1vlhIny1HNS41McyOuBGkEXAUJOCTBleAEpVxPNTMKE3B+yDB7QMTgZcm8gP8yvDJW+BBsJYHudujMg3ynhnwqmC4RFlRWoIeTspT0w+S58//JS5y1LY6X9UjFtgeq1XdFxpECOxHyQlMUi2v0YWzCp3WJh4Gpo+I8A5o8zb442VAy4zT6B1MWYomkyttxcDQTv+8RpgWNpAHEl0Haj7uBNwFpTAgiT3LienL+r4YloTc4DZeBaqyM0GSMxuo+uvzCsrofXpT25YpwoysfSECy/CQXWMucsHhvaMf70oF0D3HPfl3okpXUrTTwEBv9ICnVIWwZFbHNo7EX8IH3qNeJCcpUL6jPeFgXlU2p5H8amNQ2PQM0BFX/ULzp/pAibgR5puZkppAFMsHavyuOIf/jz4QwMENW/2cvs6OLW35AnDR8tpZpsYNwW+zo8wwmLRQqFK8kec06Nmf3SUXd7N/titkDZeQEQDJyRBm9BKsNYSjriAgYvSlXqoA11GSiXgvi0+nEqaqDRXSx45zMzRnlMayZUeeczSQOqZ4EpanBccHGo/yBmlcFZh5Aat14etwMDAx2DGVw1wQVzwyLETAuDDzza3rURbDkWoRkAKtgruadLuADtDbCbH9W/Pg3KDoMUABFO5zUc0jywzJ//QVq0A+SGd4iGVMCtcNzl7tAOR8vx3UNnQVQmNwG57WXZ+TMSgtE7vyQh1xWY4w5HIIqUK4jkHZTF6GxjssG/0kU04Nc04Onhv7JPo1LnSa7Nvlj7CpZ3GgMYFMRFhPQKE0kbwcoXQmvkhygTYwU7mO6MVEd+cC9dvxZLqZw/UhDjx3kbtIOVTrt3fIrffZtcTkXLm7EVVY7B+aT5AXuyFV0O5UNSTWqexGIThYlSLye8Fbmun1UulgZvDqenepVZukdXvKjKleJ7jc6ZyFz/K/LeDfJ4S/gpB2u8vKGSbjZwQ+C7BpWLOMKahmWtSGznPXDrhlpu0/b6zq6kjsGg76wbFd3uW41uNoMI26rje3P5tbNIitbKPSqcclQl9XTnn/fldDZXn78c55YZxFc89eyRZwE43LZAKWs0LbwhkZKy8tZ6ruT9AIqTpwLKdo0TTNPXZcb9CeNStosGzx20JfZaW/8/TwyTMTHtGAFkKxZEBgkq5joXgqOjwnV7Jc4bFE/2TLCTnEW0XzLFbER1JrmWoHrhNYk6gSWyRBZsuuqWl6LuTiABTnAjN4X3h1Zg8H//kVgCEelUyeNSE3Uz+LGsLfunznnq5lpR4CbltWjX+CLoqcG/1tAIeYObPAF5cQRYZptSNKmxhoRzffkAMCPObLRv6KSlTWwPVpSOJ4LF9A1v40ibPCTymmpD7yPZPDs6DyIjDd1FjuM26DWp8wHzQ8inFMDxsrv+Pv9NjUa4Nv1Mr1nz/lFmfHgrFBTS8JFcOv8kfnwVSlPOCzwqHNZpN7UOmOjW2y5cjNXzWbDC+TadzQiL1DK23Vjv05Yi3o2z727yoLLWwXGz4nVW+kQgFKDjPTObumKXBahpmJi1IVp8z7gNvhFoIxwdnsipJFSCxcLBalP4jBog4gho6WyjI98v5OxcwSTNVPn8vbDX6flWXiDYP0SlkPIa9w2LphN4PnVQnCimXg9DTTPJxXnQdXQ1Dd8uZz+aE94BzsVW5JmhRFw+9sBLqWdkGlxQKE5J0dLGNTbGhC2UnOQ0A4geIeduijOxy2/65t7ALw3Keyv4Tjwh3woOIUTpowzrH/o8RZ9C99CVq1/Zn/BwoHJvGyurQdocxqH3dCWYSf2QMjcN9gVapruwjpDvRpc3PppwBCre/UQHKg4ioUGv+s1QFpAscbx0mKtCI03LmLMGAdDDB8QYLos9SOVeU/xjKTuZ1wi2BPkLpgYaM5aCETCVj6a4z9y7biziDu2ir4YcHSYEi+IWdy7IaBw5ys/5AZOaJkDUQGZ4P4xiAmmvl7fjnlSmOGjNzhwnVdsxekCaBSjD19+FcQnVF6MEz1pYCTAHBz87mKNBEfWYbPjuIsB6Jxa4ApuEy+3192qKOjjCticmZDKHWE7MobhbYHj06Y6O27/IhxNIvWC3Biyo4F1KjGJ8aF4mtlKLi2LJGLp+OwSfX1WY6Pp+bCPSRGBOx5GCiF0aPOCanX6sdbB0FlOfyTOrcgv1tr4/Ku23mvlD4C35vtNFedb7JZcFYDC2FmO5ANMRdZalaqQormo618LhyCZywHNMftfIIjlfB1TBlhW9hfflXLZDMuSpvY+ugu8gu2Uns+3gPNcCPDWwWbQiUpkd7g1qa45QEnB/aLZN6Vg3o1++2pX+09ENfd7rPFSvyAEPoAJU2brNQS87zBGJSbDisphxJzqmBXM3laCyOIRvE/7cY0+MLYZeEchUmkH7ZBvOaxuexwv9F/hIf0SyDwxDXCtXfk3BjzmY0yE4IYWPVH98hdHJDcnQzw2fuvh2DEA+m3pFekfSU6Gg7v1gU8opcAXidzvtJbZuN9+uPf/f4Ly5+Z3/S3OmKBPrLhCyX/o63Io4zS8oqk0vtZfq3RHx1X2ZeieUSbTp3zxLzZE+TOVHUnKE+9wb6y1cqUgWd6VluQzJXiDONnyeU7n21WdR3HwU+d9ekA8U9ap3nGo/UXA3fjeHtsyrst7mszS0XWnOGA/FL8h0vKp9LH7ekY9QCxPf0xBtFOgmhoF+ZqlYQBEFRzlPR/ejSUTakieKTRS5+pBQm/IJI5XOnGAXJkYR3IfNWwIjgz8LrzL925wRKQtSppm2oYOW/ANsGcl3vSNGJ1B4IwoL+CYnKHSAVo4qT/AvpXgh0ww17ofV4N26y78KkUoeY6W64rx+A+K4VFVvo1JRRELXISRfRRwk24Hn4tjGrGGta4fKlS2iD6povxDblktb3DlL9tO7IFSCvPcvH+FTOP19Zs7gYftECMQjC89NPBuOgdP7/YTE/nAnE6Hnrb79iHKHIRrWWJZF32zpXHuqgapbF6RQGPHdkOK7lfghDdY3PbJjRoAdKMSVF6Icw2xfEEpy9UfOw1JOEivcdchheOL2aoeN68BMNicg1DryLFkrRMDdfjhDJnhQ5Z+Ik41eUJYtI+NIdJcxXP+vdZatZzFfK5PxDtzL+/5a28b8nnV/1855FwQbjyWUpXj0EK8KDHw1RnQCEwatZx0FIifWW+yaoEG6LPuGjN0h1o5ZRfE5Mko1Wsm2ZZKXuNrFiUpH5LnEEhxJ0HilYQaFRpceA0iWiet2i9i0E316hpOmfEYZjZEcJLU0OIBWFKyHmhnuER2EY+f5vkFGt+9K6Qy/EgFeEV2otpQK55UQyNKxjvl6AI6IBXdVsn+JlEGvKTX+rmF1THql8YPtICeMBubpdcF5rQhTbFvqYSlOzXyOIsgGdC8/2txJGFa7NhMYI933JgyYs/3MXuy5yhhGz2fzG+p2O2DFdBgreEyFNSeWMDXCtID6rouDYdt769XGtKIgh8R5ILyq99ekx8hYiPYbAJbCUX1uL5gICIuTXOx9YBZxip0vlz0QjYLRlRsoSbiB0pmOFyfsz4PZXfldfh/7lHywXZvMHXaR/futKUEmWULO3pU1QZBSaPSyGhnAzNNMjAwnKlbZrNVTejXRJ0VobqgoEdjGvwkP64V4G0B7mUBGOiFReS76rzUhYzLNKNnaIbAX88oUuso+p1HDjXbOACxpz5mtexwtmBrtYkD2TZNjARMRPQ5tPZQnDVo0Pk7S3/hO9hwFFHSEoVPcY9/SZ2oMcmFJdjeDbnC24Xyo/GLhUz44v571Q/dqtGmU8UgUw+R190orsN31R/hhYyTJc11Fw7odpFxdISCbkrCKGYlMJqL89ZSnwzvlnpekoZLng3mqW5w+x2Lt+k9gBll2/HWQ5cUlU31LgCil8tY1y0KyAJlAc2b/ARoP8v9BD9LGpPeuoujy2SWJxx0infsYhq2J4QdUz0aLFmE2mH/FqN4geQq9Slvr88S8f+3CaESBCDuxUJlTyXLkgY17CEdGeHi8ojucg0j10R9DWAdej5oC2qwjD2Nfw4H/NEgV6mZop3kyubzZB1WKEbI+3kryDJBtxngPsnQFzS5fFsxTfGzUu8gWh+qTXswhrnyygrtVNpzaqEUCXERA8PTg4PjTccncZuNZuYHwOL+ypcVwTJKwKtzMJliMS5iZ3M9jXJfhvNiQM4WLIYNWHCSJNWQ/8oVJdre+PI/qm8tKaQw++eagSviPggVIVLR9BYmuOVQkIH/RVkHXpQuh8rJsEtVgQoSmFexb29HS6glny+MzGH0REiod4LxIGBIAWn1g8nTCRCXwkZ3mH3PmBTwEaz7N+cbRoFe7hEYhGVIHSigtaCQ9sf825FYFf6F6iqGg+MhM8Uw75h/RTcwewmWTnpjc6DawlwOdXcYuKLEAszF2seO+M7KB0exjvp6QCRq7Rr/ziV+SsmMyfYT7V5chP8N3g2lj9aJH7VeRCvimEpllcvjwUQed5rrp5oeX51iQ/KBxhjh+2F3raK6A2f+TgsYfuiWJMuCy2WR5SpbpJIIngI052eTvqIRhxKX6P7SLZ6gYuyWi9u5cChtjUTbN/4mBgbNsmJA+UHK1In7BU4reXhGCykAt9qlyoGpJftn3VAxY6nB50wu3k4l2hD5KT0WNM2p2t5tSmStL/U+qv8pg0vg/m0SJIBYJd2a8hmZ1OLMw2/0uWb2puOdJs/3W0ZiZLFjUf0yCp/Gy9d20LNAJN+NUxt42vyN39jRDadHJyguCVZKrC6tljaqrmy8u9sv8UQDKtAO8awLEWt6ww8gkvh2enebpDL+opBB0lbGbDaNDFshUY1ehL0VH7mfBkwqwbEHDTfR7hakQpEzyVK+qPUdV4PHPrIwo3FnFEOLkAWnXeD9KDGL4Uv6SKaCh0KUI4Jni2uCGmmX3S949CbzgfIJcbyp7Pjr9nV4ysZHhgb+v4ZUwOuBs2y/w+tszwXGxFBFqRyQGChNvZRc9vPQAPRaIr/1OSj/Slu2Xmeoa0+uGnioxzptonvkD5894p7k7hLh6xQgrfZIRlB0+SQw1B6Q1Q3o4BVnWRkEd8oYA6/FQ3TAomkOtv66bJInb8zXOT8yhDrfqbjR5OHSf+JNEWkcderNqShX6LhLw4lEqIJbahMMcZl+rs0tL1ZfYQIyX/PS3e6cmj/D5ZjOUw69JYKX8NIAmg+AbF2ipKx+n3M2afmATDGqmg7l8US/1WKxckkUVx6lIsPPHDNrdwbdaYsQ7O56BbuTo9vbBO5nQIMVxIr5UTMha83PFLsdHlXMtbY5Sp7DcEL9/yqXg9cmnPOE7RmBGsyMY4HtQNkgzlPKT+sKj3wqBI04aVOwcjs41USPNrv6rO5aXECmf2lnx5MWhg8ISoldYZ2MTdcauO/4sMG+++NJ1HfR5AY3NlKUivJAAAAAA=');
