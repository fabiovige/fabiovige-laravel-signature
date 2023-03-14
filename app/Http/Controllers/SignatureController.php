<?php

namespace App\Http\Controllers;

use App\Enums\SignatureStatus;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SignatureController extends Controller
{
    public function index(Request $request)
    {
//        $plan = Plan::create([
//            'name' => 'Plano 1',
//            'short_description' => 'Uma breve descrição',
//            'price' => 2990
//        ]);
//
//        $client = Auth::user()->client()->create([
//            'document' => '12344455509',
//            'birthdate' => '2001-03-04'
//        ]);
//
//        $client->signatures()->create([
//            'plan_id' => $plan->id,
//            'status' => SignatureStatus::ACTIVE
//        ]);

        $validator = Validator::make($request->all(), [
            'fruta' => 'required|string'
        ]);

        $params = $validator->fails() ? $validator->messages() : $validator->validated()['fruta'];
        $user = auth()->user();
        $name = $user->name;
        $document = $user->client->document;
        $status = $user->client->signatures->first()->status->name;

        return view('test', [
            'name' => $name,
            'document' =>$document,
            'status' => $status,
            'params' => $params
        ]);
    }
}
