<div class="container-fluid bg-dark text-white">
    <div class="row">
        <div class="col-6 p-3">[APLICAÇÃO]</div>
        <div class="col-6 p-3 text-right">{{session('user')['user']}} | <a href="{{route('logout')}}">Logout</a></div>
    </div>
</div>
