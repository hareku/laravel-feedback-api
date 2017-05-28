<?php

Route::group(['namespace' => 'Hareku\LaravelFeedbackAPI\Controllers'], function () {
    Route::post(config('feedback.uri', '/feedbacks'), [
        'as'   => 'feedbacks.store',
        'uses' => 'FeedbackController@storeFeedback'
    ]);
});
