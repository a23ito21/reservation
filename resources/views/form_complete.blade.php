<h3>予約完了</h3>

<label>予約番号</label>
<div>
	{{ $rnum }}
</div>
<label>予約日時</label>
<div>
	{{ $input['date'] }}
</div>
<label>予約内容</label>
<div>
	{{ $input['reservation_plan'] }}
</br>        

<p>{{ $input['email'] }}宛にメールを送信しました!</p>

<a href="{{ route('form.show') }}"><button>予約ページに戻る</button></a>