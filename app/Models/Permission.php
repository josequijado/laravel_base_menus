<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Permission extends Model
{
    use SoftDeletes;

    protected $table = 'permissions';

    protected $fillable = [
        'scope',
        'icono',
        'rotulo',
        'ruta',
        'parent_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function _construct()
    {
        //
    }

    public function parent()
    {
        return $this->belongsTo(Permission::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

    /**
     * The users that a permission belongs to.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
