<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'package_category_id',
        'name',
        'slug',
        'price',
        'duration',
        'routes',
        'full_description',
        'created_by',
        'updated_by',
    ];

    /**
     * Mendapatkan kategori dari paket ini.
     */
    public function category()
    {
        return $this->belongsTo(PackageCategory::class, 'package_category_id');
    }

    /**
     * Mendapatkan semua foto galeri untuk paket ini.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
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
