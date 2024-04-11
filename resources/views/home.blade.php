@extends('layouts/app_layout')

@php
    use App\Classes\Enc;
    $enc = new Enc;
@endphp

@section('content')
    <div class="container-fluid">
        <h2>Aplication content</h2><hr>
        <h4>SMS TOKEN: <strong>{{$smstoken}}</strong></h4>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis magnam non minima repudiandae explicabo dolorum neque fugiat veritatis, sed corporis doloribus animi soluta deserunt nam. Nobis cum nemo sit recusandae?
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum asperiores, 
        </p><hr>
        <h3>Users List</h3>
        @foreach ($users as $user)
            <li><a href="{{route('main_edit', ['id_user' => $enc->encrypt($user->id)])}}">EDIT - </a>{{$user->user}}</li>
        @endforeach
        {{-- <div>
            <img src="{{asset('storage/images/local.png')}}">
        </div> --}}

        <div><hr>
            <h3>File Upload</h3>
            <form action="{{route('main_upload')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="txtFile">
                <input type="submit" value="Send">
            </form>
        </div>
        {{-- errors --}}
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection