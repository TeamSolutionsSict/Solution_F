@extends('page.master')
@section('title', 'Trang chủ')
@section('section-warp')
    <div class="section-warp ask-me">
        <div class="container clearfix">
            <div class="box_icon box_warp box_no_border box_no_background" box_border="transparent" box_background="transparent" box_color="#FFF">
                <div class="row">
                    <div class="col-md-3">
                        <h2>Welcome to Ask me</h2>
                        <p>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque.</p>
                        <div class="clearfix"></div>
                        <a class="color button dark_button medium" href="{{route('get.Contact')}}">About Us</a>
                        {{--<a class="color button dark_button medium" href="#">Join Now</a>--}}
                    </div>
                    <div class="col-md-9">
                        <form class="form-style form-style-2">
                            <p>
                                <textarea rows="4" id="question_title" onfocus="if(this.value=='Ask any question and you be sure find your answer ?')this.value='';" onblur="if(this.value=='')this.value='Ask any question and you be sure find your answer ?';">Ask any question and you be sure find your answer ?</textarea>
                                <i class="icon-pencil"></i>
                                <a href="{{route('get.Terms')}}" class="color button small publish-question">Ask Now</a>
                            </p>
                        </form>
                    </div>
                </div><!-- End row -->
            </div><!-- End box_icon -->
        </div><!-- End container -->
    </div><!-- End section-warp -->
@endsection

@section('content')
    <div class="tabs-warp question-tab">
        <ul class="tabs">
            <li class="tab"><a href="#" class="current">Newest</a></li>{{-- Hiển thị theo thứ tự thời gian --}}
            <li class="tab"><a href="#">Frequent</a></li>{{-- Thường xuyên - Theo thứ tự nhiều views --}}
            <li class="tab"><a href="#">Votes</a></li>{{-- Theo thứ tự nhiều votes --}}
            <li class="tab"><a href="#">Unanswered</a></li>{{-- Chưa có câu trả lời --}}
        </ul>

        <div class="tab-inner-warp">
            <div class="tab-inner" >
                <div id="newest">
                @foreach ($post as $value)
                <article class="question question-type-normal">
                    <h2>
                        <a href="{{route('get.QuestionDetails',$value['idpost'])}}">{{substr($value['title'],0,200)}}</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="{{route('get.QuestionDetails',$value['idpost'])}}">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="{{$value['firstname'].$value['lastname']}}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{$value['avatar']}}"></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc"> {!! strip_tags(substr($value['content'],0,300)) !!}</p>
                       
                        <div class="question-details">
                            @if($value['stt']==2)
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                            @elseif($value['stt']==3)
                                  <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>
                             @elseif($value['stt']==1)
                                  <span class="question-answered" style="color: red;"><i class="icon-question"></i>Unanserwed</span>
                            @endif
                        </div>
                        <span class="question-date"><i class="icon-time"></i>{{$value['timepost']}}</span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{$value['comment']}} Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>{{$value['votes']}} Vote</a>
                        <span class="question-view"><i class="icon-user"></i>{{$value['view']}} View</span>
                        <br>
                        @foreach ($value['keyWordName'] as $val)
                        <span class="question-category"><a><i class="icon-folder-close"></i>{{$val}}</a></span>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                </article>
                @endforeach
                </div>
                <a  class="load-questions" onclick="loadMore('newest',0)"><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>
        <div class="tab-inner-warp">
            <div class="tab-inner">
                <div id="frequent">
                  @foreach ($frequent as $value)
                  
                <article class="question question-type-normal">
                    <h2>
                        <a href="{{route('get.QuestionDetails',$value['idpost'])}}">{{substr($value['title'],0,200)}}</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="{{route('get.QuestionDetails',$value['idpost'])}}">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="{{$value['firstname'].$value['lastname']}}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{$value['avatar']}}"></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc">{!! strip_tags(substr($value['content'],0,300)) !!}</p>
                        <div class="question-details">
                            @if($value['stt']==2)
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                            @elseif($value['stt']==3)
                                  <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>
                             @elseif($value['stt']==1)
                                  <span class="question-answered" style="color: red;"><i class="icon-question"></i>Unanserwed</span>
                            @endif
                            {{--<span class="question-favorite"><i class="icon-star"></i>{{$value['comment']}}</span>--}}
                        </div>
                        
                        <span class="question-date"><i class="icon-time"></i>{{$value['timepost']}}</span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{$value['comment']}} Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>{{$value['votes']}} Vote</a>
                        <span class="question-view"><i class="icon-user"></i>{{$value['view']}} View</span>
                        <br>
                        @foreach ($value['keyWordName'] as $val)
                        <span class="question-category"><a><i class="icon-folder-close"></i>{{$val}}</a></span>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                </article>
                @endforeach
                </div>
                <a  class="load-questions" onclick="loadMore('frequent',0)"><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>
        <div class="tab-inner-warp">
            <div class="tab-inner">
                <div id="votes">
                @foreach ($voted as $value)
                 <article class="question question-type-normal">
                    <h2>
                        <a href="{{route('get.QuestionDetails',$value['idpost'])}}">{{substr($value['title'],0,200)}}</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="{{route('get.QuestionDetails',$value['idpost'])}}">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="{{$value['firstname'].$value['lastname']}}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{$value['avatar']}}"></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc">{!! strip_tags(substr($value['content'],0,300)) !!}</p>
                        <div class="question-details">
                             @if($value['stt']==2)
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                            @elseif($value['stt']==3)
                                  <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>
                             @elseif($value['stt']==1)
                                  <span class="question-answered" style="color: red;"><i class="icon-question"></i>Unanserwed</span>
                            @endif
                            {{--<span class="question-favorite"><i class="icon-star"></i>{{$value['comment']}}</span>--}}
                        </div>
                        
                        <span class="question-date"><i class="icon-time"></i>{{$value['timepost']}}</span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{$value['comment']}} Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>{{$value['votes']}} Vote</a>
                        <span class="question-view"><i class="icon-user"></i>{{$value['view']}} View</span>
                        <br>
                        @foreach ($value['keyWordName'] as $val)
                        <span class="question-category"><a><i class="icon-folder-close"></i>{{$val}}</a></span>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                </article>
                @endforeach
            </div>

                <a  class="load-questions" onclick="loadMore('votes',0)"><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>
        <div class="tab-inner-warp">
            <div class="tab-inner">
                <div id="unanswered">
               @foreach ($unanswered as $value) 
                <article class="question question-type-normal">
                    <h2>
                        <a href="{{route('get.QuestionDetails',$value['idpost'])}}">{{substr($value['title'],0,200)}}</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="{{route('get.QuestionDetails',$value['idpost'])}}">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="{{$value['firstname'].$value['lastname']}}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{$value['avatar']}}"></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc">{!! strip_tags(substr($value['content'],0,300)) !!}</p>
                        <div class="question-details">
                            @if($value['stt']==0)
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                            @elseif($value['stt']==1)
                                  <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>
                            @endif
                            {{--<span class="question-favorite"><i class="icon-star"></i>{{$value['comment']}}</span>--}}
                        </div>
                        
                        <span class="question-date"><i class="icon-time"></i>{{$value['timepost']}}</span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{$value['comment']}} Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>{{$value['votes']}} Vote</a>
                        <span class="question-view"><i class="icon-user"></i>{{$value['view']}} View</span>
                        <br>
                        @foreach ($value['keyWordName'] as $val)
                        <span class="question-category"><a href="#"><i class="icon-folder-close"></i>{{$val}}</a></span>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                </article>
                @endforeach
                </div>
                <a class="load-questions" onclick="loadMore('unanswered',0)"><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>

    </div>
