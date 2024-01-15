<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('layouts.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.header')

        @section('content')
        @show
        @include('layouts.footer')
    </main>
    @include('layouts.common-end')
    @stack('custom-scripts')

</body>
<html>