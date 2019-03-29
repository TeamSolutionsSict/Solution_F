<aside class="col-md-3 sidebar">
    <div class="widget widget_stats">
        <h3 class="widget_title">My Stats</h3>
        <div class="ul_list ul_list-icon-ok">
            <a style="color: white; width: 100%; text-align: center" href="route('get.Terms')" class="button large lime-green-button">Add Questions</a>
            <ul>
                <li><i class="icon-question-sign"></i><a href="#">Total Of Questions<span> ( <span>{{$stats['total']}}</span> ) </span></a></li>
                <li><i class="icon-comment"></i><a href="#">Answered Questions<span> ( <span>{{$stats['answered']}}</span> ) </span></a></li>
                <li><i class="icon-question"></i><a href="#">Unanswered Questions<span> ( <span>{{$stats['unanswered']}}</span> ) </span></a></li>
                <li><i class="icon-remove"></i><a href="#">Reported Questions<span> ( <span>{{$stats['reported']}}</span> ) </span></a></li>
            </ul>
        </div>
    </div>

    <div class="widget widget_social">
        <h3 class="widget_title">Reputation</h3>
        <ul>
            <li class="rss-subscribers">
                <a href="{{ route('get.UserList') }}">{{--target="_blank"--}}
                    <strong>
                        <i class="icon-user"></i>
                        <span>User</span><br>
                        <small>Best achievement</small>
                    </strong>
                </a>
            </li>
            <li class="facebook-fans">
                <a href="{{ route('get.TagList') }}">
                    <strong>
                        <i class="social_icon-klout"></i>
                        <span>Tags</span><br>
                        <small>Keyword</small>
                    </strong>
                </a>
            </li>
            {{--<li class="twitter-followers">--}}
                {{--<a href="#" target="_blank">--}}
                    {{--<strong>--}}
                        {{--<i class="social_icon-twitter"></i>--}}
                        {{--<span>3,000</span><br>--}}
                        {{--<small>Followers</small>--}}
                    {{--</strong>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="youtube-subs">--}}
                {{--<a href="#" target="_blank">--}}
                    {{--<strong>--}}
                        {{--<i class="icon-play"></i>--}}
                        {{--<span>1,000</span><br>--}}
                        {{--<small>Subscribers</small>--}}
                    {{--</strong>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </div>

    <div class="widget widget_tag_cloud">
        <h3 class="widget_title">Tags</h3>{{--Tag ở phần này sẽ hiển thị random--}}
        @foreach($randomTag as $key=>$value)
            <a href="#">{{ $value->keyword }}</a>
        @endforeach
    </div>

</aside><!-- End sidebar -->
