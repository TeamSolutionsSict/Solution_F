@extends('page.master')
@section('title', 'Tag List')
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
        <div class="tag col-lg-12">
            @foreach($tag as $key=>$value)
                <div class="tag_detail col-lg-3">
                    <div class="content">
                        <ul>
                            <li><a href="#"><span>{{ str_limit($value['keyword'], 14) }}</span></a></li>
                            <li><p>Posts: <span>{{ $value->num_keyword }}</span></p></li>
                        </ul>
                    </div>
                    <hr>
                </div>
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
