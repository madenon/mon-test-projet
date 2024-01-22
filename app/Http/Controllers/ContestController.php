<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ContestController extends Controller
{
    public function index(){
        $currentDate = Carbon::now();
        $startOfWeek = Carbon::now();
        $endOfWeek = Carbon::now();

        // Find the start and end of the current week
        $startOfWeek->startOfWeek();
        $endOfWeek->endOfWeek();

        // Get all contests of the week
        $contestsOfTheWeek = Contest::whereBetween('start_datetime', [$startOfWeek, $endOfWeek])
            ->get();
        $previousContests = Contest::where('start_datetime', '<=' , $startOfWeek)
            ->get();
            
        return view('contests.index', compact('contestsOfTheWeek', 'previousContests'));    
    }
    
    public function reinitiliaze(Request $request)
    {    
        $contestData = [
            'last_datetime' => Carbon::now(),
        ];
        
        Contest::updateOrCreate(['id' => 1],$contestData);
        
        return redirect()->back()->with('success', 'Contest reinitialize successfully!');
        
    }
    public function reinitiliaze(Request $request)
    {    
        $contestData = [
            'last_datetime' => Carbon::now(),
        ];
        
        Contest::updateOrCreate(['id' => 1],$contestData);
        
        return redirect()->back()->with('success', 'Contest reinitialize successfully!');
        
    }
    
    public function contestRegistration($contestId){
        $data = [
            'contest_id' => $contestId,
            'user_id' => auth()->id()
        ];
        
        $rules = [
            'contest_id' => 'required|integer|exists:contests,id',
            'user_id' => 'required|integer|exists:users,id',
        ];
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try{
            DB::table('contest_user')->insert($data);
        }catch( Exception $e){
            return redirect()->back()->withErrors($validator)->withInput();
        }
         
        return redirect()->back();
    }

}
