<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("user.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->id == Auth::user()->id) {
            $validator = Validator::make($request->all(), [
                'name' => ['nullable', 'string', 'min:3', 'max:255'],
                'email' => ['nullable', 'email'],
                'password' => ['nullable', 'confirmed', 'string', 'min:3', 'max:255']
            ]);
            if ($validator->fails()) {
                return redirect()->route('user.index')->withErrors($validator);
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->save();
            return redirect()->route("user.index", ['success' => "true"]);
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        if ($id != Auth::user()->id) {
            return Redirect()->route('index');
        }
        if (User::find($id)) {
            $user = User::find($id);
            $user->delete();
        }
        return Redirect()->route('index');
    }*/
    public function destroy(User $user)
    {
        if ($user->id == Auth::user()->id) {
            $user->delete();
            return redirect()->route('user.index');
        }
        return redirect()->route('user.index');
    }
}
