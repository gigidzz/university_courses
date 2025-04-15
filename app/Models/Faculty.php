<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method findOrFail(int $id)
 */

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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public function getUpdatedAt(): Carbon {
        return ($this->updated_at);
    }

    public function getCreatedAt(): Carbon {
        return ($this->created_at);
    }
}
