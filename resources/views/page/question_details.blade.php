@extends('page.master')

@section ('section-warp')
    <div class="section-warp ask-me">

    </div><!-- End section-warp -->
@endsection

@section('content')


    <article class="question single-question question-type-normal">
                    <div class="about-author clearfix">
                    <div class="author-image avtuser">
                      <a href="#" original-title="admin" class="tooltip-n"><img alt="" src="{{$post[0]['avatar']}}"></a>
                    </div>
                    <div class="author-bio avtuser">
                        <div class="comment-author"><a href="#"><h4>User Name</a></div>

                        <div class="comment-vote">
                            <ul class="question-vote">
                                <li><a href="#" id="up_vote_post" class="question-vote-up" title="Like"></a></li>
                                <li><span id="value_vote_post" class="question-vote-result">{{$post[0]['votes']}}</span></li>
                                <li><a href="#" id="down_vote_post" class="question-vote-down" title="Dislike"></a></li>
                            </ul>
                        </div>
                        <a class="comment-reply" data-toggle="collapse" href="#answer"><i class="icon-reply"></i>{{count($comment)}} Answer</a>
                    </div>
                </div>
                    <h2>
                        <a href="single_question.html">{{$post[0]['title']}}</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="#">{{$post[0]['votes']}} Votes</a></div>
                    <div class="question-inner">
                        <div class="question-desc">
                            {!! $post[0]['content'] !!}
                        </div>
                        <div class="question-details">
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                            <span class="question-favorite"><i class="icon-star"></i>5</span>
                        </div>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{count($comment)}} Answer</a></span>
                        <span class="question-date"><i class="icon-time"></i>{{$post[0]['timepost']}}</span>
                        <span class="question-view"><i class="icon-user"></i>{{$post[0]['view']}} views</span>
                        <span class="single-question-vote-result">+22</span>
                        <br>
                        @foreach ($post[0]['keyWordName'] as $value)
                            <span class="question-category"><a href="#"><i class="icon-folder-close"></i>{{$value}}</a></span>
                        @endforeach
                        <ul class="single-question-vote">
                            <li><a href="#" class="single-question-vote-down" title="Dislike"><i class="icon-thumbs-down"></i></a></li>
                            <li><a href="#" class="single-question-vote-up" title="Like"><i class="icon-thumbs-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                            <div id="answer" style="height: 100%; width: 100px; background-color: red;" class="">
                
                            </div>
                    </div>  
                </article>
    <div id="commentlist" class="page-content">
        <div class="boxedtitle page-title"><h2>Answers ( <span class="color">{{count($comment)}}</span> )</h2></div>
        <ol class="commentlist clearfix">
        @foreach ($comment as $key=>$value)
            @if($key==count($comment)-2)
               <li class="comment" id="last">
            @endif
             <li class="comment">
                <div class="comment-body comment-body-answered clearfix">
                    <div class="avatar"><img alt="" class="avatar" src="{{$value['avatar']}}"></div>
                    <div class="comment-text">
                        <div class="author clearfix">
                            <div class="comment-author"><a href="#">{{$value['username']}}</a></div>
                            <div class="question-vote">
                                <ul class="question-vote">
                                    <li id="up{{$value['idpost']}}"><a  class="question-vote-up" title="Like" onclick='upcom("{{ trim(preg_replace('/\s\s+/', ' ', $value['idpost']))}}")'></a></li>
                                    <li><span class="question-vote-result" id="comment_count_{{$value['idpost']}}">{{$value['votes']}}</span></li>
                                    <li id="down{{$value['idpost']}}"><a  class="question-vote-down" title="Dislike"  onclick='downcom("{{ trim(preg_replace('/\s\s+/', ' ', $value['idpost']))}}")'></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="question-desc">

                        <div class="text">
                            {!! $value['content'] !!}
                        </div>
                        @if($value['best'])
                        <div class="question-answered question-answered-done"><i class="icon-ok"></i>Best Answer</div>
                        @endif
                        <div class="comment-meta">
                                <div class="date"><i class="icon-time"></i>{{$value['time_cmt']}}</div>
                        </div>
                    </div>
                    </div>   
            </li>
            @endforeach
        </ol>
    </div>
    <div class="page-content ask-question" id="answer">
        <div class="boxedtitle page-title"><h2>Your answer</h2></div>
        <div class="form-style form-style-3" id="question-submit">
            <form action="{{route('post.addComment', $post[0]['idpost'])}}" method="POST">
                <div id="form-textarea" style="margin-top:10px;">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <p>
                        <textarea id="editor1" aria-required="true" name="content"></textarea>
                    </p>
                </div>
                
                 
                 <input type="hidden" name="content_code">
                <script src="{{asset('page/ckeditor/ckeditor.js')}}"></script>
                <script> CKEDITOR.replace('editor1');  </script>
                <script>hljs.initHighlightingOnLoad();</script>
                <p class="form-submit">
                    <input type="submit" id="publish-question" value="Post Answer Your" class="button color small submit">
                </p>
            </form>
        </div>
    </div>

