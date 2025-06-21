<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image_path',
        'caption',
        'package_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Mendapatkan paket yang memiliki foto ini (jika ada).
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Mendapatkan user yang membuat data ini.
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Mendapatkan user yang terakhir mengubah data ini.
     */
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
