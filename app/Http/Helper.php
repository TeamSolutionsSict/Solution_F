<?php

class Helper{

    public function hashID($user, $title){
        //Lấy thời gian hiện tại
        $date = new Datetime();
        //slug tiêu đề
        $title = str_slug($title);
        //id_post = username + ngày giờ hiện tại + Tiêu đề bài viết + random 8 ký tự
        $id = $user.$date->format('d-m-Y').$title.str_random(8);
        $idPost = Hash::make($id);
        return str_replace('$','',str_replace('/','',$idPost));
    }
}
