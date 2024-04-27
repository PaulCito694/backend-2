<?php

namespace App\Jobs;

use App\Events\CardMessageSent;
use App\Models\Card;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendCard implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Card $card)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        CardMessageSent::dispatch([
            'text' => $this->card->text
        ]);
    }
}
