<?php

namespace App\Http\Controllers;

use App\Jobs\ContactFormSendMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NextFormSendMailController extends Controller
{
    public function contactFormSendMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        ContactFormSendMailJob::dispatch($request->only('name', 'email', 'phone', 'message'));
        // ->delay(now()->addMinutes(1))
        // ->onQueue('email');

        return response()->json([
            'message' => 'Mail sent successfully!'
        ], 200);
    }
}
