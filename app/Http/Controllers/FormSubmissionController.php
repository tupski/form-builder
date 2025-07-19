<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormSubmissionController extends Controller
{
    /**
     * Show the form to public users
     */
    public function show(Form $form)
    {
        if (!$form->is_active) {
            abort(404, 'Form not found or inactive');
        }

        $form->load(['fields' => function($query) {
            $query->orderBy('order');
        }, 'conditionalRules.targetField', 'conditionalRules.conditionField']);

        return view('forms.public', compact('form'));
    }

    /**
     * Store form submission
     */
    public function store(Request $request, Form $form)
    {
        if (!$form->is_active) {
            abort(404, 'Form not found or inactive');
        }

        // Build validation rules from form fields
        $rules = [];
        $form->load('fields');

        foreach ($form->fields as $field) {
            $fieldRules = [];

            if ($field->required) {
                $fieldRules[] = 'required';
            }

            // Add type-specific validation
            switch ($field->type) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
            }

            if (!empty($fieldRules)) {
                $rules[$field->name] = implode('|', $fieldRules);
            }
        }

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Store the submission
        $submission = FormSubmission::create([
            'form_id' => $form->id,
            'data' => $request->except(['_token']),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return view('forms.success', compact('form'));
    }

    /**
     * Admin view of all submissions
     */
    public function adminIndex()
    {
        $submissions = FormSubmission::with('form')->latest()->paginate(20);
        return view('admin.submissions.index', compact('submissions'));
    }
}
