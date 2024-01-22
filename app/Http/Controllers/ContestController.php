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
    
    public function store(Request $request)
    {    
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:invite_friends,total_transactions,total_amount',
            'value' => 'required|integer',
            'price' => 'required|integer',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date',
            'end_time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);
        
        
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $validatedData['start_date'] . ' ' . $validatedData['start_time']);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $validatedData['end_date'] . ' ' . $validatedData['end_time']);
        
        $contestData = [
            'title' => $validatedData['title'],
            'type' => $validatedData['type'],
            'value' => $validatedData['value'],
            'price' => $validatedData['price'],
            'start_datetime' => $startDateTime,
            'end_datetime' => $endDateTime,
            'description' => $validatedData['description'],
        ];
        
        Contest::create($contestData);
        
        return redirect()->back()->with('success', 'Contest created successfully!');
        
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
