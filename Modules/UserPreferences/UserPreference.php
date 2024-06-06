<?php

namespace Modules\UserPreferences;

use Cache;
use App\User;
use Wildside\Userstamps\Userstamps;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class UserPreference extends Model
{
    use SoftDeletes, SoftCascadeTrait, UsesTenantConnection, LogsActivity, Userstamps, HasCompositePrimaryKey;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';


    protected $table = 'user_preferences';
    protected $primaryKey = ['user_id', 'preference_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'preference_id', 'value', 'created_at', 'updated_at'
    ];

    protected $appends = ['slug'];

    // protected $softCascade = ['translations'];
    protected $softCascade = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'user_preferences_log';

    /**
     * Get the class being used to provide a User.
     *
     * @return string
     */
    protected function getUserClass()
    {
        return "App\User";
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Preference {$this->preference_id} has been {$eventName} For User ID #{$this->user_id}";
    }

    /**
     * return User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * return Preference
     */
    public function preference()
    {
        return $this->belongsTo('Modules\UserPreferences\Preference', 'preference_id');
    }

    public function getSlugAttribute()
    {
        $user_preference = $this;
        
        return Cache::rememberForever('user_preference_slug_of_id_'.$user_preference->preference_id, function() use ($user_preference) {
            $user_preference_preference = $user_preference->preference;
            return $user_preference_preference ? $user_preference_preference->slug : null;
        });
    }
}
