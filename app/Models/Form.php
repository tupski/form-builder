<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'success_message',
        'is_active',
        'slug',
        'custom_url',
        'short_url',
        'is_embeddable',
        'settings',
        'embed_settings'
    ];

    protected $casts = [
        'settings' => 'array',
        'embed_settings' => 'array',
        'is_active' => 'boolean',
        'is_embeddable' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($form) {
            if (empty($form->slug)) {
                $form->slug = Str::slug($form->title) . '-' . Str::random(6);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class)->orderBy('order');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function conditionalRules(): HasMany
    {
        return $this->hasMany(ConditionalRule::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function generateShortUrl()
    {
        do {
            $shortUrl = Str::random(5);
        } while (static::where('short_url', $shortUrl)->exists());

        $this->update(['short_url' => $shortUrl]);
        return $shortUrl;
    }

    public function getPublicUrl()
    {
        if ($this->custom_url) {
            return url('/f/' . $this->custom_url);
        }

        if ($this->short_url) {
            return url('/f/' . $this->short_url);
        }

        return route('form.show', $this->slug);
    }

    public function getEmbedCode($width = '100%', $height = '600px')
    {
        $url = $this->getPublicUrl();
        return '<iframe src="' . $url . '" width="' . $width . '" height="' . $height . '" frameborder="0" style="border: none;"></iframe>';
    }

    public function getShareableUrl()
    {
        return $this->short_url ? url('/f/' . $this->short_url) : $this->getPublicUrl();
    }
}
