<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormSubmission extends Model
{
    protected $fillable = [
        'form_id',
        'data',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function getFieldValue($fieldName)
    {
        return $this->data[$fieldName] ?? null;
    }

    public function setFieldValue($fieldName, $value)
    {
        $data = $this->data ?? [];
        $data[$fieldName] = $value;
        $this->data = $data;
    }
}
