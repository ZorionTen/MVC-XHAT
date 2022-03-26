<?php
define("ROOT",$_SERVER['DOCUMENT_ROOT']);
require_once "private/settings.php";

//require "privare/models/Users.php";

$folders=[
    'lib',
    'models',
    'controllers',
    ];

function requireFolder($x){
    foreach(glob(ROOT."/private/$x/*.php") as $v ){
        //echo $v.'<br>';
        require_once $v;
    }
}
foreach($folders as $v){
    requireFolder($v);
}
session_start();
use Lib\Core;
$core=new Core();
