@extends('layouts/app_layout')

@php
    use App\Classes\Enc;
    $enc = new Enc;
@endphp

@section('content')
    <div class="container-fluid">
        <h3>Aplication content</h3>
        <h4>SMS TOKEN: <strong>{{$smstoken}}</strong></h4>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis magnam non minima repudiandae explicabo dolorum neque fugiat veritatis, sed corporis doloribus animi soluta deserunt nam. Nobis cum nemo sit recusandae?
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum asperiores, 
        </p>
        <h3>Users List</h3>
        @foreach ($users as $user)
            <li><a href="{{route('main_edit', ['id_user' => $enc->encrypt($user->id)])}}">EDIT - </a>{{$user->user}}</li>
        @endforeach
    </div>
@endsection