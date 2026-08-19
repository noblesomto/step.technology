<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ExamProgress extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'exam_progress';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'exam_batch_id',
        'exam_session_id',
        'question_ids',
        'start_time',
        'current_question',
        'time_remaining',
        'answers',
        'is_complete',
        'last_saved_at',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'answers' => 'array',
        'question_ids' => 'array',
        'start_time' => 'datetime',
        'last_saved_at' => 'datetime',
        'completed_at' => 'datetime',
        'is_complete' => 'boolean',
        'current_question' => 'integer',
        'time_remaining' => 'integer',
    ];

    /**
     * Get the user that owns the exam progress.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the exam score associated with this progress.
     */
    public function score(): HasOne
    {
        return $this->hasOne(ExamScore::class, 'exam_session_id', 'exam_session_id');
    }

    /**
     * Scope a query to only include incomplete exams.
     */
    public function scopeIncomplete($query)
    {
        return $query->where('is_complete', false);
    }

    /**
     * Scope a query to only include complete exams.
     */
    public function scopeComplete($query)
    {
        return $query->where('is_complete', true);
    }

    /**
     * Scope a query to only include expired exams (time ran out).
     */
    public function scopeExpired($query, int $durationMinutes = 35)
    {
        return $query->where('start_time', '<=', now()->subMinutes($durationMinutes))
                    ->where('is_complete', false);
    }

    /**
     * Check if the exam time has expired.
     */
    public function isExpired(int $durationMinutes = 35): bool
    {
        return $this->start_time->addMinutes($durationMinutes)->isPast();
    }

    /**
     * Get the number of answered questions.
     */
    public function getAnsweredCountAttribute(): int
    {
        $answers = is_array($this->answers) ? $this->answers : [];
        return count(array_filter($answers, fn($answer) => $answer !== null));
    }

    /**
     * Get progress percentage.
     */
    public function getProgressPercentageAttribute(): float
    {
        return round(($this->current_question / 40) * 100, 2);
    }

    /**
     * Get formatted time remaining.
     */
    public function getFormattedTimeRemainingAttribute(): string
    {
        $minutes = floor($this->time_remaining / 60);
        $seconds = $this->time_remaining % 60;

        return sprintf('%d:%02d', $minutes, $seconds);
    }

    /**
     * Mark the exam as complete.
     */
    public function markComplete(): bool
    {
        return $this->update([
            'is_complete' => true,
            'completed_at' => now(),
        ]);
    }

    /**
     * Update the last saved timestamp.
     */
    public function touchLastSaved(): bool
    {
        return $this->update(['last_saved_at' => now()]);
    }
}
