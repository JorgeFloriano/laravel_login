@extends('layouts/login_layout')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 offset-lg-4">

                {{-- form --}}
                <form action="{{route('login_submit')}}" method="post">

                    {{-- csrf --}}
                    @csrf

                    <h1>LOGIN</h1>
                    <hr>
                    <div class="form-group">
                        <label>User:</label>
                        <input type="email" name="txt_user" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="txt_pass" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="ENTER" class="btn btn-primary">
                    </div>

                {{-- /form --}}
                </form>
                
                {{-- validation errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $msg)
                                <li>{{$msg}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            {{-- login errors --}}
            @if (isset($erro))
                <div class="alert alert-danger text-center">{{$erro}}</div>
            @endif

            </div>
        </div>
    </div>
@endsection
