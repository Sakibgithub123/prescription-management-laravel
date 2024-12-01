<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\UserRegistered;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('frontEnd.register');
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
            'education_informations' => ['required'],
            'qualification' => ['required'],
            'specialist' => ['required'],
            'whenyouseat' => ['required' ],
            'seating_day' => ['required' ],
            'friday_seating_time' => ['required' ],
            'visit_fee' => ['required|numeric' ],
            // 'phone' => ['required','regex:/(01)[0-9]{11}/'],
            'phone' => 'required|numeric|digits:11',
            'birthday' => ['required'],
            'address' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'education_informations' => $request->education_informations,
            'qualification' => $request->qualification,
            'specialist' => $request->specialist,
            'whenyouseat' => $request->whenyouseat,
            'seating_day' => $request->seating_day,
            'friday_seating_time' => $request->friday_seating_time,
            'visit_fee' => $request->visit_fee,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return redirect()->back()->withInput()->withErrors(['registration_failed' => 'Registration failed. Please try again.']);
        }

        event(new Registered($user));

        //registered notification
        // $users=User::all();
        // foreach($users as $notifiableUser){
        //     if($notifiableUser->id !== $user->id){ //avoid notifying the newly registered user
        //         $notifiableUser->notify(new UserRegistered($user));

        //     }
        // }

        Notification::send(Admin::all(), new UserRegistered($request->name));

        // Auth::login($user);
        $notification = array(
            'message' => 'Registration Completed!',
            'alert-type' => 'success',
            'notificationMessage'=>'user registered and notification sent',
        );
        return Redirect()->route('login')->with($notification);

        // return redirect(RouteServiceProvider::HOME);
    }
}
