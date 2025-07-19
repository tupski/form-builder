<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'native_name',
        'is_active',
        'is_default'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class);
    }

    public static function getDefault()
    {
        return static::where('is_default', true)->first() ?? static::where('code', 'en')->first();
    }

    public static function getActive()
    {
        return static::where('is_active', true)->get();
    }
}
