<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
  public function index()
  {
    $user=User::all();
    return view('content.pages.users',['users'=>$user]);
  }

  public function create()
  {
    return view('content.pages.users-create');
  }

  public function store(Request $request){
  //   $validator=$request->validate([
  //     'name' => 'required|unique:posts|max:255',
  //     'email' => 'required|email',
  //     'password' => 'required',
  // ]);
    $user= new User();
    $user->name=$request->name;
    $user->email=$request->email;
    $user->password=Hash::make($request->password);
    // el Hash, junto a su use arriba, lo que hace es encriptar la contraseña con el app_key del fichero .env
    $user->save();
    return redirect()->route('pages-users');

  }

  public function show($user_id){
    $user=User::find($user_id);
    return view('content.pages.users-show' ,['user'=>$user]);
  }

  public function update(Request $request){
    $user = User::find($request->user_id);
     $user->name=$request->name; //"name" es el mismo nombre que puse en el valor de name del input en la tabla de show
    $user->email=$request->email;
    if(!empty($request->new_password)){
      $user->password=Hash::make($request->new_password);
    }
    $user->save();
    return redirect()->route('pages-users');
  }

  public function destroy($user_id){
    $user= User::find($user_id);
    $user->delete();
    return redirect()->route('pages-users');
  }
}
