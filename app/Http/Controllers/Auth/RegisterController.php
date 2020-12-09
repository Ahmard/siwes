<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Person;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(): Factory|View|Application
    {
        return view('auth.register.index');
    }

    public function showStudentRegistrationForm(): Factory|View|Application
    {
        return view('auth.register.student');
    }

    public function showLecturerRegistrationForm(): Factory|View|Application
    {
        return view('auth.register.lecturer');
    }

    public function createStudent(Request $request): Factory|View|Application
    {
        Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'other_names' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:people'],
            'password' => ['required', 'string', 'min:4'],
            'confirm_password' => ['required', 'string', 'min:4', 'same:password'],
        ])->validate();

        $student = Person::query()->create([
            'first_name' => $request['first_name'],
            'other_names' => $request['other_names'],
            'email' => $request['email'],
            'type' => 'student',
            'password' => Hash::make($request['password']),
        ]);

        return view('auth.register.student')
            ->with('student', $student);
    }

    public function createLecturer()
    {

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Person|Builder|Model
     */
    protected function create(array $data): Model|Builder|Person
    {
        return Person::query()->create($data);
    }
}
