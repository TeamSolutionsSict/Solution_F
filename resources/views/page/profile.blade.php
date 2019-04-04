@extends('page.master')

@section('title', $user[0]['firstname']." ".$user[0]['lastname'])

@section ('section-warp')
    <div class="section-warp ask-me">

    </div><!-- End section-warp -->
@endsection

@section('content')
@if(Auth::check())
    <div class="page-content">

        {{--NẾU ĐĂNG NHẬP SẼ HIỆN PHẦN PROFILE DƯỚI - CÓ THỂ SỮA CHỮA--}}
        <div class="boxedtitle page-title"><h2>Edit Profile</h2></div>

        <div class="form-style form-style-4">
            <form method="POST" action="{{ route('post.EditProfile', $user[0]['id']) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-inputs clearfix">
                    <p>
                        <label>First Name</label>
                        <input type="text" name="firstname" value="{{ $user[0]['firstname'] }}">
                    </p>
                    <p>
                        <label>Last Name</label>
                        <input type="text" name="lastname" value="{{ $user[0]['lastname'] }}">
                    </p>
                    <p>
                        <label class="required">E-Mail</label>
                        <input type="email" disabled name="email" value="{{ $user[0]['email'] }}">
                    </p>
                    <p>
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{ $user[0]['phone'] }}">
                    </p>
                    <p>
                        <label class="required">Password<span>*</span></label>
                        <input type="password" value="">
                    </p>
                    <p>
                        <label class="required">Confirm Password<span>*</span></label>
                        <input type="password" value="">
                    </p>
                </div>
                
                <div class="form-style form-style-2">
                    <div class="user-profile-img"><img src="@if($user[0]['avatar'] == null) {{ url(asset('page/images/demo/admin.jpg')) }} 
                        @else {{ url(asset($user[0]['avatar'])) }} @endif" alt="admin"></div>
                    <p class="user-profile-p">
                        <label>Profile Picture</label>
                    <div class="fileinputs">
                        <input type="file" class="file" name="avatar">
                        <div class="fakefile">
                            <button type="button" class="button small margin_0">Select file</button>
                            <span><i class="icon-arrow-up"></i>Browse</span>
                        </div>
                    </div>
                    <p></p>
                    <div class="clearfix"></div>

                </div>

                <p>
                    <label>About Yourself</label>
                    <textarea cols="58" rows="8" name="mix">@cartman and @kyle do not know #homer</textarea>
                </p>

                <p class="form-submit">
                    <input type="submit" value="Update Profile" class="button color small login-submit submit">
                </p>
            </form>

            <br><br>

            {{--=====================================--}}

            <div class="page-content page-content-user-profile">
                <div class="user-profile-widget">
                    <h2 style="color: #fdb655">My Stats</h2>
                    <hr>

                    <div class="tabs-warp question-tab">
                        <ul class="tabs">
                            {{--<li class="tab"><a href="#" class="current"><i style="color: yellow" class="icon-question-sign"></i>Total Of Questions( <span>{{ $user_detail[0]['num_post'] }}</span> )</a></li>--}}
                            <li class="tab"><a href="#"><i style="color: #3498db" class="icon-comment"></i>Answered Questions( <span>{{ $user[0]['post_answered'] }}</span> )</a></li>
                            <li class="tab"><a href="#"><i style="color: orangered" class="icon-question"></i>Unanswered Questions( <span>{{ $user[0]['num_post'] - $user[0]['post_answered'] }}</span> )</a></li>
                        </ul>

                        <div class="tab-inner-warp">
                            <div class="tab-inner">
                                @for($i = 0; $i < $user[0]['post_answered']; $i ++)
                                    <article class="question user-question">
                                        <h3>
                                            <a href="single_question.html">This is my third Question</a>
                                        </h3>
                                        <a class="question-report blue-button" href="{{route('get.QuestionDetails',$user[0]['id'])}}">Details</a>
                                        <!-- <div class="question-type-main"><i class="icon-question-sign"></i>Question</div> -->
                                        <div class="question-content">
                                            <div class="question-bottom">
                                                <div class="question-answered question-answered-done"><i class="icon-ok"></i>Solved</div>
                                                <span class="question-category"><a href="#"><i class="icon-folder-close"></i>HTML</a></span>
                                                <span class="question-date"><i class="icon-time"></i>15 secs ago</span>
                                                <span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answers</a></span>
                                                <a class="question-reply" href="#"><i class="icon-heart"></i>4 votes</a>
                                                <span class="question-view"><i class="icon-user"></i>70 views</span>
                                            </div>
                                        </div>
                                    </article>
                                @endfor
                            </div>
                        </div>

                        <div class="tab-inner-warp">
                            <div class="tab-inner">
                                @for($i = 0; $i < $user[0]['num_post'] - $user[0]['post_answered']; $i ++)
                                    <article class="question user-question">
                                        <h3>
                                            <a href="single_question_poll.html">This Is my second Question</a>
                                        </h3>
                                        <a class="question-report blue-button" href="{{route('get.QuestionDetails',$user[0]['id'])}}">Details</a>
                                        <!-- <div class="question-type-main"><i class="icon-signal"></i>Poll</div> -->
                                        <div class="question-content">
                                            <div class="question-bottom">
                                                <div class="question-answered"><i class="icon-flag"></i>Reported</div>
                                                <span class="question-category"><a href="#"><i class="icon-folder-close"></i>CSS</a></span>
                                                <span class="question-date"><i class="icon-time"></i>15 secs ago</span>
                                                <span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answers</a></span>
                                                <a class="question-reply" href="#"><i class="icon-heart"></i>4 votes</a>
                                                <span class="question-view"><i class="icon-user"></i>70 views</span>
                                            </div>
                                        </div>
                                    </article>
                                @endfor
                            </div>
                        </div>

                    </div>
                </div><!-- End user-profile-widget -->
            </div><!-- End page-content -->

        </div>
    </div>
    <div class="height_20"></div>
    {{--Chuyển trang--}}
    <div class="pagination">
        <a href="#" class="prev-button"><i class="icon-angle-left"></i></a>
        <span class="current">1</span>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <span>...</span>
        <a href="#">11</a>
        <a href="#">12</a>
        <a href="#">13</a>
        <a href="#" class="next-button"><i class="icon-angle-right"></i></a>
    </div><!-- End pagination -->
@endif
@section('javascript')
<script>
    var input = document.querySelector('[name=mix]');

        tagify = new Tagify(input, {
            mode : 'mix',
            pattern : /@|#/,
            enforceWhitelist : true,
            whitelist : [
                {
                    value : 'cartman'
                },
                {
                    value : 'kyle'
                }
            ],
            dropdown   : {
                enabled : 1
            }
        });

        tagify.on('input', function(e) {
            var prefix = e.detail.prefix;

            if(prefix) {
                if( prefix == '@' )
                    tagify.settings.whitelist = whitelist_1;

                if( prefix == '#' )
                    tagify.settings.whitelist = whitelist_2;

                if( e.detail.value.length > 1 )
                    tagify.dropdown.show.call(tagify, e.detail.value);
            }
            tagify.addTags(["Cuong"]);
            
            console.log('mix-mode "input" event value: ', e.detail);
        });
</script>
@endsection
@endsection
