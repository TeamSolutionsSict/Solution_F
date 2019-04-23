<?php

class Make{

    public function hashID($username){
        //Lấy thời gian hiện tại
        $date = new Datetime();
        //id_post = username + ngày giờ hiện tại + Tiêu đề bài viết + random 8 ký tự
        $iduser = $username.$date->format('d-m-Y').str_random(8);
        $id = Hash::make($iduser);
        return str_replace('$','',str_replace('/','',$id));
    }
}


