<?php

namespace App\Http\Controllers;

use App\Classes\OurClass;
use App\Classes\Random;
use App\Classes\Enc;
use App\Classes\Logger;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Main extends Controller
{

    /*instantiation of the random class in the constructor to make it easier to use later */
    private $R;
    private $Enc;
    private $Logger;

    public function __construct()
    {
        $this->R = new Random();
        $this->Enc = new Enc();
        $this->Logger = new Logger();
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

            // logger
            $this->Logger->log('error', trim($request->input('txt_user')) . '- user not exists');

            session()->flash('erro', 'Invalid login.');
            return redirect()->route('login');
        }

        // check if the password is ok
        if (!Hash::check($pass, $user->pass)) {

            // logger
            $this->Logger->log('error', trim($request->input('txt_user')) . '- invalid password');

            session()->flash('erro', 'Invalid login!');
            return redirect()->route('login');
        }

        // login is valid
        session()->put('user', $user);

        // logger
        $this->Logger->log('info', 'is logged in');

        //Log::channel('main')->info('There was a login.');

        return redirect()->route('index');
    }

    //----------------------------------------
    public function logout()
    {
        // logger
        $this->Logger->log('info', 'is logged out');

        //Log::channel('main')->info('There was a logout.');
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
        echo 'value:' . $hash;
    }

    //----------------------------------------
    public function upload(Request $request)
    {
        // upload validate
        $validate = $request->validate(

            // rules
            [
                'txtFile' => 'required|image|mimes:jpeg|max:12|
                dimensions:
                max_width=100,
                max_height=200'
            ],
            // errors messages
            [
                'txtFile.required' => 'Image is required',
                'txtFile.image' => 'It has to be an image',
                'txtFile.mimes' => 'It has to be an jpeg image',
                'txtFile.max' => 'The image must be a maximum of 12 kb',
                'txtFile.dimensions' => 'Valid dimensions (200x100 max)',
            ]
        );

        // $request->txtFile->storeAs('public/images', 'new.jpg');

        $request->txtFile->store('public/images');

        echo 'finsh';
    }

    //----------------------------------------
    public function file_list()
    {
        $files = Storage::files('public/pdfs');

        echo '<pre>';
        print_r($files);
    }

    //----------------------------------------
    public function download($file)
    {
        return response()->download("storage/pdfs/$file");
    }
}