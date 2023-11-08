<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\HasTags;

class Post extends Model // implements TranslatableContract
{
    use HasFactory;
    use HasTags;
    // use Translatable;

    /**
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'banner',
        'content',
        'published_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'date',
    ];

    /**
     * @var array<string>
     */
    protected $appends = [
        'banner_url',
    ];

    /**
     * @var array<string>
     */
    public $translatedAttributes = ['title', 'excerpt', 'content'];

    // public function getTranslations(): array
    // {
    //     //return $this->{$field};
    //     $res = $this->getTranslationsArray();

    //     return $res;
    //     //return ['it'=>'titleit','en'=>'titleen'];
    // }

    /*errore di contratto --
    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true): mixed{
        return 'ciao';
    }
    */

    public function getTranslatableAttributes()
    {
        return $this->translatedAttributes;
    }
    /*


    public function setTranslation($field, $locale, $value)
    {
        //dddx([$a,$b,$c]);
        $this->translateOrNew($locale)->{$field}=$value;
        //$this->{$field}=$value;
    }
    */

    public function setLocale($locale)
    {
        app()->setLocale($locale);
        $res = $this->translateOrNew($locale);
        $res->post_id = $this->getKey();
        $res->save();
        return $this;
        //return $this->translate($locale);
    }


    public function bannerUrl(): Attribute
    {
        return Attribute::get(fn() => asset(Storage::url($this->banner)));
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->whereNull('published_at');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'blog_author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'blog_category_id');
    }
}
