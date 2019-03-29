@extends('page.master')
@section('title', 'Term')
@section ('section-warp')
    <div class="section-warp ask-me">

    </div><!-- End section-warp -->
@endsection

@section('content')

    <div class="page-content ask-question">
        <div class="boxedtitle page-title"><h2>Đây là điều khoản</h2></div>
        <p>Nội dung điều khoản đang để trống</p>
        <h2>Cứ tích đã đọc và đồng ý là được nhé :v</h2>
        <hr>
        <br>
        {{--<div class="row checkBox">--}}
            {{--<form action="">--}}
                {{--<div onchange="inputEventPatched(this)" class="col-lg-10 checkBox1">--}}
                    {{--<input type="checkbox" value='<a href="{{ route('get.AddQuestion') }}" type="submit" id="publish-question" class="button color small submit" style="text-align: center">Continue</a>'><span>I agree to the terms of use.</span>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2">--}}
                    {{--<div id="result" style="width: 100%">--}}
                        {{--<input class="button small red-button" style="text-align: center; width: 100%" onclick="notChecked()" value="Continue">--}}
                    {{--</div>--}}
                    {{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
                    {{--<script>--}}
                        {{--function notChecked() {--}}
                            {{--swal ( "Can't continue" ,  "Please agree to the terms of use!" ,  "error" )--}}
                        {{--}--}}
                    {{--</script>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
        {{--<script language="javascript">--}}
            {{--function inputEventPatched(obj){--}}
                {{--var input = obj.children;--}}
                {{--var html = '';--}}
                {{--for (var i = 0; i < input.length; i++){--}}
                    {{--if (input[i].checked){--}}
                        {{--html += input[i].value;--}}
                    {{--}--}}
                {{--}--}}
                {{--document.getElementById('result').innerHTML = html;--}}
            {{--}--}}
        {{--</script>--}}
        <div class="row checkBox">
            <form action="">
                <div onchange="inputEventPatched(this)" class="col-lg-10 checkBox1">
                    <input type="checkbox" id="chkYes"><span>I agree to the terms of use.</span>
                </div>
                <div class="col-lg-2">
                    <div id="result" style="width: 100%">
                        <a href="{{ route('get.AddQuestion') }}" class="button color small submit hidden" id="btn-next" style="text-align: center; width: 100%">Continue</a>
                    </div>
                </div>
            </form>
        </div>
        <script language="javascript">
            function inputEventPatched(obj){
                var input = document.getElementById("chkYes");
                var buttonNext = document.getElementById("btn-next");
                if (input.checked === true) {
                    buttonNext.classList.remove("hidden");
                }else{
                    buttonNext.classList.add("hidden");
                }
            }
        </script>

        <div class="form-style form-style-3" id="question-submit">

        </div>
    </div>

@endsection
