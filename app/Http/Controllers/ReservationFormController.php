<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\ReservationForm;

class SamplePlan {

    public $name;

    function __construct($name){
        $this->name = $name;
    } 
}

class ReservationFormController extends Controller
{
    private $formItems = ["name1","name2","name3","name4","email","date","reservation_plan"];

    private $validator = [
        "name1" => "required|string|max:30",
        "name2" => "required|string|max:30",
        "name3" => "required|string|max:30",
        "name4" => "required|string|max:30",
        "email" => "required|string|max:30|email",
        "date" => "date",
        "reservation_plan" =>"required"
    ];
        
    function show(){

       $plan_list = [];
       
         $plan_list["プラン1_XXXXX"] = new SamplePlan("XXXXX");
         $plan_list["プラン2_YYYYY"] = new SamplePlan("YYYYY");
         $plan_list["プラン3_ZZZZZ"] = new SamplePlan("ZZZZZ");
        

        return view("form",[
            "plan_list" => $plan_list
        ]);
    }
    
    function post(Request $request){
        $input = $request->only($this->formItems);
        
        $validator = Validator::make($input, $this->validator);
        if($validator->fails()){
            return redirect()->action("ReservationFormController@show")
                ->withInput()
                ->withErrors($validator);
        }

        $request->session()->put("form_input",$input);

        return redirect()->action("ReservationFormController@confirm");
    }

    function confirm(Request $request){
        $input = $request->session()->get("form_input");
        
        if(!$input){
            return redirect()->action("ReservationFormController@show");
        }
        return view("form_confirm",["input" => $input]);
    }

    function send(Request $request){
        $input = $request->session()->get("form_input");
        if($request->has("back")){
            return redirect()->action("ReservationFormController@show")
            ->withInput($input);
        }
        if($request->has("back")){
            return redirect()->action("ResercationFormController@show")
            ->withInput($input);
        }
        if(!$input){
            return redirect()->action("ReservationFormController@show");
        }
    }

    function import(Request $request){

        //入力内容をセッションから受け取る
        $input = $request->session()->get("form_input");
        //XXX
        $form_input = $request->only("name1", "name2", "name3", "name4", "email", "date", "reservation_plan");

        //ランダムな英数字の組み合わせを作成
        $rnum_list = str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789');
        //ランダムな英数字の組み合わせから8文字を取り出し「rnum」と定義
        $rnum = substr(str_shuffle($rnum_list), 0, 8);
        
        //※もしDBに存在する予約番号と一致した場合はもう一度rnumを定義しなおす
        while(true){
            $dat = ReservationForm::where("rnum","=",$rnum)->first();
            
            if($dat){
                $rnum = substr(str_shuffle($rnum_list), 0, 8);
                continue;
            }
            break;
        }

        $inputnum = $request->only('rnum');
        //セッションにrnumを登録
        $request->session()->put("rnum",$rnum);

        //ReservationFormモデルに入力内容を保存
        $entry = new ReservationForm();
        $entry->name1 = $input["name1"];
        $entry->name2 = $input["name2"];
        $entry->name3 = $input["name3"];
        $entry->name4 = $input["name4"];
        $entry->email = $input["email"];
        $entry->date = $input["date"];
        $entry->reservation_plan = $input["reservation_plan"];
        $entry->rnum = $rnum;
        $entry->save();

        $request->session()->forget("form_input");
        //$request->session()->put("reservation_preview", $input);

        //画面を遷移
        return redirect()->action("ReservationFormController@complete");
    }

    function complete(Request $request){
        //入力内容をセッションから受け取る
        //$input = $request->session()->get("reservation_preview");
        $rnum = $request->session()->get("rnum");

        $reserve = ReservationForm::where("rnum","=",$rnum)->first();
        //dd( $reserve );

        //「input」と「rnum」をviewに送る
        return view("form_complete",[
            "input" => $reserve,
            "rnum" => $rnum
        ]);
    }
        //※セッションの内容を破棄する
 }

