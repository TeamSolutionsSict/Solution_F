<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\KeywordModel;
use App\PostModel;
use App\ReportPostModel;
use App\CommentModel;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //tag random trong slide-bar
        view()->composer('page.slide-bar',function($view){
            $randomTag = KeywordModel::select('tb_keyword.keyword')
                ->limit(10)
                ->inRandomOrder()
                ->get();
            $view->with('randomTag',$randomTag);
        });

//        =============================

          $sta=PostModel::select('id')->where('status',1)->get()->toArray();
          $stats=array();
          $stats['total']=count($sta);
           $stats['reported']=0;
           $stats['unanswered']=0;
           $stats['answered']=0;
         foreach ($sta as $value) {
          $report=ReportPostModel::where('id',$value['id'])->count();
              if ($report>3) {
                 $stats['reported']++;
              }
              else{
                $comment= CommentModel::where('id_post',$value['id'])->count();
                if ($comment==0) {
                   $stats['unanswered']++;
                }
                else {
                  $stats['answered']++;
                }
            }
         }
         view()->share('stats', $stats);
         // view('page.slide-bar', compact('stats'))->render();
    }
     function getStatusStats($id)
    {
      $report=ReportPostModel::where('id',$id)->count();
      if ($report>3) {
        return 0;
      }
      else{
        $comment= CommentModel::where('id_post',$id)->count();

        if ($comment==0) {
          return 1;
        }
        else {
          return 2;
        }

      }
  }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
