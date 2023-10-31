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
	</center>	
</div>
<div>		
	<center>
		<div>
			<button onclick="location.href='{{ url('create') }}'">
			創建會員</button>
		</div>
		<div>
			<button onclick="location.href='{{ url('update') }}'" class="btn btn-default">
			新增會員購票資訊</button>
		</div>
		<div>
			<button onclick="location.href='{{ url('check') }}'" class="btn btn-default">
			查詢會員是否購票</button>
		</div>
	</center>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
