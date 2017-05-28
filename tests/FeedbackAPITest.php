<?php

namespace Hareku\LaravelFeedbackAPI\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Hareku\LaravelFeedbackAPI\Mail\StoredFeedbackMailToDeveloper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class FeedbackAPITest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_stores_feedback()
    {
        Mail::fake();
        $body = 'This is a feedback body.';

        $this->postJson('/feedbacks', compact('body'))
            ->assertStatus(201)
            ->assertJsonStructure(['feedback'])
            ->assertJsonFragment(compact('body'));

        $this->assertDatabaseHas(config('feedback.table'), compact('body'));

        Mail::assertNotSent(StoredFeedbackMailToDeveloper::class);
    }

    /**
     * @test
     */
    public function it_sends_mail_to_developer()
    {
        Config::set('feedback.mail_to_developer', true);

        Mail::fake();
        $body = 'This is a feedback body.';

        $this->postJson('/feedbacks', compact('body'))
            ->assertStatus(201);

        Mail::assertSent(StoredFeedbackMailToDeveloper::class);
    }

    /**
     * @test
     */
    public function it_posting_body_less_than_five_characters()
    {
        $body = str_random(3);

        $this->postJson(config('feedback.table'), compact('body'))
            ->assertStatus(422)
            ->assertJsonStructure(['body']);

        $this->assertDatabaseMissing('feedbacks', compact('body'));
    }
}
