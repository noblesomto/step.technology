<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConferenceRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'phone',
        'email',
        'organization',
        'country',
        'category',
        'message',
        'registration_id',
        'status',
        'payment',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot function to generate registration ID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->registration_id = $model->generateRegistrationId();
        });
    }

    /**
     * Generate a unique registration ID
     *
     * @return string
     */
    protected function generateRegistrationId()
    {
        $prefix = 'ICTS2025';
        $timestamp = now()->format('ymd');
        $random = strtoupper(substr(uniqid(), -6));

        return "{$prefix}-{$timestamp}-{$random}";
    }

    /**
     * Get the full name of the registrant
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->title} {$this->first_name} {$this->last_name}";
    }

    /**
     * Scope a query to only include pending registrations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include confirmed registrations.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to filter by country.
     */
    public function scopeCountry($query, $country)
    {
        return $query->where('country', $country);
    }
}
