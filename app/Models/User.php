<?php

namespace App\Models;

 use App\Notifications\EmailVerifyNotification;
 use App\Notifications\ResetPasswordNotification;
 use Illuminate\Auth\Passwords\CanResetPassword;
 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable ,CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
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
    ];

    public function sendEmailVerification() {
        $this->notify(new EmailVerifyNotification());
    }

    public function sendPasswordResetNotification($token) {

        $url = url('/').'/reset-password/'.$token;

        $this->notify(new ResetPasswordNotification($url));
    }

    public function posts() {
        return $this->hasMany(Post::class,'user_id','id');
    }
}
