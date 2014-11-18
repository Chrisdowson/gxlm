<?php
function sae_copy_defaut_app($directory,$to) {
        if(!is_dir($to)){
          mkdir($to);
        }
        $handle = opendir($directory);
        while (($file = readdir($handle)) !== false) {
            if ($file != "." && $file != "..") {
                is_dir("$directory/$file") ?sae_copy_defaut_app("$directory/$file","$to/$file") :copy("$directory/$file","$to/$file");
            }
        }
        if (readdir($handle) == false) {
            closedir($handle);
        }
}
if(!is_writeable(APP_PATH)){
	header("Content-Type:text/html;charset=utf-8");
	exit('项目目录不可写，请手动建立项目目录，并设在为可写');
}
sae_copy_defaut_app(SAE_PATH.'DefaultApp/',APP_PATH);
