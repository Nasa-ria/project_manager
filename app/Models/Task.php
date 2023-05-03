<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'project_id',
        'title',
        'note',
        'priority',
       
    ];

 /**
 * Get the post that owns the comment.
 */
public function project(): BelongsTo
{
    return $this->belongsTo(Project::class);
}

}
