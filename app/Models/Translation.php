<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'key',
        'value'
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public static function get($key, $languageCode = null, $default = null)
    {
        $languageCode = $languageCode ?? app()->getLocale();

        $translation = static::whereHas('language', function($query) use ($languageCode) {
            $query->where('code', $languageCode);
        })->where('key', $key)->first();

        return $translation ? $translation->value : ($default ?? $key);
    }

    public static function set($key, $value, $languageCode)
    {
        $language = Language::where('code', $languageCode)->first();

        if (!$language) {
            return false;
        }

        return static::updateOrCreate(
            ['language_id' => $language->id, 'key' => $key],
            ['value' => $value]
        );
    }
}
