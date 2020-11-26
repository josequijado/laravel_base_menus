<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permission;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use Notifiable;

    protected $table = 'users';

    public function _construct()
    {
        //
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scope',
        'first_name',
        'surname',
        'username',
        'email',
        'password',
        'theme',
        'language',
        'country_code',
        'phone_number',
        'menu_desplegado',
        'opcion_seleccionada',
        'menu_bar_deployed',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The permissions that belong to the user.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Para el envío de correo de confirmación de registro
     */
    public function sendEmailVerificationNotification()
    {
        if (env('USER_MUST_BE_VERIFIED') === true) {
            $this->notify(new VerifyEmail);
        }
    }

    /**
     * Para el envío de correo de restablecimiento de contraseña
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyCustomResetPassword($token));
    }
}
