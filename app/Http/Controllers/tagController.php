<?php

namespace App\Http\Controllers;

use App\KeywordModel;
use App\User;
use Illuminate\Http\Request;
use Nexmo\Response;

class tagController extends Controller
{
    public function getTagList() {
        $tag = KeywordModel::selectRaw('tb_keyword.keyword, tb_keyword.status, tb_keyword.id , count(tb_postkey.id_keyword) as num_keyword')
            ->leftjoin('tb_postkey','tb_keyword.id','tb_postkey.id_keyword')
            ->groupBy('tb_keyword.keyword', 'tb_keyword.status', 'tb_keyword.id')
            ->orderBy('num_keyword', 'desc')
            ->get();
        return view('page.tag_list', compact('tag'));
    }
    public function getSearchTag(Request $request){
        //chuyển đổi key vừa lấy từ input thành chữ in hoa
//        $search = strtoupper($request->search);
        $search = $request->search;
        if ($request->ajax()){
            $output = "";
            $tag = KeywordModel::selectRaw('tb_keyword.keyword, tb_keyword.status, tb_keyword.id , count(tb_postkey.id_keyword) as num_keyword')
                ->leftjoin('tb_postkey','tb_keyword.id','tb_postkey.id_keyword')
                ->groupBy('tb_keyword.keyword', 'tb_keyword.status', 'tb_keyword.id')
                ->orderBy('num_keyword', 'desc')
                ->where('keyword','LIKE','%'.$search.'%')
                ->get();
            if ($tag){
                foreach ($tag as $key => $value){
                    $output .= '
                            <div class="tag_detail col-lg-3">
                            <div class="content">
                                <ul>
                                    <li><a href="#"><span>'.str_limit($value['keyword'], 14).'</span></a></li>
                                    <li>Posts: <span>'.$value->num_keyword.'</span></li>
                                </ul>
                            </div>
                            <hr>
                        </div>';
                }
                return Response($output);
            }
        }
    }

}
