<h2>予約フォーム</h2>

@if ($errors->any())
<div style="color:red;">
<ul>
	@foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
	@endforeach
</ul>
</div>
@endif

<form method="post" action="{{ route('form.post') }}">
@csrf

    <lavel>姓</lavel>
    <div>
        <input type="text" name="name1" value="{{ old('name1') }}" style="width:150px"/>
    </div>
    <lavel>名</lavel>
    <div>
        <input type="text" name="name2" value="{{ old('name2') }}" style="width:150px"/>
    </div>
    <lavel>姓（カナ）</lavel>
    <div>
        <input type="text" name="name3" value="{{ old('name3') }}" style="width:150px"/>
    </div>
    <lavel>名（カナ）</lavel>
    <div>
        <input type="text" name="name4" value="{{ old('name4') }}" style="width:150px"/>
    </div>
    <lavel>メールアドレス</lavel>
    <div>
        <input type="text" name="email" value="{{ old('email') }}" style="width:300px"/>
    </div>
    <lavel>予約日</lavel>
    <div>
        <input type="date" name="date" value="{{ old('date') }}" style="width:150px"/>
    </div>
    <lavel>予約内容の選択</lavel>
    <div>
        <select name="reservation_plan" style="width:300px">
            <option value="">Please select plan</option>
            @foreach($plan_list as $key => $plan)
            <option value="{{ $key }}"
            @if ($key == old('reservation_plan'))
                selected="selected"
            @endif
            >{{ $plan->name }}</option>
            @endforeach
        </select>
    </div>
    </br>
    <input class="btn btn-primary" type="submit" value="確認画面へ" />
</form>