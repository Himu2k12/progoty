<?php

namespace App\Http\Controllers;


use App\SavingAmount;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SavingsController extends Controller
{
    protected function showForm(){
        $MembersById=DB::table('savings_account_infos')
            ->select('*')
            ->where('field_man_id','=', Auth::user()->id)
            ->where('verify','=', 1)
            ->get();


        return view('back.savings.savings-form',['MembersById'=>$MembersById]);
    }
    public function memberById(Request $request){
        $MembersById=DB::table('savings_account_infos')
            ->select('*')
            ->where('id','=', $request->id)
            ->where('verify','=', 1)
            ->first();
        return response(json_encode($MembersById));
    }

    public function storeMoney(Request $request){
        $this->validate($request, [
            'member_id'=>'required',
            'amount'=>'required',
            'sheet_no'=>'required',
        ],[
            'amount.required'=>'Amount of money cannot be Blank!',
        ]);

        $storeMoney=new SavingAmount();
        $storeMoney->member_id=$request->member_id;
        $storeMoney->amount=$request->amount;
        $storeMoney->sheet_no=$request->sheet_no;
        $storeMoney->field_man_id=Auth::user()->id;
        $storeMoney->save();

        return redirect('/today-saving-collection');
    }
    public function todaySavings(){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];

        $everyDayCollection=DB::table('saving_amounts')
            ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
            ->select('savings_account_infos.applicant_name','savings_account_infos.id as mid','saving_amounts.*')
            ->where('saving_amounts.field_man_id','=',Auth::user()->id)
            ->whereDate('saving_amounts.created_at','=',$today)
            ->orderBy('saving_amounts.id','desc')
            ->get();

        return view('back.savings.current-day-savings',['everyDayCollection'=>$everyDayCollection]);

    }
    public function editTodaySavings($slug){
        $updateInfo=SavingAmount::where('slug',$slug)->first();
       return view('back.savings.edit-savings-form',['updateInfo'=>$updateInfo]);
    }
    public function updateDailysavings(Request $request){

        $this->validate($request, [
            'amount'=>'required',
            'sheet_no'=>'required',
        ],[
            'amount.required'=>'Amount of money cannot be Blank!',
        ]);
        $storeMoney=SavingAmount::find($request->id);
        $storeMoney->amount=$request->amount;
        $storeMoney->sheet_no=$request->sheet_no;
        $storeMoney->field_man_id=Auth::user()->id;
        $storeMoney->save();

        return redirect('/today-saving-collection');
    }

}
