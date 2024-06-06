<?php

namespace Modules\UserPreferences;

use App;
use Cache;
use App\Language;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Preference extends Model
{
    use SoftDeletes, SoftCascadeTrait, UsesTenantConnection, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    /**
     * Get the class being used to provide a User.
     *
     * @return string
     */
    protected function getUserClass()
    {
        return "App\User";
    }

    protected $table = 'preferences';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'default', 'parent_id', 'slug', 'is_checkbox', 'is_hidden', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'name', 'description'
    ];

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
    protected static $logName = 'preference_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Preference " . $this->name . " has been {$eventName}";
    }

    public function getNameAttribute()
    {
        $preference = $this;
        return Cache::rememberForever('preference_' . $this->id . '_name_' . App::getLocale(), function () use ($preference) {
            $preference = $preference->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $preference ? $preference->name : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $preference = $this;
        return Cache::rememberForever('preference_' . $this->id . '_description_' . App::getLocale(), function () use ($preference) {
            $preference = $preference->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $preference ? $preference->description : null;
        });
    }

    public function getOptionsAttribute()
    {
        $preference = $this;
        return Cache::rememberForever('preference_' . $this->id . '_options_' . App::getLocale(), function () use ($preference) {
            $preference = $preference->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $preference ? $preference->options : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\UserPreferences\PreferenceTranslation', 'preference_id', 'id');
    }

    public function user_preferences()
    {
        return $this->hasMany('Modules\UserPreferences\UserPreference', 'preference_id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Preference $preference) {
            Event::dispatch('preference.created', $preference);
        });
        static::updated(function (Preference $preference) {
            Event::dispatch('preference.updated', $preference);
        });
        static::saved(function (Preference $preference) {
            Event::dispatch('preference.saved', $preference);
        });
        static::deleted(function (Preference $preference) {
            Event::dispatch('preference.deleted', $preference);
        });
        static::restored(function (Preference $preference) {
            Event::dispatch('preference.restored', $preference);
        });
    }
}
