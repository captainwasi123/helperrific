<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siteMainten extends Model
{
    use HasFactory;
    protected $table = 'tbl_site_maintenance';
    public $timestamps = false;
}
