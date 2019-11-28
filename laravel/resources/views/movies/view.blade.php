@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/movies/movies.js') }}"></script>
    <script src="{{ asset('js/cookie.js') }}"></script>
    <script src="{{ asset('js/pagination.js') }}"></script>
@endsection

@section('styles')
    <link href="{{ asset('css/movies.css') }}" rel="stylesheet">
@endsection

@section('heading')
    <h1>Movies</h1>
    <span class="subheading" id="subHeading">You have x movies on your collection.</span>
@endsection

@section('heading-content')
    <!-- MovieTypeBar -->
    <div class="progress" id="movieTypeBar"></div>
    <br>
@endsection

@section('header-bottom')
    <!--Tab Selector-->
    <ul class="nav nav-tabs" id="views">
        <li class="nav-item tabItem" id="gridSelector">
            <a class="nav-link tabLink" data-toggle="tab" href="#gridView" onclick="Select('grid');">
            <img src="{{ asset('img/grid-three-up.svg') }}" style="width: 16px; height: 16px;">  Grid View</a>
        </li>
        <li class="nav-item tabItem" id="listSelector">
            <a class="nav-link tabLink" data-toggle="tab" href="#listView" onclick="Select('list');">
            <img src="{{ asset('img/list.svg') }}" style="width: 16px; height: 16px;"> List View</a>
        </li>
    </ul>
@endsection

@section('content')
<!-- Main Content -->
<div class="tab-content">
        <div id="gridView" class="tab-pane fade">
            <button class="btn btn-dark" id="refreshButton" onclick="OnLoad()">Refresh</button>
            <div class="row" id="movieGrid"></div>
        </div>
        <div id="listView" class="tab-pane fade">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col" width="30px"></th>
                        <th scope="col" class="td_button" width="30px"><button class="btn btn-light" id="refreshButton" onclick="OnLoad()">Refresh</button></th>
                    </tr>
                </thead>
                <tbody id="movieList"></tbody>
            </table>
        </div>
        <!--Page Selector-->
        <nav class="pageSelector">
            <ul class="pagination" id="pageSelector">
                <li class="page-item" id="previous" onclick="Previous()">
                    <a class="page-link">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item" id="next">
                    <a class="page-link" onclick="Next()">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
</div>
<!-- SelectView with JavaScript -->
<script type="text/javascript" src="{{ asset('js/movies/viewSelector.js') }}"></script>
<script type="text/javascript">
    // Load Page Content
    $(document).ready(function() {
        OnLoad();
        $('[data-toggle="tooltip"]').tooltip('show');
    });
</script>
@endsection