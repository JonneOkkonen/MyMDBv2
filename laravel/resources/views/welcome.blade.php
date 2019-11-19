@extends('layouts.app')

@section('content')
<!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('img/home-bg.jpg') }}')">
        <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                            <h1>MyMDB</h1>
                            <span class="subheading">MyMovieDatabase</span>
                        </div>
                    </div>
                </div>
            </div>
    </header>
    <!-- Main Content -->
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <p class="copyright text-muted">Copyright &copy; Jonne Okkonen 2018-2019</p>
                </div>
            </div>
        </div>
    </footer>
@endsection
