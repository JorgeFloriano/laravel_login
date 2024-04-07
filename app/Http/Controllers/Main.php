<?php

namespace App\Http\Controllers;

use App\Classes\OurClass;
use App\Classes\Random;
use App\Classes\Enc;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Main extends Controller
{

    /*instantiation of the random class in the constructor to make it easier to use later */
    private $R;
    private $Enc;

    public function __construct()
    {
        $this->R = new Random;
        $this->Enc = new Enc;
    }
    //---------------------------------------
    public function index()
    {

        // checks if the user is logged in
        // if ($this->checkSession()) {
        //     return redirect()->route('home');
        // } else {
        //     return redirect()->route('login');
        // }

        $c = new OurClass();
        if ($c->checkSession()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }

        // Create class test
        // $c->test();
        // die();
    }

    //----------------------------------------
    private function checkSession()
    {
        return session()->has('user');
    }

    //----------------------------------------
    public function login()
    {

        // checks if a session already exists
        if ($this->checkSession()) {
            return redirect()->route('index');
        }

        // displays the login form
        $erro = session('erro');
        $data = [];
        if (!empty($erro)) {
            $data = [
                'erro' => $erro
            ];
        }
        return view('login', $data);
    }

    //----------------------------------------
    public function login_submit(LoginRequest $request)
    {

        // checks if the form has been submitted
        if (!$request->isMethod('post')) {
            return redirect()->route('index');
        }

        // checks if a session already exists
        if ($this->checkSession()) {
            return redirect()->route('index');
        }

        // validation
        $request->validated();

        // login data verification
        $user = trim($request->input('txt_user'));
        $pass = trim($request->input('txt_pass'));

        $user = User::where('user', $user)->first();

        // check if user exists
        if (!$user) {
            session()->flash('erro', 'Invalid login.');
            return redirect()->route('login');
        }

        // check if the password is ok
        if (!Hash::check($pass, $user->pass)) {
            session()->flash('erro', 'Invalid login!');
            return redirect()->route('login');
        }

        // login is valid
        session()->put('user', $user);

        Log::channel('main')->info('There was a login.');

        return redirect()->route('index');
    }

    //----------------------------------------
    public function logout()
    {
        Log::channel('main')->info('There was a logout.');
        session()->forget('user');
        return redirect()->route('index');
    }

    //----------------------------------------
    public function home()
    {

        // checks if a session already exists
        if (!$this->checkSession()) {
            return redirect()->route('login');
        }

        // random class was instantiated in the constructor so it can be used within main at any time in a practical way

        $data = [
            'smstoken' => $this->R->SMSToken(),
            'users' => User::all()
        ];

        return view('home', $data);
    }

    //----------------------------------------
    public function edit($id_user)
    {
        $id_user = $this->Enc->decrypt($id_user);



        echo "vou editar os dados do user $id_user";
    }

    //----------------------------------------
    public function final($hash)
    {
        $hash = $this->Enc->decrypt($hash);
        echo 'value:'.$hash;
    }
}
