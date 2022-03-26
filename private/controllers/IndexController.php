<?php

namespace Controllers;
use Lib\Controller;
use Models\User;
use Models\Message;

class IndexController extends Controller 
{
    public function indexAction(){
        if(count($_POST)>0){
            $post = $_POST ?? array();
            // print_r($post);
            // die;
            $_SESSION['username'] = $post['username'];
            $user=[
                "name" => $_SESSION['username'],
                "key" => 123534
            ];
            $userObj=new User();
            $userObj->set($post['username'],$user);
            header('location: /index/chat');            
        }
        if(isset($_SESSION['username'])){
            //die("die");
            header('location: /index/chat');
        }
        $this->view();
    }
    public function chatAction(){
        $post= $_POST ?? array();
        if(isset($post['chat'])){
            $message=new Message();
            $message->set(time(),["user" => $_SESSION['username'],"text" => $post['chat']]);
        }
        $this->view(["chat" => Message::find()]);
    }
    public function logoutAction(){
        $_SESSION['username']=null;
        header("location: /");
    }
}