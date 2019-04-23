<div class="login-panel">
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="page-content">
                    <h2>Login</h2>
                    <div class="form-style form-style-3">
                        <form action="{{ route('post.Login') }}" method="POST">
                                {{ csrf_field() }}
                                @if(Session::has('flag'))
                                    <div class="alert-message {{ Session::get('flag') }}">{{ Session::get('message') }}</div>
                                @endif
                                <div class="form-inputs clearfix">
                                    <p class="login-text">
                                        <input type="text" value="Username" name="username" onfocus="if (this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}">
                                        <i class="icon-user"></i>
                                    </p>
                                    <p class="login-password">
                                        <input type="password" value="Password" name="password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}">
                                        <i class="icon-lock"></i>
                                        <a href="#">Forget</a>
                                    </p>
                                </div>
                                <p class="form-submit login-submit">
                                    <input type="submit" value="Log in" class="button color small login-submit submit">
                                </p>
                                <div class="rememberme">
                                    <label><input type="checkbox" checked="checked"> Remember Me</label>
                                </div>
                            </form>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
            <div class="col-md-6">
                <div class="page-content Register">
                    <h2>Register Now</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravdio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequa. Vivamus vulputate posuere nisl quis consequat.</p>
                    <a class="button color small signup">Create an account</a>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div>
    </section>
</div><!-- End login-panel -->

<div class="panel-pop" id="signup">
    <h2>Register Now<i class="icon-remove"></i></h2>
    <div class="form-style form-style-3">
        <form method="post" action="{{route('post.Register')}}" enctype="multipart/form-data" ONCHANGE="checkRegister">
            <input id="register" type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-inputs clearfix">
                <input class="inavatar" type="file" id="av"  name="fileavatar" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"  >
                <img src="{{asset('page/images/avatar/boy-512.png')}}" class="avatarlogin" id="blah"   alt="your image"  />
                    {{--src="page/images/avatar/boy-512.png"name="avatar"
                       onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"--}}
                <p>
                    <label class="required">Username<span>*</span></label>
                    <input type="text" name="username" id="username" >
                    <span class="messages"></span>
                </p>
                <p>
                    <label class="required">First Name<span>*</span></label>
                    <input type="text" name="firstname" id="firstname">
                    <span class="messages"></span>
                </p>
                <p>
                    <label class="required">Last Name<span>*</span></label>
                    <input type="text" name="lastname" id="lastname">
                    <span class="messages"></span>
                </p>
                <p>
                    <label class="required">E-Mail<span>*</span></label>
                    <input type="email" name="email" id="email">
                    <span class="messages"></span>
                </p>
                <p>
                    <label class="required">Phone<span>*</span></label>
                    <input type="text" name="phone" id="phone">
                    <span class="messages"></span>
                </p>
                <p>
                    <label class="required">Password<span>*</span></label>
                    <input type="password" name="password" id="password">
                    <span class="messages"></span>
                </p>
                <p>
                    <label class="required">Confirm Password<span>*</span></label>
                    <input type="password" name="confirmpassword" value="">
                    <span class="messages"></span>
                </p>
            </div>
            <p class="form-submit">
                <input type="submit" value="Signup" class="button color small submit">
            </p>
        </form>
    </div>
</div><!-- End signup -->

<div class="panel-pop" id="lost-password">
    <h2>Lost Password<i class="icon-remove"></i></h2>
    <div class="form-style form-style-3">
        <p>Lost your password? Please enter your username and email address. You will receive a link to create a new password via email.</p>
        <form>
            <div class="form-inputs clearfix">
                <p>
                    <label class="required">Username<span>*</span></label>
                    <input type="text">
                </p>
                <p>
                    <label class="required">E-Mail<span>*</span></label>
                    <input type="email">
                </p>
            </div>
            <p class="form-submit">
                <input type="submit" value="Reset" class="button color small submit">
            </p>
        </form>
        <div class="clearfix"></div>
    </div>
</div><!-- End lost-password -->
@endif
<div id="header-top">
    <section class="container clearfix">
        <nav class="header-top-nav">
            <ul>
                <li><a href="{{route('get.Contact')}}"><i class="icon-envelope"></i>Contact</a></li>
                {{--<li><a href="#"><i class="icon-headphones"></i>Support</a></li>--}}
                {{-- Sau khi đăng nhập, nút này sẽ thành Profile và ẩn đi form login --}}
                @if(Auth::check())
                    <li><a href="{{ route('get.Profile', Auth::user()->id) }}"><i class="icon-user"></i>Profile</a></li>
                @else             
                    <li><a href="" id="login-panel"><i class="icon-user"></i>Login Area</a></li>
                @endif
            </ul>
        </nav>
    </section><!-- End container -->
</div><!-- End header-top -->
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo"><a href="{{route ('get.Home')}}"><img alt="" src="{{url(asset('page/images/logo.png'))}}"></a></div>
            </div>
            <div class="col-md-9">
                <div class="searchnav">
                    <form>
                        <button type="submit"><a href="#" title=""><i class="icon-search"></i></a></button>
                        <input type="search" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';" onblur="if(this.value=='')this.value='Search here ...';">
                    </form>
                </div>

            </div>
        </div>
    </div>
</header>
<script >
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log('ditm me');
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#av").change(function() {
        readURL(this);
    });
    function checkRegister() {
        var username = $('#username').html();
        var email = $('#email').html();
        var phone = $('#phone').html();
        $.ajax({
            url: '{{route('post.test')}}',
            type: 'POST',
            data: {
                username: username,
                email:email,
                phone:phone,
                _token: $('#register').val(),
            },
        })
    }
</script>
