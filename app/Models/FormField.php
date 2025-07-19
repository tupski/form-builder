<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'type',
        'label',
        'name',
        'placeholder',
        'help_text',
        'required',
        'order',
        'validation_rules',
        'options',
        'settings'
    ];

    protected $casts = [
        'required' => 'boolean',
        'validation_rules' => 'array',
        'options' => 'array',
        'settings' => 'array',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function conditionalRulesAsTarget(): HasMany
    {
        return $this->hasMany(ConditionalRule::class, 'target_field_id');
    }

    public function conditionalRulesAsCondition(): HasMany
    {
        return $this->hasMany(ConditionalRule::class, 'condition_field_id');
    }

    public function getFieldTypesAttribute()
    {
        return [
            'text' => 'Text Input',
            'email' => 'Email',
            'number' => 'Number',
            'textarea' => 'Textarea',
            'select' => 'Select Dropdown',
            'radio' => 'Radio Buttons',
            'checkbox' => 'Checkboxes',
            'date' => 'Date',
            'file' => 'File Upload',
        ];
    }
}
