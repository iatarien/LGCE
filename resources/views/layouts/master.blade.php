@include('components.header')
@yield('style')
@include('components.sidebar')
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