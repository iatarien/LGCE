
<header class="header dark-bg" style="z-index: 100;">


      <!--logo start-->
      <a href="/sam" class="logo hidden-sm hiddden-md">DEP <span class="lite">Ouargla</span></a>
      <!--logo end-->

      

      <div class="top-nav notification-row" style="margin-left : 0;" >
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
            <li class="navbar navbar-inverse" style="background-color : transparent; border : none; margin-bottom : 0px; ">
                <div class="container-fluid">
                @if($user->service =="Comptabilité")
                <ul class="nav navbar-nav">
                   <!-- <li><a href="/aprobations/{{$user->chapitre}}">الاعتمادات</a></li> !-->
                   <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">  الشهادات
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                           <li><a href="/attestations/admin"> شهادة إدارية </a></li>
                           <li><a href="/attestations/leve_main">مقرر رفع اليد</a></li>
                        </ul>
                    </li> 
                   <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> جدول إرسال
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                           <li><a href="/add_borderau/eng"> (CF) جدول إرسال    </a></li>
                           <li><a href="/add_borderau/pay"> جدول إرسال (خزينة)  </a></li>
                           <li><a href="/borderaux"> معاينة  </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> ODS
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                           <li><a href="/select_ods"> ODS إضافة  </a></li>
                           <li><a href="/odss"> ODS معاينة  </a></li>
                           <li><a href="/calcul_delai"> Calcul Delai  </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> العمليات
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                           <li><a href="/ajouter_operation_ar"> إضافة عملية </a></li>
                           <li><a href="/operations_ar/all"> معاينة العمليات </a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> المقاولين
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                            <li><a href="/entreprise"> إضافة مقاول</a></li>
                            <li><a href="/entreprises">معاينة المقاولين</a></li>
                        </ul>
                    </li>
                    <li><a href="/sam">التراكم</a></li>
                    <!-- <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> التراكم
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                           <li><a href="/ajouter_cumul">2019  إضافة تراكم نهاية </a></li> 
                            <li><a href="/cumul/all"> معاينة التراكمات  </a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">  الدفــعات
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                            <li><a href="/select/ajouter_pay">إضافة دفع</a></li>
                            <li><a href="/payments"> معاينة الدفــعات</a></li>
                            <li><a href="/payments/all">معاينة كل الدفــعات</a></li>
                            <li><a href="/anep_ctc">ANEP/CTC</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">إضافة إالتزام
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                            <li><a href="/ajouter_engagement/inscription">تسجيل عملية</a></li>
                            <li><a href="/ajouter_engagement/decision">مقرر</a></li>
                            @if($user->username =="fatima")
                            <li><a href="/ajouter_engagement/juridique"> التزام قانوني </a></li>
                            @endif
                            <!--
                            <li><a href="/select/ajouter_eng_compta"> التزام محاسبي </a></li> 
                            <li><a href="/ajouter_engagement/fiche_eco">  بطاقة اقثصاد </a></li>!-->
                            <li><a href="/ajouter_engagement/mixte">  (PSD/PSC) إالتزام</a></li>
                            <li><a href="/ajouter_engagement/FSDRS"> التزام (صندوق الجنوب) </a></li>   
                            <li><a href="/select/retrait">  سحب بطاقة  </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> معاينة الالتزامات
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                            <li><a href="/engagements"> معاينة الالتزامات</a></li>
                            <li><a href="/engagements/all">معاينة كل الالتزامات</a></li>
                        </ul>
                    </li>
                    @if($user->username=="mehdi" or $user->username=="sam")
                    <li><a href="/psc_stuff">PSC</a></li>
                    @endif
                    
                </ul>
                @else
                <ul class="nav navbar-nav">
                    <li><a href="/sam"> Cumul</a></li>
                    @if($user->service =="Suivi" or $user->service =="Etude")
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> ODS
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="text-align : right;">
                           <li><a href="/select_ods"> ODS إضافة  </a></li>
                           <li><a href="/odss"> ODS معاينة  </a></li>
                        </ul>
                    </li>
                    @else
                    <li><a href="/odss"> ODS   </a></li>
                    @endif
                    <li><a href="/payments/all">معاينة الدفــعات</a></li>
                    <li><a href="/engagements/all">معاينة الالتزامات</a></li>
                    <li><a href="/comptabilite">البداية</a></li>
                    <li><a href="#">&emsp;&emsp;</a></li>
                    
                </ul>
                @endif
                </div>
            </li>
           <!-- user login dropdown start-->
          <li class="dropdown hidden-sm hidden-md">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" style="width: 35px; height: 35px;" src="{{ url($user->photo) }}">
                            </span>
                            <span class="username">{{ $user->full_name }}</span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li style="display : block;">
                <a href="/profile"><img class="img-icon" src="{{ url('img/user_avatar.jpg') }}">&emsp;Profile</a>
              </li>
              <li>
                <a href="/historique"><img class="img-icon" src="{{ url('img/history.png') }}">&emsp;Historique</a>
              </li>
              <li>
                <a href="{{ route('logout') }}"><img class="img-icon" src="{{ url('img/close.png') }}">&emsp;Déconnexion</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
