@extends('page.master')

@section ('section-warp')
    <div class="section-warp ask-me">

    </div><!-- End section-warp -->
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <h1>Tags</h1>
        </div>
        <div class="search_tag col-md-9">
            <input id="search" name="search" class="form-control" type="text" placeholder="Filter by tag name">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>A tag is a keyword or label that categorizes your question with other, similar questions. Using the right tags makes it easier for others to find and answer your question.</p>
        </div>
    </div>
    <hr><br>
    <div class="row">
        <div class="container">
            <h3>Results of <span style="color: red">"{{ $post[0]['keyword'] }}"</span></h3>
            <hr>
        </div>
        <br>
        <div class="tag col-lg-12">
            @foreach ($post as $value)
                <article class="question question-type-normal">
                    <h2>
                        <a href="{{route('get.QuestionDetails',$value['idpost'])}}">{{substr($value['title'],0,200)}}</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="{{route('get.QuestionDetails',$value['id'])}}">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="{{$value['firstname'].$value['lastname']}}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{$value['avatar']}}"></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc">{{ strip_tags(substr($value['content'],0,300))}}</p>
                        {{--<div class="question-details">--}}
                            {{--@if($value['stt']==0)--}}
                                {{--<span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>--}}
                            {{--@elseif($value['stt']==1)--}}
                                {{--<span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}

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
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#search').on('keyup',function () {
            $value = $(this).val();
            $.ajax({
                type : 'get',
                url  : '{{ URL::to('tag-list/search') }}',
                data : {'search':$value},
                success:function (data) {
                    $('.tag').html(data);
                }
            })
        })
    </script>

@endsection
