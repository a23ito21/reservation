<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReservationForm;

class SearchCondition {
    public $search_id;
    public $search_name1;
    public $search_name2;
    public $search_name3;
    public $search_name4;
	public $search_date;
	public $search_plan;
	public $search_rnum;
    
	function __construct($input){
		$this->search_id = (isset($input["search_id"])) ? $input["search_id"] : null;
		$this->search_name1 = (isset($input["search_name1"])) ? $input["search_name1"] : null;
		$this->search_name2 = (isset($input["search_name2"])) ? $input["search_name2"] : null;
		$this->search_name3 = (isset($input["search_name3"])) ? $input["search_name3"] : null;
		$this->search_name4 = (isset($input["search_name4"])) ? $input["search_name4"] : null;
		$this->search_date = (isset($input["search_date"])) ? $input["search_date"] : null;
		$this->search_plan = (isset($input["search_plan"])) ? $input["search_plan"] : null;
		$this->search_rnum = (isset($input["search_rnum"])) ? $input["search_rnum"] : null;
	}
}

class ReservationSearcher {

	private $condition;

	function __construct(SearchCondition $condition){
		$this->condition = $condition;
}

	function where() {
		return $this;
	}

    //検索実行
    function search(){
		//クエリーの準備
		$query = ReservationForm::orderBy("id","desc");

		// $ret = Customer::orderBy("id","desc")->get();
		// ↓
		// $query = Customer::orderBy("id","desc");
		// $ret = $query->get();
		// $ret = $query->paginate();

		$condition = $this->condition;

		//IDは完全一致
		if($condition->search_id){
			$query->where("id","=", $condition->search_id);
		}
		//名前は部分一致
		if($condition->search_name1){
			$query->where("name1","like","%" . $condition->search_name1 . "%");
		}
		if($condition->search_name2){
			$query->where("name2","like","%" . $condition->search_name2 . "%");
		}

		//ヨミガナは部分一致
		if($condition->search_name3){
			$query->where("name3","like","%" . $condition->search_name3 . "%");
		}
		if($condition->search_name4){
			$query->where("name4","like","%" . $condition->search_name4 . "%");
		}

		//日付は完全一致
		if($condition->search_date){
			$query->where("date","=", $condition->search_date);
        }
        
		//プランは完全一致
		if($condition->search_plan){
			$query->where("reservation_plan","=", $condition->search_plan);
        }
        //予約番号は部分一致
		if($condition->search_rnum){
			$query->where("rnum","like","%" . $condition->search_rnum . "%");
        }
		//10件ずつ表示
		$results = $query->paginate(10);

		//ページャーに条件を引き継ぐ
		$results->appends(["search" => $condition]);

		return $results;
	}
}

class ReservationSearcherController extends Controller
{
    function showSearch(){
		return view("admin.admin_search_result");
	}

    function search(Request $request){
	//	$url = "http://127.0.0.1:8000/admin/search?search%5Bsearch_plan%5D=%E3%83%97%E3%83%A9%E3%83%B31_XXXXX&page=2";
	//	$parse_url = parse_url($url);
	//	dump($parse_url);
	//	parse_str($parse_url["query"], $query);
	//	dd($query);

		//フォームの入力値を受け取る
		$search_input = $request->input("search", []);
		//検索条件を作成
		$condition = new SearchCondition($search_input);
	
		//検索オブジェクトを作る
		$searcher = new ReservationSearcher($condition);
		
		//結果を受け取る
		$results = $searcher->search();
		return view("admin.admin_search_result", [
			"condition" => $condition,
			"results" => $results
		]);		
	}
}

/*
class ReservationSearcherController extends Controller
{

    //検索フォームに入力された情報をsearch_inputに渡す
        function search(Request $request){
            $input = $request->only($this->searchItems);
            $request->session()->put("search_input",$input);
    dd($input);
            return redirect()->action("ManagePlanController@searchresult");
        }
    
        function searchresult(Request $request){
            //  検索フォームに入力された情報を取り出す
            $input = $request->session()->get("search_input");
    
            //  テーブルから検索結果に該当するデータを取り出す
            //　検索フォームに入っていないものは無視して複数条件で検索する
    //      $item = ReservationForm::where("id", XX)->get();
            $item = ReservationForm::orderBy("id","desc")->get();
            //　admin/reservation_listにデータを受け渡す
            return view("admin.reservation_list",[
                "reservation_list" => $item
            ]);
        }
}
*/