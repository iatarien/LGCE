@include('components.header')
@yield('style')

@if($lang =="fr")
  @include('components.sidebar_fr')
@else
  @include('components.sidebar')
@endif

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        @yield('content')
      </section>
    </section>

  </section>
  <!-- container section start -->

 @include('components.footer')

 @yield('js_scripts')
</body>
</html>