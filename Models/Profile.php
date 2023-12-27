<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * Modules\Blog\Models\Profile.
 *
 * @property int         $id
 * @property string|null $post_type
 * @property string|null $bio
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property string|null $first_name
 * @property string|null $surname
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property int|null    $user_id
 * @property string|null $last_name
 *
 * @method static \Modules\Blog\Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static Builder|Profile                                 newModelQuery()
 * @method static Builder|Profile                                 newQuery()
 * @method static Builder|Profile                                 query()
 * @method static Builder|Profile                                 whereAddress($value)
 * @method static Builder|Profile                                 whereBio($value)
 * @method static Builder|Profile                                 whereCreatedAt($value)
 * @method static Builder|Profile                                 whereCreatedBy($value)
 * @method static Builder|Profile                                 whereDeletedBy($value)
 * @method static Builder|Profile                                 whereEmail($value)
 * @method static Builder|Profile                                 whereFirstName($value)
 * @method static Builder|Profile                                 whereId($value)
 * @method static Builder|Profile                                 whereLastName($value)
 * @method static Builder|Profile                                 wherePhone($value)
 * @method static Builder|Profile                                 wherePostType($value)
 * @method static Builder|Profile                                 whereSurname($value)
 * @method static Builder|Profile                                 whereUpdatedAt($value)
 * @method static Builder|Profile                                 whereUpdatedBy($value)
 * @method static Builder|Profile                                 whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Profile extends BaseModel
{
    protected $fillable = [
        'id',
        'user_id',
    ];

    /**
     * Get the articles of the user
     *
     * @return \App\Role
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get the path to the profile picture
     *
     * @return string
     */
    public function profilePicture()
    {
        if ($this->picture) {
            return "/storage/{$this->picture}";
        }

        return 'http://i.pravatar.cc/200';
    }

    /**
     * Get the route key for the user.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Check if the user has admin role
     *
     * @return bool
     */
    public function isAdmin()
    {
        return 1 === $this->role_id;
    }

    /**
     * Check if the user has creator role
     *
     * @return bool
     */
    public function isAuthor()
    {
        return 2 === $this->role_id;
    }

    /**
     * Check if the user has user role
     *
     * @return bool
     */
    public function isMember()
    {
        return 3 === $this->role_id;
    }

    /**
     * Scope a query to only include users that are authors
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeProfileIsAuthor($query)
    {
        return $query; // ->where('role_id', '=', 2);
    }
}