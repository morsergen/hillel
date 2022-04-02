<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateAccountRequest;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('account/index');
    }

    public function edit()
    {
        return view('account/edit');
    }

    public function update(UpdateAccountRequest $updateAccountRequest)
    {
        $validatedData = $updateAccountRequest->validated();
        Auth::user()->update($validatedData);
        return redirect()->back()->with('success', 'User updated successfully');
    }
}
