<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'first_name',
        'last_name',
        'gender',
        'address',
        'city',
        'state',
        'phone',
        'acc_status',
        'profile_picture',
        'user_type',
        'company_name',
        'school_name',
        'school_faculty',
        'school_dept',
        'member_status',
        'step_id',
        'reg_no',
        'email',
        'password',
        'profession',
        'referee_name',
        'referee_phone',
        'referee_email',
        'referee_address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const REG_NO_PREFIX = 'STEP/CORETEP/';

    /**
     * Next incremental REG/LICENSE NO, e.g. STEP/CORETEP/0001.
     * Reads the highest existing sequence number rather than counting rows,
     * so it stays correct even if a registration is later deleted.
     */
    public static function nextRegNo(): string
    {
        $lastSeq = static::query()
            ->where('reg_no', 'like', self::REG_NO_PREFIX.'%')
            ->selectRaw('MAX(CAST(SUBSTRING_INDEX(reg_no, "/", -1) AS UNSIGNED)) as last_seq')
            ->value('last_seq');

        return self::REG_NO_PREFIX.sprintf('%04d', ($lastSeq ?? 0) + 1);
    }
}
