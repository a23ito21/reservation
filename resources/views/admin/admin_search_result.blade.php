@extends('layouts.admin')

@section('content')
<section class="container mx-auto py-4">
	<form method="get" action="{{ route('searchresult') }}">
			@csrf 
				<div>
					ID: <input class="form-control" type="text" name="search[search_id]" value="{{ $condition->search_id }}" />
				</div>
				<div>
					名前（姓）: <input class="form-control" type="text" name="search[search_name1]" value="{{ $condition->search_name1 }}" />
				</div>
				<div>
					名前（名）: <input class="form-control" type="text" name="search[search_name2]" value="{{ $condition->search_name2 }}" />
				</div>
				<div>
					カナ（姓）: <input class="form-control" type="text" name="search[search_name3]" value="{{ $condition->search_name3 }}" />
				</div>
				<div>
					カナ（名）: <input class="form-control" type="text" name="search[search_name4]" value="{{ $condition->search_name4 }}" />
				</div>
				<div>
					日付: <input class="form-control" type="date" name="search[search_date]" value="{{ $condition->search_date }}" />
				</div>
				<div>
					プラン: <select class="form-control" type="text" name="search[search_plan]">
						<option value="">Please select plan</option>
		            	<option value="プラン1_XXXXX"
							@if($condition->search_plan == "プラン1_XXXXX")
							selected
							@endif
						>XXXXX</option>
        		    	<option value="プラン2_YYYYY"
							@if($condition->search_plan == "プラン2_YYYYY")
							selected
							@endif>YYYYY</option>
            			<option value="プラン3_ZZZZZ"
							@if($condition->search_plan == "プラン3_ZZZZZ")
							selected
							@endif>ZZZZZ</option>
        			</select>

					<input type="radio" name="plan"  value="プラン1_XXXX" @if($condition->search_plan == "プラン1_XXXXX")
							checked
							@endif/>
					XXXX
					<input type="radio" name="plan" value="プラン2_YYYYY" />
					YYYYY
				</div>
				<div>
					予約番号: <input class="form-control" type="text" name="search[search_rnum]" value="{{ $condition->search_rnum }}" />
				</div>
				<div class="mt-3">
					<!--検索条件リセット-->
					<div align="right">
						<input class="clearForm" type="button" value="検索条件リセット" />
					</div>
					<div align="right">
						<input class="btn btn-info" type="submit" value="検索する" />
					</div>
				</div>
	</form>
	<br />
	<h4>検索結果　-予約一覧-</h4>
	<h6>検索条件：</h6>	
	@if($results)
 	<table class="border border-gray-600">
    <thead>
      <tr>
        <th class="border border-gray-600 py-1 px-1">ID</th>
        <th class="border border-gray-600 py-1 px-1">氏名</th>
        <th class="border border-gray-600 py-1 px-1">フリガナ</th>
        <th class="border border-gray-600 py-1 px-1">email</th>
        <th class="border border-gray-600 py-1 px-1">日付</th>
        <th class="border border-gray-600 py-1 px-1">プラン</th>
        <th class="border border-gray-600 py-1 px-1">予約番号</th>
      </tr>
    </thead>
    @foreach ($results as $searchresult)
    <tbody>
      <div class="entry">
      <tr>
        <td class="border border-gray-600 py-1 px-1">{{ $searchresult->id }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $searchresult->name1 }} {{ $searchresult->name2 }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $searchresult->name3 }} {{ $searchresult->name4 }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $searchresult->email }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $searchresult->date }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $searchresult->reservation_plan }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $searchresult->rnum }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

  {{ $results->links() }}

</section>
@endif

@if(count($results) < 1)
<div align="center">
<p>予約なし</p>
</div>
@endif


@endsection