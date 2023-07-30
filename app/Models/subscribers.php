<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscribers extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'name_of_company',
        'company_number',
        'manager_name',
        'other_details',
        'status',
    ] ;
}
