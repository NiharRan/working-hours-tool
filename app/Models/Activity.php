<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'project_id',
        'start_at',
        'end_at',
        'total_hours',
        'status',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'activity_status',
        'start_date_time',
        'end_date_time'
    ];


    protected function getActivityStatusAttribute()
    {
        $className = $this->status == 1 ? 'text-green-500 bg-green-100' : 'text-red-500 bg-red-100';
        $text = $this->status == 1 ? __('Running') : __('Stopped');

        return '<span class="font-bold px-2 py-1 ' . $className .'">' . $text . '</span>';
    }

    protected function getStartDateTimeAttribute()
    {
        return date(config()->get('custom.date.full'), strtotime($this->start_at));
    }
    protected function getEndDateTimeAttribute()
    {
        if (!isset($this->end_at)) {
            return  '';
        }
        return date(config()->get('custom.date.full'), strtotime($this->end_at));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }



}
