@extends('page.master')
@section('title', 'Home')
@section('section-warp')
    <div class="section-warp ask-me">
        <div class="container clearfix">
            <div class="box_icon box_warp box_no_border box_no_background" box_border="transparent" box_background="transparent" box_color="#FFF">
                <div class="row">
                    <div class="col-md-3">
                        <h2>Welcome to Ask me</h2>
                        <p>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque.</p>
                        <div class="clearfix"></div>
                        <a class="color button dark_button medium" href="{{ route('get.Contact') }}">About Us</a>
                        {{--<a class="color button dark_button medium" href="#">Join Now</a>--}}
                    </div>
                    <div class="col-md-9">
                        <form class="form-style form-style-2">
                            <p>
                                <textarea rows="4" id="question_title" onfocus="if(this.value=='Ask any question and you be sure find your answer ?')this.value='';" onblur="if(this.value=='')this.value='Ask any question and you be sure find your answer ?';">Ask any question and you be sure find your answer ?</textarea>
                                <i class="icon-pencil"></i>
                                <a href="{{ route('get.Terms') }}" class="color button small publish-question">Ask Now</a>
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
        <div class="result"><span class="widget_title">There are {{count($result)}} search results for keyword</span></div>
        <ul class="tabs">
            <li class="tab"><a href="#" class="current">Result(s)</a></li>{{-- Hiển thị theo thứ tự thời gian --}}
        </ul>

        <div class="tab-inner-warp">
            <div class="tab-inner" id="newest">
                @foreach($result as $value)
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
                        <p class="question-desc">{{ strip_tags(substr($value['content'],0,300))}}</p>
                        <div class="question-details">
                            @if($value['stt']==0)
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                            @elseif($value['stt']==1)
                                  <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>
                            @endif
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
                
                <a  class="load-questions" onclick=""><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>

    </div>
@endsection
