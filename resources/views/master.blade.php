@include('header_new')
@include('header_bottom')

<div class="middle inner-middle">
    <div>
        @yield('form_area')
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
@include('footer_new')
@include('main-js')
@yield('javascript')
</body>

</html>

{{--updated maste as of 11/10/18--}}


