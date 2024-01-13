
<!--sidebar start-->
    <aside>
      @if(auth()->user()->position == "Admin")
      <div id="sidebar" class="nav-collapse " style="z-index: 99;">
      @else
      <div id="sidebar" class="nav-collapse " style="margin-left : -180px;">
      @endif
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="/">
                          <img class="img-icon" src="{{ url('img/home.png') }}">
                          <span>Accueil</span>
                      </a>
          </li>
          @if(auth()->user()->position == "Admin")
          
          @endif
          <!---
          <li class="sub-menu">
            <a href="/ajouter_operation" class="">
                <img class="img-icon" src="{{ url('img/table.png') }}">
                <span style="font-size: 12px;">Ajouter une opération</span>
            </a>
          </li>
          !-->
          @if(auth()->user()->position == "Admin")
          <li class="sub-menu">
            <a href="/users" class="">
                <img class="img-icon" src="{{ url('img/user_avatar.png') }}">
                <span>utilisateurs</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="/backup" class="">
                <img class="img-icon" src="{{ url('img/facture.png') }}">
                <span>Backup</span>
            </a>
          </li>
          <li>
            <a class="" href="/comptabilite">
                          <img class="img-icon" src="{{ url('img/facture.png') }}">
                          <span>Comptabilité</span>
                      </a>
          </li>
          <!---
          <li>
            <a class="" href="/grh">
                          <img class="img-icon" src="{{ url('img/grh.png') }}">
                          <span>Personnel</span>
                      </a>
          </li>
          !-->

   
          @endif
          
          <li class="hidden-md hidden-lg">
            <a href="/profile"><i class="fa f-user"></i> Parametres</a>
          </li>
          <li class="hidden-md hidden-lg">
            <a href="/logout"><i class="fa fa-close"></i> Déconnexion</a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
