<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Mail\enviaPasswordResetNotificacao;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function efetivo(): hasOne
    {
        return $this->hasOne(Efetivo::class);
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token): void
    {
        //dd($token, $this->email, $this->name);
        $url = env('APP_URL').'/password-reset/'.$token.'?email='.$this->email;
         $data = [
             'token' => $token,
             'email' => $this->email,
             'name' => $this->name,
             'url' => $url,
         ];



        Mail::to($this->email, $this->name)->send(new enviaPasswordResetNotificacao(['data' => $data]));
        //$this->notify(new enviaPasswordResetNotificacao((array)$url));
    }
}
