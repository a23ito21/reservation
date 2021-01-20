@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">管理側TOP</div>
		<div class="card-body">
			<div>
				<a href="{{ url('admin/list') }}" class="btn btn-primary">予約一覧</a>
			</div>
			<form method="post" action="{{ route('searchresult') }}">
			@csrf 
				<div class="mt-3">
					<input class="btn btn-info" type="submit" value="予約検索" />
				</div>
			</form>
			
			<br />
			<form method="post" action="{{ url('admin/logout') }}">
				@csrf
				<input type="submit" class="btn btn-danger" value="ログアウト" />
			</form>
			
		</div>
	</div>
</div>
@endsection