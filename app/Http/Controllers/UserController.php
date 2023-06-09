<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        $articles = Article::paginate(10);

        return view('users.index')->with(['users'=> $users,'articles' => $articles,  ] );
    }
    
    # Return all users at json format
    public function users_all()
    {
        $users = User::all();
        $user = $users->first();
        //sleep(1);
        $headers = array_keys($user->toArray());

        $date = [
            "headers" => $headers,
            "data" => $users,
        ];
        return json_encode($date);
    }

    public function softDelete(Request $request)
    {
        $user = User::findOrFail($request->data['id']);
        if(Auth::user()->id ==  $user->id) return response()->json(['error' => 'cant delete connected user'], 401);
        $user->delete();
        return response()->json(['success' => 'Deleted with success'], 200);
    }

    public function restoreAll()
    {

        foreach (User::onlyTrashed()->get() as $user) {
            $user->restore();
        }
        return response()->json(['success' => 'All users was restored'], 200);
    }

    public function toggleTheme()
    {
        $theme = auth()->user()->theme == 'theme-light' ? 'theme-dark' :'theme-light';
        $user = User::findOrFail(auth()->user()->id);
        $user->update(['theme' => $theme  ]);
        return redirect()->back()->with('success', 'Profile updated.');
    }
}
