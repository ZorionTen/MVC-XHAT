<?php
namespace Lib;

class Core
    {
        public function __construct()
        {
            $url=$this->getUrl();
            if(count($url)>0 and is_readable(ROOT."/private/controllers/$url[0]Controller") ) {
                $controller=$url[0]."Controller";
            } else {
                $controller="Index"."Controller";
            }
            $class=Controller::model($controller);
            
            if(count($url)>1 and method_exists($class, $url[1]."Action")){
                $action=$url[1]."Action";
            } else {
                $action="index"."Action";
            }
            call_user_func_array([$class, $action],array_slice($url,2));
            
        }

        function getUrl()
        {
            $url=ltrim($_SERVER['PATH_INFO'],'/');
            $url=ucwords($url,'/');
            //echo $url;
            return explode('/',$url);           
        }
    }