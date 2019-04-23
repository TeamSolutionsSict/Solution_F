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
        <div class="result"><span class="widget_title">There are 5 search results for keyword</span></div>
        <ul class="tabs">
            <li class="tab"><a href="#" class="current">Newest</a></li>{{-- Hiển thị theo thứ tự thời gian --}}
            <li class="tab"><a href="#">Frequent</a></li>{{-- Thường xuyên - Theo thứ tự nhiều views --}}
            <li class="tab"><a href="#">Votes</a></li>{{-- Theo thứ tự nhiều votes --}}
            <li class="tab"><a href="#">Unanswered</a></li>{{-- Chưa có câu trả lời --}}
        </ul>

        <div class="tab-inner-warp">
            <div class="tab-inner" id="newest">
                <article class="question question-type-normal">
                    <h2>
                        <a href="#"></a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="#}">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="" class="question-author-img tooltip-n"><span></span><img alt="" src=""></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc"></p>
                        <div class="question-details">
                            
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                            
                                  <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In 
                        </div>
                        
                        <span class="question-date"><i class="icon-time"></i></span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>Vote</a>
                        <span class="question-view"><i class="icon-user"></i>View</span>
                        <br>
                       
                        <span class="question-category"><a href="#"><i class="icon-folder-close"></i></a></span>
                        
                        <div class="clearfix"></div>
                    </div>
                </article>
                
                
                <a  class="load-questions" onclick=""><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>
        <div class="tab-inner-warp">
            <div class="tab-inner">
                 
                <article class="question question-type-normal">
                    <h2>
                        <a href=""></a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="#">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="" class="question-author-img tooltip-n"><span></span><img alt="" src=""></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc"></p>
                        <div class="question-details">
                            
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                            
                                  <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>
                            
                            {{--<span class="question-favorite"><i class="icon-star"></i>{{$value['comment']}}</span>--}}
                        </div>
                        
                        <span class="question-date"><i class="icon-time"></i></span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>Vote</a>
                        <span class="question-view"><i class="icon-user"></i>View</span>
                        <br>
                        
                        <span class="question-category"><a href="#"><i class="icon-folder-close"></i></a></span>
                        
                        <div class="clearfix"></div>
                    </div>
                </article>
                
        
                <a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>
        <div class="tab-inner-warp">
            <div class="tab-inner">
                
                <article class="question question-type-normal">
                    <h2>
                        <a href="">This is my first Question</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="" class="question-author-img tooltip-n"><span></span><img alt="" src="../../ask-me/images/demo/avatar.png"></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc">Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vitae velit in neque dictum blandit.</p>
                        <div class="question-details">
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                            {{--<span class="question-favorite"><i class="icon-star"></i>{{$value['comment']}}</span>--}}
                        </div>
                        <span class="question-category"><a href="#"><i class="icon-folder-close"></i>Java</a></span>
                        <span class="question-date"><i class="icon-time"></i>4 mins ago</span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>10 votes</a>
                        <span class="question-view"><i class="icon-user"></i>70 views</span>
                        <div class="clearfix"></div>
                    </div>
                </article>
                
                <article class="question question-type-normal">
                    <h2>
                        <a href="">This is my first Question</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="">Answer</a></div>
                                <div class="question-author">
                        <a href="#" original-title="" class="question-author-img tooltip-n"><span></span><img alt="" src=""></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc">Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vitae velit in neque dictum blandit.</p>
                        <div class="question-details">
                            <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>
                            {{--<span class="question-favorite"><i class="icon-star"></i>{{$value['comment']}}</span>--}}
                        </div>
                        <span class="question-category"><a href="#"><i class="icon-folder-close"></i>Laravel</a></span>
                        <span class="question-date"><i class="icon-time"></i>4 mins ago</span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>4 votes</a>
                        <span class="question-view"><i class="icon-user"></i>70 views</span>
                        <div class="clearfix"></div>
                    </div>
                </article>

                <a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>
        <div class="tab-inner-warp">
            <div class="tab-inner">
               
                <article class="question question-type-normal">
                    <h2>
                        <a href="</a>
                    </h2>
                    <a class="question-report red-button" href="#">Report</a>
                    <div class="question-type-main"><a href="">Answer</a></div>
                    <div class="question-author">
                        <a href="#" original-title="" class="question-author-img tooltip-n"><span></span><img alt="" src=""></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc"></p>
                        <div class="question-details">
                            
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</span>
                           
                                  <span class="question-answered" style="color: #00aced;"><i class="icon-question"></i>In progress</span>
                           
                            {{--<span class="question-favorite"><i class="icon-star"></i>{{$value['comment']}}</span>--}}
                        </div>
                        
                        <span class="question-date"><i class="icon-time"></i></span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>Answer</a></span>
                        <a class="question-reply" href="#"><i class="icon-heart"></i>Vote</a>
                        <span class="question-view"><i class="icon-user"></i>View</span>
                        <br>
                       
                        <span class="question-category"><a href="#"><i class="icon-folder-close"></i></a></span>
                        
                        <div class="clearfix"></div>
                    </div>
                </article>
              
                <a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
            </div>
        </div>

    </div>
@endsection
