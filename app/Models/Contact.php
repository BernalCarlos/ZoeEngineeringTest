<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'gender',
        'zip_code',
        'profession_id',
        'email',
    ];

    public function profession()
    {
        return $this->hasOne(ContactProfession::class, 'id', 'profession_id');
    }
}