<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script >
     $(document).ready(function() {
    if (window.location.hash) {
        var hash = window.location.hash;
        $('html, body').animate({
             scrollTop :  $(hash).offset().top-200
        }, 2001);
    };
});
      $.ajax({
             url: "{{route('get.check-vote-post',$post[0]['idpost'])}}",
             type: 'GET',
             success: function(data) {
                console.log(data);
                 if (data=="UP") {
                    $('#up_vote_post').addClass('lime-green-button');
                 }
                 else if(data=="DOWN"){
                    $('#down_vote_post').addClass('red-button');
                 }
             }
         });
     $('#up_vote_post').click(function(event) {
         /* Act on the event */
         $.ajax({
             url: "{{route('get.vote-post',$post[0]['idpost'])}}",
             type: 'GET',
             success: function(data) {
                console.log(data);
                 if (data=="NOPE") {
                     $.alert({
                        title: 'Cảnh báo!',
                        content: 'Mẹ m m vote rồi mà!',
                         theme:'supervan',
                    });
                     // $('#up_vote_post').addClass('lime-green-button');
                 }
                 else{
                     $("#value_vote_post").html(data);
                    $('#up_vote_post').addClass('lime-green-button');
                     $('#down_vote_post').removeClass('red-button');
                 }
             }
         });
     });
      $('#down_vote_post').click(function(event) {
         /* Act on the event */
         $.ajax({
             url: "{{route('get.down-vote-post',$post[0]['idpost'])}}",
             type: 'GET',
             success: function(data) {
                console.log(data);
                 if (data=="NOPE") {
                    $.alert({
                        title: 'Cảnh báo!',
                        theme:'supervan',
                        content: 'Mẹ m m vote rồi mà!',
                        openAnimation: 'RotateXR'
                    });
                     // $('#down_vote_post').addClass('lime-green-button');
                 }
                 else{
                    $("#value_vote_post").html(data);
                    $('#down_vote_post').addClass('red-button');
                    $('#up_vote_post').removeClass('lime-green-button');
                 }
             }
         });
     });
    // function getVote(id){
    // $.getJSON("{{url('comment-vote-count')}}/"+id, function(json, textStatus) {
    //         console.log(json);
    // });
    // }
    function upcom(id) {
        // body...
         console.log("{{url('vote-comment')}}/"+id);
         $.ajax({
             url: "{{url('vote-comment')}}/"+id,
             type: 'GET',
            success: function(data){
                 if (data=="NOPE") {
                    $.alert({
                        title: 'Cảnh báo!',
                        theme:'supervan',
                        content: 'Mẹ m m vote rồi mà!',
                        openAnimation: 'RotateXR'
                    });
                     // $('#down_vote_post').addClass('lime-green-button');
                 }
                 else{
                    $("#comment_count_"+id).html(data);
                    $('#down'+id).removeClass('red-button');
                    console.log('#down'+id);
                    $('#up'+id).addClass('lime-green-button');
                 }
            }
         });
        // console.log(id);
    }
     function downcom(id) {
        // body...
         // console.log("{{url('down-comment')}}/"+id);
         $.ajax({
             url: "{{url('down-vote-comment')}}/"+id,
             type: 'GET',
            success: function(data){
                 if (data=="NOPE") {
                    $.alert({
                        title: 'Cảnh báo!',
                        theme:'supervan',
                        content: 'Mẹ m m vote rồi mà!',
                        openAnimation: 'RotateXR'
                    });
                     // $('#down_vote_post').addClass('lime-green-button');
                 }
                 else{
                    $("#comment_count_"+id).html(data);
                    $('#down'+id).addClass('red-button');
                    console.log('#down'+id);
                    $('#up'+id).removeClass('lime-green-button');
                 }
            }
         });
        // console.log(id);
    }
 </script>
@endsection
