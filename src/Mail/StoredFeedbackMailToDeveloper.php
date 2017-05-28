<?php

namespace Hareku\LaravelFeedbackAPI\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Hareku\LaravelFeedbackAPI\FeedbackEntity;

class StoredFeedbackMailToDeveloper extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * FeedbackEntity instance.
     *
     * @var FeedbackEntity
     */
    public $feedback;

    /**
     * Create a new message instance.
     *
     * @param  FeedbackEntity  $feedback
     * @return void
     */
    public function __construct(FeedbackEntity $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('feedback::to-dev')
                    ->to(config('feedback.developer.address'), config('feedback.developer.name'))
                    ->subject("【{$this->feedback->id}】".config('feedback.mail_subject'));
    }
}
