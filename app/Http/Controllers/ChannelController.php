<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index()
    {
        return Channel::all();
    }

    public function store(Request $request)
    {
        return Channel::create([
            'user_id' => auth()->id(),
            'name' => $request->get('channel_name')
        ]);
    }

    public function show(Channel $channel)
    {
        return $channel;
    }

    public function update(Request $request, Channel $channel)
    {
        $channel->update($request->all());
        return $channel;
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();
        return response()->json(null, 204);
    }
}
