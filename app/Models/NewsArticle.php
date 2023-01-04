<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;

class NewsArticle extends Model //implements HasMedia
{
    use HasFactory, Sluggable; //, InteractsWithMedia;

    protected $table = 'news_article';
    
    //eager loading data, sebelumnya ada di controller
    // protected $with = ['category'];

    protected $fillable = [
        'categoryID',
        'title_en',
        'title_id',
        'slug',
        'content_en',
        'content_id',
        'publish_date',
        'image'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_id'
            ]
        ];
    }

    //to search news data - en
    public function scopeFilterEN($query, array $filters) {
        //using issets method
        // if(isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('title_en', 'like', '%'.$filters['search'].'%')
        //     ->orWhere('content_en', 'like', '%'.$filters['search'].'%');
        // }

        //query scope collection when() method
        //?? is null coalescing operator - php7 features
        $query->when($filters['search'] ?? false, function($query, $search){
            // return $query->where('title_en', 'like', '%'.$search.'%')
            // ->orWhere('content_en', 'like', '%'.$search.'%');

            return $query->where(function($query) use ($search) {
                $query->where('title_en', 'like', '%' . $search . '%')
                ->orWhere('content_en', 'like', '%' . $search . '%');
                
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use($category) {
                $query->where('slug', $category);
            });
        });
    }

    //to search news data - id
    public function scopeFilterID($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search){
            // return $query->where('title_id', 'like', '%'.$search.'%')
            // ->orWhere('content_id', 'like', '%'.$search.'%');

            return $query->where(function($query) use ($search) {
                $query->where('title_id', 'like', '%' . $search . '%')
                ->orWhere('content_id', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use($category) {
                $query->where('slug', $category);
            });
        });
    }

    public function category() {
        return $this->belongsTo(NewsCategory::class, 'categoryID', 'id');
    }

    public function __construct(array $attributes = []) {}

}
