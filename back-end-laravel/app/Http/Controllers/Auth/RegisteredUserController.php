<?php

namespace App\Http\Controllers\Auth;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    $types = Type::all();
    return view('auth.register', compact('types'));
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'r_name' => ['required', 'min:3', 'max:50'],
      'r_address' => ['required', 'min:3', 'max:255'],
      'r_phone' => ['required', 'numeric', 'digits:10'],
      'r_vat_number' => ['required', 'digits:11', 'numeric'],
      'r_logo' => ['image', 'mimes:png,jpg', 'max:20480'],

    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    $new_restaurant = new Restaurant();

    $new_restaurant->name = $request->r_name;
    $new_restaurant->slug = Helper::generateSlug($new_restaurant->name, Restaurant::class);
    $new_restaurant->address = $request->r_address;
    $new_restaurant->phone = $request->r_phone;
    $new_restaurant->logo = $request->r_logo;
    $new_restaurant->vat_number = $request->r_vat_number;
    $new_restaurant->user_id = $user->id;

    // $new_restaurant->types()->attach($request->types);

    $new_restaurant->save();

    return redirect(RouteServiceProvider::HOME);
  }
}
