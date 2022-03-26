<?php

namespace Lib;

class Controller
    {
        // protected $writer;
        public function __construct(){
            // $this->writer=new Writer("main");
        }
        function view($data=[])
        {
            $func=str_replace('Action',"",debug_backtrace()[1]['function']);
            $tmp=explode("\\",debug_backtrace()[1]['class'])[1];
            $class=str_replace('Controller',"",$tmp);
            $path=ROOT.strtolower("/private/views/$class/$func.phtml");
            //echo $page;
            if(is_readable($path)){
                require_once ROOT."/private/views/index.phtml";
            } else {
                echo "404 file not found: $path";
            }
        }
        public static function model($name)
        {
            $path=ROOT."/private/Controllers/$name.php";
            $name="Controllers\\$name";
            return new $name;
        }
    }