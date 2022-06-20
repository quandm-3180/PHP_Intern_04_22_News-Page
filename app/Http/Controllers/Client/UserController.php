<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $categories = Category::isShow()->get();
        $user = Auth::user();

        return view('client.user.index', compact('categories', 'user'));
    }

    public function edit()
    {
        $categories = Category::isShow()->get();
        $user = Auth::user();

        return view('client.user.edit', compact('categories', 'user'));
    }

    public function update(UpdateRequest $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $user->update($data);

        return redirect()->route('client.user.index');
    }
}
