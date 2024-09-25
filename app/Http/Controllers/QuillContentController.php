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
            'content' => 'required|string',
        ]);

        $userId = Auth::id();

        // Use updateOrCreate to save or update user's content
        $content = QuillContent::updateOrCreate(
            ['user_id' => $userId],
            ['content' => $validatedData['content']]
        );

        if (!$content) {
            return back()->with('error', 'An error occurred. Please contact the admin.');
        }

        return back()->with('message', 'Content saved successfully.');
    }

    public function getContent()
    {
        $userId = Auth::id();
        $content = QuillContent::query()
            ->where('user_id', $userId)
            ->first();

        return response()->json([
            'content' => $content ? $content->content : '<p>Start editing here!</p>',
        ]);
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
