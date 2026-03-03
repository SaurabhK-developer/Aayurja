<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

Route::post('/update-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'new_password' => 'required|min:6',
        'secret_key' => 'required'
    ]);

    // simple shared secret for security
    if ($request->secret_key !== '88gravity-secret') {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = User::where('email', $request->email)->first();
    if (!$user) return response()->json(['message' => 'User not found'], 404);

    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json(['message' => 'Password updated successfully']);
});

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});
