  <!-- ======= Sidebar ======= -->
  <aside dir="rtl" id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @if($user->service != "Admin")
      <li class="nav-item">
        <a class="nav-link " href="/sam">
          <i class="bi bi-grid"></i>
          <span>البداية </span>
        </a>
      </li><!-- End Dashboard Nav -->
      @endif
      @if($user->service =="Comptabilité")
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ops-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive-fill"></i><span>العمليات</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ops-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajouter_operation_ar/">
              <i class="bi bi-circle"></i><span> إضافة عملية</span>
            </a>
          </li>
          <li>
            <a href="/operations_ar/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>معاينة العمليات </span>
            </a>
          </li>
          <li>
            <a href="/operations_clotures/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'> العمليات المغلقة </span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#engs-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>الإلتزامات</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="engs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajouter_engagement/decision">
              <i class="bi bi-circle"></i><span> إضافة مقرر </span>
            </a>
          </li>
          <li>
            <a href="/ajouter_engagement/reevaluation">
              <i class="bi bi-circle"></i><span> إعادة نقييم </span>
            </a>
          </li>
          <li>
            <a href="/select_deals/engagement">
              <i  class="bi bi-circle"></i><span> إلتزام بصفقة</span>
            </a>
          </li>
          
          <!-- <li>
            <a href="/engagements/">
              <i class="bi bi-circle"></i><span>معاينة الإلتزامات</span>
            </a>
          </li> -->
          <li>
            <a href="/engagements/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>معاينة الإلتزامات</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#deals-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-files"></i><span>الصفقات</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="deals-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajouter_deal/marche">
              <i class="bi bi-circle"></i><span> إضافة صفقة</span>
            </a>
          </li>
          <li>
            <a href="/ajouter_deal/convention">
              <i class="bi bi-circle"></i><span> إضافة عقد</span>
            </a>
          </li>
          <li>
            <a href="/ajouter_deal/devis">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>  كشف كمي و تقديري</span>
            </a>
          </li>
          <li>
            <a href="/ajouter_deal/facture/1">
              <i class="bi bi-circle"></i><span> إضافة فاتورة</span>
            </a>
          </li>
          <li>
            <a href="/select_deals/avenant">
              <i class="bi bi-circle"></i><span> إضافة ملحق</span>
            </a>
          </li>
          <!-- <li>
            <a href="/deals">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>معاينة الصفقات </span>
            </a>
          </li> -->
          <li>
            <a href="/deals">
              <i class="bi bi-circle"></i><span style='font-size : 11px'>معاينة الصفقات </span>
            </a>
          </li>
        </ul>
      </li>
      
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#eng-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bookmark-plus-fill"></i>
          <span style='font-size : 12px'>إضافة إلتزام</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="eng-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/select_deals/engagement">
              <i  class="bi bi-circle"></i><span style='font-size : 12px'>فاتورة / صفقة / عقد</span>
            </a>
          </li>
          <li>
            <a href="/ajouter_engagement/decision">
              <i class="bi bi-circle"></i><span> مقرر</span>
            </a>
          </li>
        </ul>
      </li> -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#pays-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-currency-dollar"></i><span>الدفعات</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="pays-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/select/ajouter_pay/1" >
              <i class="bi bi-circle"></i><span> إضافة دفع</span>
            </a>
          </li>
          <li>
            <a href="/payments/all">
              <i class="bi bi-circle"></i><span>معاينة الدفعات</span>
            </a>
          </li>
          <!-- <li>
            <a href="/payments/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>معاينة كل الدفعات</span>
            </a>
          </li> -->
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ods-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clock"></i><span>ODS</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ods-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/odss">
              <i class="bi bi-circle"></i><span >معاينة  ODS</span>
            </a>
          </li>
          <li>
            <a href="/calcul_delai">
              <i class="bi bi-circle"></i><span> حساب الأجال </span>
            </a>
          </li>
          <li>
            <a href="/delais">
              <i class="bi bi-circle"></i><span> معاينة الأجال </span>
            </a>
          </li>
          <li>
            <a href="/attestations/penalite">
              <i class="bi bi-circle"></i><span >  عقوبة التأخير </span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#es-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span> المقاولين</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="es-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/entreprise">
              <i class="bi bi-circle"></i><span> إضافة مقاول</span>
            </a>
          </li>
          <li>
            <a href="/entreprises">
              <i class="bi bi-circle"></i><span >معاينة </span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#es-bank" data-bs-toggle="collapse" href="#">
          <i class="bi bi-building"></i><span> البنوك</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="es-bank" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajouter_banque">
              <i class="bi bi-circle"></i><span> إضافة بنك</span>
            </a>
          </li>
          <li>
            <a href="/banques">
              <i class="bi bi-circle"></i><span >معاينة </span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#es-bord" data-bs-toggle="collapse" href="#">
          <i class="bi bi-envelope"></i><span style='font-size : 12px' > جدول إرسال</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="es-bord" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/add_borderau/eng">
              <i class="bi bi-circle"></i><span> إضافة (CB)</span>
            </a>
          </li>
          <li>
            <a href="/add_borderau/pay">
              <i class="bi bi-circle"></i><span> إضافة (Trésor)</span>
            </a>
          </li>
          <li>
            <a href="/borderaux">
              <i class="bi bi-circle"></i><span >معاينة </span>
            </a>
          </li>
        </ul>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#es-att" data-bs-toggle="collapse" href="#">
          <i class="bi bi-newspaper"></i><span> الشهادات</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="es-att" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/attestations/admin">
              <i class="bi bi-circle"></i><span> شهادة إدارية</span>
            </a>
          </li>
          <li>
            <a href="/attestations/leve_main">
              <i class="bi bi-circle"></i><span >مقرر رفع اليد </span>
            </a>
          </li>
          
          <li>
            <a href="/attestations/att_commune">
              <i class="bi bi-circle"></i><span style="font-size : 12px;">    تحرير إعتماد الدفع </span>
            </a>
          </li>
          <li>
            <a href="/attestations/att_retard">
              <i class="bi bi-circle"></i><span >   شهادة تأخر الدفع </span>
            </a>
          </li>
          <li>
            <a href="/attestations/att_error">
              <i class="bi bi-circle"></i><span style="font-size : 12px;">    تصحيح رقم الحساب </span>
            </a>
          </li>
        </ul>
      </li> -->
      @elseif($user->service =="Admin")
      <a class="nav-link " href="/users">
        <i class="bi bi-people-fill"></i>
        <span>الحسابات </span>
      </a>
      <a class="nav-link " href="/settings">
        <i class="bi bi-tools"></i>
        <span>الإعدادات </span>
      </a>
      @else
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ops-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive-fill"></i><span>العمليات</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ops-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/operations_ar/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>معاينة العمليات </span>
            </a>
          </li>
          <li>
            <a href="/operations_clotures/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'> العمليات المغلقة </span>
            </a>
          </li>
        </ul>
      </li>
      <a class="nav-link " href="/deals/all/">
        <i class="bi bi-files"></i>
        <span>الصفقات </span>
      </a>
      <a class="nav-link " href="/engagements/all/">
        <i class="bi bi-menu-button-wide"></i>
        <span>الإلتزامات </span>
      </a>
      <a class="nav-link " href="/payments/all/">
        <i class="bi bi-currency-dollar"></i>
        <span>الدفعات </span>
      </a>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ods-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clock"></i><span>ODS</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ods-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          @if($user->service =="ODS" || $user->service =="Etude" || $user->service =="Suivi" )
          <li>
            <a href="/select_ods">
              <i class="bi bi-circle"></i><span> إضافة ODS</span>
            </a>
          </li>
          @endif
          <li>
            <a href="/odss">
              <i class="bi bi-circle"></i><span >معاينة  ODS</span>
            </a>
          </li>
          <li>
            <a href="/calcul_delai">
              <i class="bi bi-circle"></i><span> حساب الأجال </span>
            </a>
          </li>
          <li>
            <a href="/delais">
              <i class="bi bi-circle"></i><span> معاينة الأجال </span>
            </a>
          </li>
        </ul>
      </li>
      @endif
      
    </ul>

  </aside><!-- End Sidebar-->