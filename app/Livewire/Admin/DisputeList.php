<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Dispute;
use Livewire\WithPagination;


class DisputeList extends Component
{
    use WithPagination;
    
    public function render(Request $request)
    {
        $query = Dispute::query();
    
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
    
        $disputes = $query->paginate(10);
    
    
        return view('livewire.admin.dispute-list',[
            'disputes' => $disputes,
        ]);
    }
    
    public function changeState($disputeId){
        $dispute=Dispute::find($disputeId);
        $dispute->isOpen=!$dispute->isOpen;
        $dispute->save();
    }

}
