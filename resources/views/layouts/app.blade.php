<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('layouts.sidebar')
    <main class="main-content position-relative mt-3 border-radius-lg ">
        
        @include('layouts.header')
        <div class="container min-vh-77">
            @section('content')
            @show
        </div>
        
        @include('layouts.footer')
    </main>
    @include('layouts.common-end')
    @stack('custom-scripts')

</body>
<html>