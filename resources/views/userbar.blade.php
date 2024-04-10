<div class="container-fluid bg-dark text-white">
    <div class="row">
        <div class="col-6 p-3">{{session('user')['user']}}</div>
        <div class="col-6 p-3 text-right"><a href="{{route('logout')}}">Logout</a></div>
    </div>
</div>
