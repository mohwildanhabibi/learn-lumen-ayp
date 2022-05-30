<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'worker';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email',
    ];

    public function employments()
    {
        return $this->hasMany(Employment::class, 'workerEmail', 'email');
    }
}
