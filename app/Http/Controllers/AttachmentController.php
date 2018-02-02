<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        if ($attachment->response->ticket->user_id !== auth()->user()->id) {
            abort(404);
        }

        if (!Storage::exists($attachment->location)) {
            abort(404);
        }

        $location = base_path() . "/storage/app/{$attachment->location}";

        return response()->download($location, $attachment->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        if ($attachment->response->ticket->user_id !== auth()->user()->id) {
            abort(404);
        }

        Storage::delete($attachment->location);

        $attachment->delete();

        if (request()->expectsJson()) {
            return response(['success' => true, 'message' => 'Attachment deleted']);
        }

        return back()->withSuccess('Attachment Deleted');
    }
}
