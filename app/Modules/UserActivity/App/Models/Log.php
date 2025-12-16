<?php

namespace Modules\UserActivity\App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false;

    protected $dates = ['log_date'];

    protected $casts = ['data' => 'array'];

    protected $appends = ['dateHumanize', 'json_data'];

    private $userInstance = "\App\User";

    public function __construct()
    {
        parent::__construct();
        $userInstance = config('user-activity.model.user');
        if (! empty($userInstance)) {
            $this->userInstance = $userInstance;
        }
    }

    public function getDateHumanizeAttribute()
    {
        return $this->log_date->diffForHumans();
    }

    public function getJsonDataAttribute()
    {
        return $this->data;
    }

    public function user()
    {
        return $this->belongsTo($this->userInstance);
    }
}
