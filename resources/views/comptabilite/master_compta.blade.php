<!DOCTYPE html>
<html lang="fr">
@include('components.head')
@yield('style')
<body >
  <!-- container section start -->
  <section id="container" class="">
    @include('components.header_compta')

    <!--main content start-->
    <section id="main-content" style="margin-left : 0px;">
      <section class="wrapper">
        @yield('content')
      </section>
    </section>

  </section>
  <!-- container section start -->

 @include('components.scripts')

 @yield('js_scripts')

@yield('js_scripts_cancel')
</body>
</html>