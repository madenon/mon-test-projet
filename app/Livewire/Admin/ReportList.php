<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Report;
use Livewire\WithPagination;


class ReportList extends Component
{ 
    use WithPagination;
    
    public function render(Request $request)
    {
        $query = Report::query();
    
        // Filter by role
        if ($request->has('isOpen') && $request->isOpen!='') {
            $query->where('isOpen', $request->isOpen);
        }
    
        if ($request->has('sort_created_at')) {
            $sortOrder = $request->input('sort_created_at');
            $query->orderBy('created_at', $sortOrder);
        }
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%$searchTerm%")
                      ->orWhere('description', 'like', "%$searchTerm%");
            });
        }
    
        $reports = $query->paginate(10);
    
    
        return view('livewire.admin.report-list',[
            'reports' => $reports,
        ]);
    }
    
    public function changeState($reportId){
        $report=Report::find($reportId);
        $report->isOpen=!$report->isOpen;
        $report->save();
    }
}
