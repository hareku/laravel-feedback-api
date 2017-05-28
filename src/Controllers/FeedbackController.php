<?php

namespace Hareku\LaravelFeedbackAPI\Controllers;

use Hareku\LaravelFeedbackAPI\FeedbackEntity;
use Hareku\LaravelFeedbackAPI\Mail\StoredFeedbackMailToDeveloper;
use Hareku\LaravelFeedbackAPI\Requests\StoreFeedback;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\JsonResponse;

class FeedbackController extends Controller
{
    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * Create a new controller instance.
     *
     * @param  Mailer  $mailer
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->middleware(config('feedback.middleware', 'api'));

        $this->mailer = $mailer;
    }

    /**
     * Store a feedback.
     *
     * @param  StoreFeedback  $request
     * @return JsonResponse
     */
    public function storeFeedback(StoreFeedback $request): JsonResponse
    {
        $feedback = FeedbackEntity::create([
            'body' => $request->input('body'),
        ]);

        if (config('feedback.mail_to_developer', false)) {
            $this->mailer->send(new StoredFeedbackMailToDeveloper($feedback));
        }

        return response()->json(compact('feedback'), 201);
    }
}
