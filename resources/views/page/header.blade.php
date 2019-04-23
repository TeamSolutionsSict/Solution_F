@if(!Auth::check())
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
            <div class="form-inputs clearfix ">
                <input class="inavatar" type="file" id="av"  name="fileavatar" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"  >
                <img src="page/images/avatar/boy-512.png" class="avatarlogin" id="blah"   alt="your image"  />
                {{--src="page/images/avatar/boy-512.png"name="avatar"
                   onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"--}}
                <div id="response"></div>
                <p>
                    <label class="required {{ $errors->has('username') ? ' has-error' : '' }}">Username<span>*</span></label>
                    <input type="text" name="username" id="username" ONCHANGE="checkRegister()">
                    <span class="messages">{{ $errors->first('username') }}</span>
                </p>
                <p>
                    <label class="required {{ $errors->has('firstname') ? ' has-error' : '' }}">Firstname<span>*</span></label>
                    <input type="text" name="firstname" id="firstname" onchange="checkRegister()">
                    <span class="messages">{{ $errors->first('firstname') }}</span>
                </p>
                <p>
                    <label class="required {{ $errors->has('lastname') ? ' has-error' : '' }}">lastname<span>*</span></label>
                    <input type="text" name="lastname" id="lastname" ONCHANGE="checkRegister()">
                    <span class="messages">{{ $errors->first('lastname') }}</span>
                </p>
                <p>
                    <label class="required {{ $errors->has('email') ? ' has-error' : '' }}">E-Mail<span>*</span></label>
                    <input type="email" name="email" id="email" ONCHANGE="checkRegister()">
                    <span class="messages">{{ $errors->first('email') }}</span>
                </p>
                <p>
                    <label class="required {{ $errors->has('phone') ? ' has-error' : '' }}">Phone<span>*</span></label>
                    <input type="text" name="phone" id="phone" ONCHANGE="checkRegister()">
                    <span class="messages">{{ $errors->first('phone') }}</span>
                </p>
                <p>
                    <label class="required {{ $errors->has('password') ? ' has-error' : '' }}">Password<span>*</span></label>
                    <input type="password" name="password" id="password" onchange="checkRegister()">
                    <span class="messages">{{ $errors->first('password') }}</span>
                </p>
                <p>
                    <label class="required {{ $errors->has('confirmpassword') ? ' has-error' : '' }}">Confirm Password<span>*</span></label>
                    <input type="password" id="confirmpassword" name="confirmpassword" value="" ONCHANGE="checkRegister()">
                    <span class="messages">{{ $errors->first('confirmpassword') }}</span>
                </p>

            </div>
            <p class="form-submit">
                <input type="submit" value="Signup" class="button color small submit">
            </p>
        </form>
    </div>
</div><!-- End signup -->

<div class="panel-pop" id="lost-password">
    <h2>Forgot Password<i class="icon-remove"></i></h2>
    <div class="form-style form-style-3">
        <p>Lost your password? Please enter your username and email address. You will receive a link to create a new password via email.</p>
        <form method="post" action="{{route('post.EmailResetPass')}}">
            <input id="register" type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-inputs clearfix">
                <p>
                    <label class="required">Username<span>*</span></label>
                    <input type="text" name="username" id="username">
                </p>
                <p>
                    <label class="required">E-Mail<span>*</span></label>
                    <input type="email" name="email" id="email">
                </p>
            </div>
            <p class="form-submit">
                <input type="submit" value="Rest Password" class="button color small submit">
            </p>
        </form>
        <div class="clearfix"></div>
    </div>
</div><!-- End lost-password -->

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
    Window.onload= function (e) {
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

    }
    function checkRegister() {
        var username = $('#username').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var password = $('#password').val();
        var confirmpassword = $('#confirmpassword').val();
        $.ajax({
            url: '{{route('post.Register')}}',
            type: 'POST',
            dataType: "json",
            data: {
                username: username,
                email:email,
                phone:phone,
                firstname:firstname,
                lastname:lastname,
                password:password,
                confirmpassword:confirmpassword,
                _token: "{{csrf_token()}}",
            },
            success: function (data) {
                $('#list').append(data.view);
            },
            error :function( data ) {
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {

                        $('#response').addClass("alert alert-danger");
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                console.log(key + " " + value);
                                $("#"+key).val("");
                                $("#"+key).attr("placeholder", value);

                            });
                        } else {
                            $("#"+key).val("");
                            $("#"+key).attr("placeholder", value);//this is my div with messages
                        }

                    });
                }
            }
        })
    }
</script>
