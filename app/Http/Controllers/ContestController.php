<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\User;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewBadge;

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
        if($request->price){
            $query = User::query();
            
            $query->has('offer');
            
            $contest = Contest::find(1);
            
            if($contest) {
                $query->whereHas('offer', function ($query) use ($contest){
                    $query->where('created_at', '>=', $contest->last_datetime);
                });
            }
            $query->withCount('offer')->orderBy('offer_count', 'desc');
            
            $user = $query->first();
            if($user){
                $users = User::get();
                foreach($users as $u){
                    $u->notify(new NewBadge($user, "ContestWinner"));
                }
                DB::table('badge_user')->insert([
                    "badge_id" => 5, // ContestWinner
                    "user_id" => $user->id,
                ]);
            }
        }
        dd("yep");
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
