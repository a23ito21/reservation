<h3>予約内容確認</h3>
<form method="post" action="{{ route('form.send') }}">
	@csrf
	<label>姓名</label>
	<div>
		{{ $input["name1"] }}		{{ $input["name2"] }}
	</div>
	<label>フリガナ</label>
	<div>
		{{ $input["name3"] }}		{{ $input["name4"] }}
	</div>
	<label>メールアドレス</label>
	<div>
		{{ $input['email'] }}
	</div>
	<label>予約日時</label>
	<div>
		{{ $input['date'] }}
	</div>
	<label>予約内容</label>
	<div>
		{{ $input['reservation_plan'] }}
	</div>
    </br>
	<input name="back" type="submit" value="修正" />
	<input type="submit" value="予約内容の確定" />

</form>