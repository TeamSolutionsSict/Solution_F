@extends('page.master')
@section('title', 'Add question')
@section ('section-warp')
    <div class="section-warp ask-me">

    </div><!-- End section-warp -->
@endsection
@section('content')
    <div class="page-content ask-question">
        <div class="boxedtitle page-title"><h2>Ask Question</h2></div>

        <div class="form-style form-style-3" id="question-submit">
            <form action="{{ route('post.AddQuestion') }} " method="POST">
                {{ csrf_field() }}
                <div class="form-inputs clearfix">
                    <p>
                        <label class="required">Question Title<span>*</span></label>
                        <input type="text" id="question-title" name="title">
                        <span class="form-description">Please choose an appropriate title for the question to answer it even easier .</span>
                    </p>
                    <p>
                        <label>Tags</label>
                        <input type="text" class="input" name="question_tags" id="question_tags" data-seperator=",">
                        <span class="form-description">Please choose  suitable Keywords Ex : <span class="color">question , poll</span> .</span>
                    </p>
                    <label class="required">Details<span>*</span></label>
                </div>
                <div id="form-textarea" style="margin-top:10px;">
                    <p>
                        <textarea id="editor1" aria-required="true" name="content"></textarea>
                    </p>
                </div>
                <textarea name="content_code" rows="4" cols="50" id="editor">
                    
                    // NHẬP CODE CỦA BẠN Ở ĐÂY

                 </textarea>
                 <input type="hidden" name="content_code">
                <p class="form-submit">
                    <input type="submit" id="publish-question" value="Publish Your Question" class="button color small submit">
                </p>
            </form>
        </div>
    </div>
    <script src="{{asset('page/ckeditor/ckeditor.js')}}"></script>
    <script> CKEDITOR.replace('editor1');  </script>
    <script> hljs.initHighlightingOnLoad(); </script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>
<script>
    var editor = ace.edit('editor');
        editor.session.setMode("ace/mode/batchfile");
        editor.setTheme("ace/theme/monokai-sublime");
        editor.setOptions({
        maxLines: Infinity
        });
    var input = $('input[name="content_code"]');
        editor.getSession().on("change", function () {
        input.val(editor.getSession().getValue());
    });   
</script>
@endsection
