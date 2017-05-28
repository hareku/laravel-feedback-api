<?php

namespace Hareku\LaravelFeedbackAPI;

use Illuminate\Database\Eloquent\Model;

class FeedbackEntity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body'];
}