<script >
    var offsetlist={newest:6,frequent:6,votes:6,unanswered:6};
    var step=3;
    var base="<?php echo url('/'); ?>";
    function loadMore(mode,offset) {
        
        // console.log(offsetlist[mode]);
         $.getJSON('{{url("home-more")}}'+'/'+mode+"/"+offsetlist[mode], function(json, textStatus) {
            /*optional stuff to do after success */
            console.log(json.length);
            if (json.length==0) {
                $("#"+mode).append('HẾT R CƯNG')
            }else{
            json.map(function(e) {
                var noidung='<article class="question question-type-normal">';
                    noidung+='<h2>';
                    noidung+= '<a href="link'+e.id+'">'+e.title.slice(0, 100).replace(/(<([^>]+)>)/ig,"")+'</a>';
                    noidung+='</h2>';
                    noidung+='<a class="question-report red-button" href="#">Report</a>';
                    noidung+='<div class="question-type-main"><a href="link'+e.id+'">Answer</a></div>';
                    noidung+='<div class="question-author">';
                    noidung+='<a href="#" original-title="'+e.name+'" class="question-author-img tooltip-n"><span></span><img alt="" src="'+e.avatar+'"></a>';
                    noidung+='</div>';
                noidung+= '<div class="question-inner">';
                    noidung+='<div class="clearfix"></div>';
                    noidung+='<p class="question-desc">';
                    noidung+=e.content.slice(0, 300).replace(/(<([^>]+)>)/ig,"")+'</p>';
                    // noidung+='</div>';
                    noidung+='<div class="question-details"></div>';
                    if (e.stt==0) {
                        noidung+='<span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>';
                    }
                    else if (e.stt==1){
                        noidung+='<span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>';
                    }
                     noidung+='</div>';
                     noidung+='<span class="question-date"><i class="icon-time"></i>'+e.timepost+'</span>';
                    noidung+='<span class="question-comment"><a href="#"><i class="icon-comment"></i>'+e.comment+'Answer</a></span>';
                    noidung+='<a class="question-reply" href="#"><i class="icon-heart"></i>'+e.votes+ 'Vote</a>';
                    noidung+='<span class="question-view"><i class="icon-user"></i>'+
                    e.view+'View</span>';
                    noidung+='<br>';
                    e.keyWordName.map(function(elem) {
                       noidung+='<span class="question-category"><a href="#"><i class="icon-folder-close"></i>'+elem+'</a></span>';
                    });
                    noidung+='<div class="clearfix"></div>';
                    // noidung+='</div>';
                    noidung+='</div>';
                    noidung+='</article>';
               // console.log(noidung);
                $("#"+mode).append(noidung);

            })}
    });
    offsetlist[mode]+=step;

    }
   
</script>
@endsection
