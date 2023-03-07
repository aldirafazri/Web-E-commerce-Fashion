<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_variants extends Model
{
    use HasFactory;
    protected $id;
    protected $id_admin;
    protected $id_variant;
    protected $stok_lama;
    protected $stok_baru;
}
