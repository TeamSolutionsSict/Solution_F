@extends('page.master')
@section('title', 'User list')
@section ('section-warp')
    <div class="section-warp ask-me">

    </div><!-- End section-warp -->
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <h1>Users</h1>
        </div>
        <div class="search_user col-md-9">
            <input id="search" name="search" class="form-control" type="text" placeholder="Filter by user">
        </div>
    </div>
    <hr><br>
    <div class="row">
        <div class="user col-lg-12">
            @foreach($user as $key=>$value)
                <div class="user_detail col-lg-3">
                    <div class="avatar col-4">
                        <a href="{{ route('get.UserDetail', $value['username']) }}"><img src="https://cdn0.iconfinder.com/data/icons/profession-vol-1/32/programmer_coder_developer_encoder_engineer_computer_coding-512.png" alt="Avatar"></a>
                    </div>
                    <div class="content col-8">
                        <ul>
                            <li><a href="{{ route('get.UserDetail',$value['username']) }}"><span><b>{{ str_limit($value['username'], 14) }}</b></span></a></li>
                            <li>Posts: <span><b>{{ $value['num_post'] }}</b></span></li>
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
                url  : '{{ URL::to('user-list/search') }}',
                data : {'search':$value},
                success:function (data) {
                    $('.user').html(data);
                }
            })
        })
    </script>

@endsection
