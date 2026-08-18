<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamScore extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'exam_scores';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'exam_batch_id',
        'exam_session_id',
        'score',
        'total_questions',
        'answers',
        'time_taken',
        'submitted_at',
        'status',
        'admin_notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'answers' => 'array',
        'submitted_at' => 'datetime',
        'time_taken' => 'integer',
        'score' => 'integer',
        'total_questions' => 'integer',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'answers', // Hide actual answers from API responses if needed
    ];

    /**
     * Get the user that owns the exam score.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the exam progress associated with this score.
     */
    public function progress(): BelongsTo
    {
        return $this->belongsTo(ExamProgress::class, 'exam_session_id', 'exam_session_id');
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(ExamBatch::class, 'exam_batch_id');
    }

    /**
     * Scope a query to only include approved scores.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only include pending scores.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include rejected scores.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Get the percentage score.
     */
    public function getPercentageAttribute(): float
    {
        if ($this->total_questions == 0) {
            return 0;
        }
        return round(($this->score / $this->total_questions) * 100, 2);
    }

    /**
     * Check if the exam was passed (you can adjust the passing score).
     */
    public function isPassed(int $passingScore = 60): bool
    {
        return $this->percentage >= $passingScore;
    }

    /**
     * Get formatted time taken.
     */
    public function getFormattedTimeTakenAttribute(): string
    {
        if (!$this->time_taken) {
            return 'N/A';
        }

        $minutes = floor($this->time_taken / 60);
        $seconds = $this->time_taken % 60;

        return sprintf('%d:%02d', $minutes, $seconds);
    }

    /**
     * Get the grade based on score percentage.
     */
    public function getGradeAttribute(): string
    {
        $percentage = $this->percentage;

        if ($percentage >= 90) return 'A';
        if ($percentage >= 80) return 'B';
        if ($percentage >= 70) return 'C';
        if ($percentage >= 60) return 'D';
        return 'F';
    }
}
