<?php

namespace App\Http\Controllers;

use App\Jobs\SendCard;
use App\Models\Card;
use Illuminate\Http\Request;
use App\Events\CardMessageSent;
use Illuminate\Support\Facades\Http;

class CardController extends Controller
{
    public function cards () {
        $cards = Card::with('user')->get()->append('time');

        return response()->json($cards);
    }

    public function card (Request $request) {
        $card = Card::create([
            'user_id' => auth()->id(),
            'text' => $request->get('text')
        ]);

        SendCard::dispatch($card);

        return response()->json([
            'success' => true,
            'message' => 'Mensaje creado'
        ]);
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        event(new CardMessageSent($message));

        return response()->json(['message' => 'Message sent successfully']);
    }

    public function sendWhatsappMessage(Request $request) {
        $message = $request->input('message');

        $response = Http::withOptions([
            'verify' => false, // Deshabilitar la verificación SSL
        ])->withHeaders([
            'Authorization' => 'Bearer EAAU1dHFYFPcBOZChKdFsNa8SGhSLtWqYwwJavL2xl8AHEk3WpwPFjt4tj08LHjiXKn1ZBJKftUWI7BYpMiwobYPNym4C7K0k8wXRcZCn2vpevYzgCZBOrQwa6HTUlzeHYkVsqrmuTz8816xBIASssgVYbxyDeuPmyjNVwgSFR81fPtDgDJZAWZAzyG58t2gNSwkZBq92NuZBdgvaTj671sANasHG2rIFVAjx',
            'Content-Type' => 'application/json',
        ])->post('https://graph.facebook.com/v19.0/241576585716809/messages', [
            'messaging_product' => 'whatsapp',
            'to' => '51971013493',
            'type' => 'template',
            'template' => [
                'name' => 'hello_world',
                'language' => [
                    'code' => 'en_US'
                ]
            ]
        ]);
        return $response->json();
    }
}
