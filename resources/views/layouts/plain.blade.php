<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.components.meta-data')
        @include('layouts.components.head-scripts')
        @include('layouts.components.styles')
        <style>
        </style>
    </head>
    <body>
        <div id="app">
            <div class="text-cente">
            <a href="{{url('/')}}" >
                <img src="{{ asset('storage/images/global50-50-logo.png') }}" height="80px" />
            </a>
            </div>
            <main>
                <div id="app-accordion">
                    <div class="container-fluid">
                        <div class="app">
                            <div class="content">
                                @yield('main')
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        @include('layouts.components.bottom-scripts')
    </body>
</html>
