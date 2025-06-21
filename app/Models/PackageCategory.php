<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'created_by',
        'updated_by',
    ];

    /**
     * Mendapatkan semua paket yang termasuk dalam kategori ini.
     */
    public function packages()
    {
        return $this->hasMany(Package::class);
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
