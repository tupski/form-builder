<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = auth()->user()->forms()->latest()->paginate(10);
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'success_message' => 'nullable|string',
        ]);

        $form = auth()->user()->forms()->create([
            'title' => $request->title,
            'description' => $request->description,
            'success_message' => $request->success_message ?? 'Thank you for your submission!',
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
        ]);

        return redirect()->route('forms.builder', $form)->with('success', 'Form created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        $this->authorize('view', $form);
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        $this->authorize('update', $form);
        return view('forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        $this->authorize('update', $form);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'success_message' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $form->update($request->only(['title', 'description', 'success_message', 'is_active']));

        return redirect()->route('forms.index')->with('success', 'Form updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $this->authorize('delete', $form);
        $form->delete();

        return redirect()->route('forms.index')->with('success', 'Form deleted successfully!');
    }

    /**
     * Admin view of all forms
     */
    public function adminIndex()
    {
        $forms = Form::with('user')->latest()->paginate(15);
        return view('admin.forms.index', compact('forms'));
    }
}
