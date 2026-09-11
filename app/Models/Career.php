<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Career extends Model
{
    protected $fillable = [
        'title', 'slug', 'type', 'location', 'description',
        'requirements', 'application_deadline', 'is_active',
    ];

    protected $casts = [
        'requirements' => 'array',
        'application_deadline' => 'date',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getEmploymentTypeAttribute(): ?string
    {
        return $this->type;
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(fn (Builder $q) => $q
                ->whereNull('application_deadline')
                ->orWhere('application_deadline', '>=', now()->toDateString()));
    }

    protected static function booted(): void
    {
        static::creating(function (self $career) {
            if (empty($career->slug)) {
                $career->slug = Str::slug($career->title);
            }
        });
    }
}