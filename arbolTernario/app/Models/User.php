<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'patrocinador_id',
		'level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url'
    ];

	protected $with = [
		'patrocinador'
	];

	// protected function setPasswordAttribute($value)
	// {
	// 	$this->attributes['password'] = bcrypt($value);
	// }

	public function setLevelAttribute($value)
    {
        // El valor de 'level' se establecerá automáticamente utilizando la lógica proporcionada.
        $level = 0;
        $patrocinador = $this->patrocinador;

        while ($patrocinador) {
            $level++;
            $patrocinador = $patrocinador->patrocinador;
        }

        $this->attributes['level'] = $level;
    }

	public function patrocinador()
    {
        return $this->belongsTo(User::class, 'patrocinador_id');
    }

    public function referidos()
    {
        return $this->hasMany(User::class, 'patrocinador_id');
    }

}
