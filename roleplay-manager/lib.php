<?php

$dirname = dirname(__FILE__);

foreach(scandir($dirname.'/post_types') as $file){
    if(preg_match('/\.php$/', $file)){
        require_once($dirname.'/post_types/'.$file);
    }
}
$dirname = dirname(__FILE__);

foreach(scandir($dirname.'/includes') as $file){
    if(preg_match('/\.php$/', $file)){
        require_once($dirname.'/includes/'.$file);
    }
}