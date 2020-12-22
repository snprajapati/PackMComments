<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','user','content'];
        
    /**
     * children
     *
     * @return void
     */
    public function children() 
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('children');
    }
}
