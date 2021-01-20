@extends('layouts.admin')

@section('content')

<section class="container mx-auto py-4">
  <h4>予約一覧</h4>
  <div align="right">
  <a href="{{ route('output_csv') }}" class="btn btn-primary">CSV出力</a>
  </div>
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
    <tbody>
    @foreach ($reservation_list as $item)
      <div class="entry">
      <tr>
        <td class="border border-gray-600 py-1 px-1">{{ $item->id }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $item->name1 }} {{ $item->name2 }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $item->name3 }} {{ $item->name4 }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $item->email }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $item->date }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $item->reservation_plan }}</td>
        <td class="border border-gray-600 py-1 px-1">{{ $item->rnum }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

@if(count($reservation_list) < 1)
<p>予約なし</p>
@endif

{{ $reservation_list->links() }}

@endsection