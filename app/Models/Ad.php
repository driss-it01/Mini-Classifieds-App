<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'category_id',
    'title',
    'slug',
    'description',
    'price',
    'location',
    'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

        public function category(){
        return $this->belongsTo(Category::class);
    }

        public function images(){
        return $this->hasMany(AdImage::class);
    }

        public function favoritedBy(){
        return $this->BelongsToMany(User::class, 'favorites');
    }
    
    
    // Scopes
    public function scopePublished($q){ return $q->where('status','published'); }
    public function scopeFilter($q, array $filters){
        $q->when($filters['q'] ?? null, fn($qq,$v)=>$qq->where(fn($w)=>$w->where('title','like',"%$v%")
        ->orWhere('description','like',"%$v%")));
        $q->when($filters['category'] ?? null, fn($qq,$v)=>$qq->whereHas('category', fn($w)=>$w->where('slug',$v)));
        $q->when($filters['min'] ?? null, fn($qq,$v)=>$qq->where('price','>=',(int)$v));
        $q->when($filters['max'] ?? null, fn($qq,$v)=>$qq->where('price','<=',(int)$v));
        return $q;
    }
    public function getRouteKeyName() : string { return 'slug';}

}
