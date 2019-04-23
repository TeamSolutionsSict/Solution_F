<?php

namespace App\Http\Controllers;

use App\KeywordModel;
use App\User;
use Illuminate\Http\Request;
use Nexmo\Response;
use App\PostKeyModel;
use App\PostModel;
use Datetime;

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
                                    <li><a href="'.route('get.QuestionByTag', $value->id).'"><span>'.str_limit($value['keyword'], 14).'</span></a></li>
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

    public function getQuestionByTag($id){
        $result=array();
        $post=PostModel::select('tb_post.*', 'tb_keyword.keyword','tb_post.id as idpost','tb_user.*')
            ->where('tb_post.status',1)
            ->where('tb_post.keyword_id',$id)
            ->rightJoin('tb_keyword', 'tb_post.keyword_id', 'tb_keyword.id')
            ->rightJoin('tb_user', 'tb_user.username', '=', 'tb_post.username')
            //->where('title','like','%'.$key)
            ->orderBy('timepost','desc')
            ->get()
            ->toArray();
        foreach ($post as $key=>$value) {
            $flag=false;
            $now = new DateTime(date('Y-m-d H:i:s'));
            $ref = new DateTime($value['timepost']);
            $diff = $now->diff($ref);
            // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
            $post[$key]['timepost'] = $diff->d . " days, " . $diff->h . " hours " . $diff->i . " minutes ago";
            $allKey = PostkeyModel::select('*')->where('id_post', $value['id'])->get()->toArray();
            $post[$key]['keyWordName'] = array();
//            $post[$key]['stt'] = pageController::getstatus($value['id']);
            foreach ($allKey as $val) {
                $keyname = KeywordModel::find($val['id_keyword']);
                $post[$key]['keyWordName'][] = $keyname->keyword;

            }
        }
//        dd($post);
//        return json_encode($result);
        return view('page.questionByTag', compact('post'));
    }

}
