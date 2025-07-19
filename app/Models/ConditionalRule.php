<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConditionalRule extends Model
{
    protected $fillable = [
        'form_id',
        'target_field_id',
        'condition_field_id',
        'operator',
        'condition_value',
        'action'
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function targetField(): BelongsTo
    {
        return $this->belongsTo(FormField::class, 'target_field_id');
    }

    public function conditionField(): BelongsTo
    {
        return $this->belongsTo(FormField::class, 'condition_field_id');
    }

    public function evaluateCondition($fieldValue): bool
    {
        switch ($this->operator) {
            case 'equals':
                return $fieldValue == $this->condition_value;
            case 'not_equals':
                return $fieldValue != $this->condition_value;
            case 'contains':
                return str_contains(strtolower($fieldValue), strtolower($this->condition_value));
            case 'not_contains':
                return !str_contains(strtolower($fieldValue), strtolower($this->condition_value));
            case 'greater_than':
                return is_numeric($fieldValue) && $fieldValue > $this->condition_value;
            case 'less_than':
                return is_numeric($fieldValue) && $fieldValue < $this->condition_value;
            default:
                return false;
        }
    }
}
