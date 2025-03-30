<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
//    /** @use HasFactory<\Database\Factories\FacultyFactory> */
    use HasFactory;


    protected $fillable = ['name','description','status'];

    public function getFormattedStatusAttribute(): string
    {
        return $this->status == 'active' ? '✅ Active' : '❌ Inactive';
    }
    public function getFormattedCreatedAtAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('M d, Y');
    }
}
