<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Events\MessageReceived;
use Livewire\Livewire;
use App\Livewire\Chat\ChatBox;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReceiveMessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_handles_message_received_event()
    {
        $message = 'Test message';

        Livewire::test(ChatBox::class)
            ->dispatch('echo:receive_message,MessageReceived', ['message' => $message])
            ->assertSee($message);
    }
}