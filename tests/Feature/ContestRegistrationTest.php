<?php

namespace Tests\Feature;

use App\Events\NewEntryRecievedEvent;
use App\Mail\WelcomeContestMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContestRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void {

        parent::setUp();

        Mail::fake();

    }

    /** @test */
    public function email_can_be_entered() {

        // $this->withoutExceptionHandling();
        $this->post('/contest', [
            'email' => 'abc@abc.com'
        ]);

        $this->assertDatabaseCount('contest_entries', 1);
    }

    /** @test */
    public function email_is_required() {


        $this->post('/contest', [
            'email' => ''
        ]);

        $this->assertDatabaseCount('contest_entries', 0);
    }

    /** @test */
    public function email_has_to_be_email() {


        $this->post('/contest', [
            'email' => 'hdjfszl'
        ]);

        $this->assertDatabaseCount('contest_entries', 0);
    }

    /** @test */
    public function an_event_is_fired_when_user_registered() {

        Event::fake([
            NewEntryRecievedEvent::class // we only want to fake this specific event
        ]);

        $this->post('/contest', [
            'email' => 'abc@abc.com'
        ]);

        Event::assertDispatched(NewEntryRecievedEvent::class);
    }

    /** @test */
    public function a_welcome_email_is_sent() {

        $this->post('/contest', [
            'email' => 'abc@abc.com'
        ]);

        Mail::assertQueued(WelcomeContestMail::class);
    }
}
