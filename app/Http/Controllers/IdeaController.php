<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {
        return view('ideas.show',compact('idea'));  // compact('idea') = ['idea'=>$idea]
    }

    public function store()
    {
        $validated = request()->validate([
            'content' => 'required|min:1|max:240'
        ]);

        $idea = Idea::create($validated);
        return redirect()->route('dashboard')->with('success', 'content created successfully!');
    }

    public function edit(Idea $idea)
    {
        $editing = true;
        return view('ideas.show',compact('idea', 'editing'));  // compact('idea') = ['idea'=>$idea]
    }

    public function update(Idea $idea)
    {
        $validated = request()->validate([
            'content' => 'required|min:1|max:240'
        ]);
        $idea->update($validated);
        
        return redirect()->route('ideas.show', $idea->id)->with('success', 'content updated successfully');
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'content deleted successfully!');
    }
}