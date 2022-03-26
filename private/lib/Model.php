<?php

namespace Lib;

class Model
    {
        private $path;
        private $data;
        public function __construct()
        {
            $name=explode('\\',static::class)[1];
            $this->path=ROOT.'/private/database/'.$name.".data";
            $this->data=[];
            if(!is_writable($this->path)){
                echo "Cant Write to file: $this->path";
                return null;
            } else {
                if(is_readable($this->path)){
                    $this->data = json_decode(file_get_contents($this->path),true);
                }
            }
        }
        public function init(){
            file_put_contents($this->path, json_encode($this->data));
        } 
        public function get($key=null){
            if(!isset($key)){
                return $this->data;
            }elseif(isset($this->data[$k])){
                return $this->data[$k];
            } else {
                return null;
            }
        }
        public function set($key,$arr=null){
            $this->data[$key]=$arr;
            $this->init();
        }
        public function deleteAll(){
            $this->data=[];
            $this->init();
        }
        public function delete($arr=[]){
            foreach($arr as $v){
                unset($this->data[$v]);
            }        
            $this->init();
        }
        public static function find($key=null,$val=null){
            if(!isset($key)){
                // $class=explode('\\',static::class)[1];
                $class=static::class;
                // echo $class;
                // require_once ROOT."/private/models/$class.php";
                return (new $class)->get();
            }
        }
    }