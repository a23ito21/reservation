<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReservationForm;


class ManagePlanController extends Controller
{

    function showlist(){
        //  テーブルからすべてのデータを取り出す
        $all = ReservationForm::orderBy("id","desc")->paginate(10);

        //　admin/reservation_listにデータを受け渡す
        return view("admin.reservation_list",[
            "reservation_list" => $all
        ]);
    }

    function outputCsv(Request $request){

        $all = ReservationForm::orderBy("id","desc")->get();
        
        ob_start();
        $fp = fopen("php://output", "w");

        fputcsv($fp,["ID","氏","名","フリガナ氏","フリガナ名","email","日付","プラン","予約番号"]);

        foreach($all as $reserve){
            fputcsv($fp,[
                //"ID"
                $reserve->id,
                //"氏名"
                $reserve->name1,
                $reserve->name2,
                //"フリガナ"
                $reserve->name3,
                $reserve->name4,
                //"email"
                $reserve->email,
                //"日付"
                $reserve->date,
                //"プラン"
                $reserve->reservation_plan,
                //"予約番号"
                $reserve->rnum
            ]);
        }
        //fputを閉じる
        fclose($fp);
        $csv_output = ob_get_contents();
        ob_end_clean();
        //文字化けしないようにシフトJISに変換する
        $csv_output = mb_convert_encoding($csv_output,"Shift-JIS","UTF-8");

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=reseve.csv");
        //データの大きさを示す
        header("Content-Length: " . strlen($csv_output));
        
        echo $csv_output;

        exit;
    }
}
