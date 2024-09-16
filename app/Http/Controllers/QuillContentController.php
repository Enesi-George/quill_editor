<?php

namespace App\Http\Controllers;

use App\Models\QuillContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuillContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content'=> 'required|string'
        ]);
        $userId = Auth::id();
        $content = QuillContent::updateOrCreate(
            ['user_id' => $userId],
            ['content' => $validatedData['content']]
        );
        if(!$content){
            return back()->with('error', 'An error has occur. Please contact the administrative.');
        };
        return back()->with('message', 'Content saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuillContent $quillContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuillContent $quillContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuillContent $quillContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuillContent $quillContent)
    {
        //
    }
}
