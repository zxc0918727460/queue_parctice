@extends('layouts.app')

@section('content')
<div >
	<center>
		<div style="text-align: center;" class="col-sm-offset-3 col-sm-6">
			<h1>國立高雄應用科技大學<br>演唱會兌票系統</h1>
			<img src="/logo.png" width="200" height="200"><br>
				本次瀏覽此網站的IP為：<?php echo $_SERVER['REMOTE_ADDR'] ?>
		</div>
		<hr> 
		<form action="{{ url('/ticket/check') }}" method="POST" class="form-horizontal">
		{{ csrf_field() }}
			<table  width="250px"  border="1" cellspacing="0" >
				<tr>
						<td>會員id</td>
						<td><input type='text'  name='member_name' required='required' ></td>
				</tr>	
			</table>
			<div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i>查詢
                    </button>
                </div>
            </div>
		</form>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard123</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    管理者 are logged in! 

                    test====>{{ $name ?? 'none' }}
                    @if (Session::has('flash_message'))
			            <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
			        @endif
                </div>
                <div>
				    <center>
				        <button onclick="location.href='{{ url('home') }}'" class="btn btn-default">
				            返回首頁</button>
				    </center>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
