<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class FormBuilderController extends Controller
{
    use AuthorizesRequests;

    public function show(Form $form)
    {
        $this->authorize('update', $form);

        $form->load(['fields' => function($query) {
            $query->orderBy('order');
        }, 'conditionalRules.targetField', 'conditionalRules.conditionField']);

        return view('forms.builder', compact('form'));
    }

    public function saveFields(Request $request, Form $form)
    {
        $this->authorize('update', $form);

        $request->validate([
            'fields' => 'required|array',
            'fields.*.type' => 'required|string',
            'fields.*.label' => 'required|string',
            'fields.*.name' => 'required|string',
            'fields.*.required' => 'boolean',
            'fields.*.order' => 'required|integer',
        ]);

        // Delete existing fields
        $form->fields()->delete();

        // Create new fields
        foreach ($request->fields as $fieldData) {
            $form->fields()->create([
                'type' => $fieldData['type'],
                'label' => $fieldData['label'],
                'name' => $fieldData['name'],
                'placeholder' => $fieldData['placeholder'] ?? null,
                'help_text' => $fieldData['help_text'] ?? null,
                'required' => $fieldData['required'] ?? false,
                'order' => $fieldData['order'],
                'validation_rules' => $fieldData['validation_rules'] ?? null,
                'options' => $fieldData['options'] ?? null,
                'settings' => $fieldData['settings'] ?? null,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Form fields saved successfully!']);
    }

    public function saveConditionalRules(Request $request, Form $form)
    {
        $this->authorize('update', $form);

        $request->validate([
            'rules' => 'required|array',
            'rules.*.target_field_id' => 'required|exists:form_fields,id',
            'rules.*.condition_field_id' => 'required|exists:form_fields,id',
            'rules.*.operator' => 'required|in:equals,not_equals,contains,not_contains,greater_than,less_than',
            'rules.*.condition_value' => 'required|string',
            'rules.*.action' => 'required|in:show,hide',
        ]);

        // Delete existing rules
        $form->conditionalRules()->delete();

        // Create new rules
        foreach ($request->rules as $ruleData) {
            $form->conditionalRules()->create($ruleData);
        }

        return response()->json(['success' => true, 'message' => 'Conditional rules saved successfully!']);
    }
}
