@extends('page.master')
@section('title', 'Contact')
@section ('section-warp')
    <div class="section-warp ask-me">

    </div><!-- End section-warp -->
@endsection

@section('content')


    <div class="col-md-12">
        <div class="page-content">
            <h2 style="color: #fdb655">Reset Password</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat.</p>
            <br>
            <form class="form-style form-style-3 form-style-5 form-js" action="{{route('post.ResetPassword')}}" method="post">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="cc" value="{{$token}}">
                <div class="form-inputs clearfix">
                    <p>
                        <label for="password" class="required">Password<span>*</span></label>
                        <input type="password" class="required-item" value="" name="password" id="password" aria-required="true">
                    </p>
                    <p>
                        <label for="comfirmpassword" class="required">Confirm Password <span>*</span></label>
                        <input type="password" class="required-item" id="confirmpassword" name="confirmpassword" value="" aria-required="true">
                    </p>
                </div>
                {{--<div class="form-textarea">--}}
                    {{--<p>--}}
                        {{--<label for="message" class="required">Message<span>*</span></label>--}}
                        {{--<textarea id="message" class="required-item" name="message" aria-required="true" cols="58" rows="7"></textarea>--}}
                    {{--</p>--}}
                {{--</div>--}}
                <p class="form-submit">
                    <input name="submit" type="submit" value="Reset Password" class="submit button small color">
                </p>
            </form>
        </div>
    </div>

@endsection
