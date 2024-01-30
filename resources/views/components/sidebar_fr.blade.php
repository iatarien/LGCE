<style type="text/css">
/*--------------------------------------------------------------
# Sidebar
--------------------------------------------------------------*/
.sidebar {
  position: fixed;
  top: 60px;
  left: 0;
  bottom: 0;
  width: 200px;
  z-index: 996;
  transition: all 0.3s;
  padding: 5px;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: #aab7cf transparent;
  box-shadow: 0px 0px 20px rgba(1, 41, 112, 0.1);
  background-color: #fff;
}

@media (max-width: 1199px) {
  .sidebar {
    left: -200px;
  }
}

.sidebar::-webkit-scrollbar {
  width: 5px;
  height: 8px;
  background-color: #fff;
}

.sidebar::-webkit-scrollbar-thumb {
  background-color: #aab7cf;
}

@media (min-width: 1200px) {

  #main,
  #footer {
    margin-left: 200px;
    margin-right : 10px;
  }
}

@media (max-width: 1199px) {
  .toggle-sidebar .sidebar {
    left: 0;
  }
}

@media (min-width: 1200px) {

  .toggle-sidebar #main,
  .toggle-sidebar #footer {
    margin-left: 0;
  }

  .toggle-sidebar .sidebar {
    left: -200px;
  }
}

.sidebar-nav {
  padding: 0;
  margin: 0;
  list-style: none;
}

.sidebar-nav li {
  padding: 0;
  margin: 0;
  list-style: none;
}

.sidebar-nav .nav-item {
  margin-bottom: 5px;
}

.sidebar-nav .nav-heading {
  font-size: 11px;
  text-transform: uppercase;
  color: #899bbd;
  font-weight: 600;
  margin: 10px 15px 5px 0px;
}

.sidebar-nav .nav-link {
  display: flex;
  align-items: center;
  font-size: 15px;
  font-weight: 600;
  color: #4154f1;
  transition: 0.3;
  background: #f6f9ff;
  padding: 10px 15px;
  border-radius: 4px;
}

.sidebar-nav .nav-link i {
  font-size: 16px;
  margin-left: 10px;
  margin-right: 10px;
  color: #4154f1;
}

.sidebar-nav .nav-link.collapsed {
  color: #012970;
  background: #fff;
}

.sidebar-nav .nav-link.collapsed i {
  color: #899bbd;
}

.sidebar-nav .nav-link:hover {
  color: #4154f1;
  background: #f6f9ff;
}

.sidebar-nav .nav-link:hover i {
  color: #4154f1;
}

.sidebar-nav .nav-link .bi-chevron-down {
  margin-right: 0;
  transition: transform 0.2s ease-in-out;
}

.sidebar-nav .nav-link:not(.collapsed) .bi-chevron-down {
  transform: rotate(180deg);
}

.sidebar-nav .nav-content {
  padding: 5px 0 0 0;
  margin: 0;
  list-style: none;
}

.sidebar-nav .nav-content a {
  display: flex;
  align-items: center;
  font-size: 14px;
  font-weight: 600;
  color: #012970;
  transition: 0.3;
  padding: 10px 5px 10px 10px;
  transition: 0.3s;
}

.sidebar-nav .nav-content a i {
  font-size: 6px;
  margin-right: 8px;
  line-height: 0;
  border-radius: 50%;
}

.sidebar-nav .nav-content a:hover,
.sidebar-nav .nav-content a.active {
  color: #4154f1;
}

.sidebar-nav .nav-content a.active i {
  background-color: #4154f1;
}

</style>
  <!-- ======= Sidebar ======= -->
  <aside dir="ltr" id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @if($user->service != "Admin")
      <li class="nav-item">
        <a class="nav-link " href="/sam">
          <i class="bi bi-grid"></i>
          <span>Accueil </span>
        </a>
      </li><!-- End Dashboard Nav -->
      @endif
      @if($user->service =="Comptabilité")
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ops-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive-fill"></i><span>Operations</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ops-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajouter_operation_ar/">
              <i class="bi bi-circle"></i><span> Ajouter </span>
            </a>
          </li>
          <li>
            <a href="/operations_ar/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'> Consulter les Opérations </span>
            </a>
          </li>
          <li>
            <a href="/operations_clotures/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>  Opérations Cloturés </span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#engs-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Engagements</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="engs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajouter_engagement/decision">
              <i class="bi bi-circle"></i><span>  Ajouter Décision </span>
            </a>
          </li>
          <li>
            <a href="/ajouter_engagement/reevaluation">
              <i class="bi bi-circle"></i><span> Réévaluation  </span>
            </a>
          </li>
          <li>
            <a href="/select_deals/engagement">
              <i  class="bi bi-circle"></i><span style='font-size : 12px'>  Engagement d'un marché</span>
            </a>
          </li>
          
          <!-- <li>
            <a href="/engagements/">
              <i class="bi bi-circle"></i><span>معاينة الإلتزامات</span>
            </a>
          </li> -->
          <li>
            <a href="/engagements/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'> Consulter les engagements</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#deals-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-files"></i><span>Marchés</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="deals-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajouter_deal/marche">
              <i class="bi bi-circle"></i><span>  Ajouter un marché</span>
            </a>
          </li>
          <li>
            <a href="/ajouter_deal/convention">
              <i class="bi bi-circle"></i><span> Ajouter Convention </span>
            </a>
          </li>
          <li>
            <a href="/ajouter_deal/devis">
              <i class="bi bi-circle"></i><span > Devis Quantitatif et Estimatif</span>
            </a>
          </li>
          <li>
            <a href="/ajouter_deal/facture/1">
              <i class="bi bi-circle"></i><span> Ajouter un Facture</span>
            </a>
          </li>
          <li>
            <a href="/select_deals/avenant">
              <i class="bi bi-circle"></i><span>Ajouter un avenant</span>
            </a>
          </li>
          <!-- <li>
            <a href="/deals">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>معاينة الصفقات </span>
            </a>
          </li> -->
          <li>
            <a href="/deals/all/">
              <i class="bi bi-circle"></i><span >Consulter les marchés  </span>
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
          <i class="bi bi-currency-dollar"></i><span>Paiements</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="pays-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/select/ajouter_pay/1" >
              <i class="bi bi-circle"></i><span>  Ajouter Paiement</span>
            </a>
          </li>
          <li>
            <a href="/payments/all">
              <i class="bi bi-circle"></i><span> Consulter les paiements</span>
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
              <i class="bi bi-circle"></i><span >Consulter les ODS</span>
            </a>
          </li>
          <li>
            <a href="/calcul_delai">
              <i class="bi bi-circle"></i><span>  Calculer les délais </span>
            </a>
          </li>
          <li>
            <a href="/delais">
              <i class="bi bi-circle"></i><span>  Consulter les délais </span>
            </a>
          </li>
          <li>
            <a href="/attestations/penalite">
              <i class="bi bi-circle"></i><span >   Pénalité de retard </span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#es-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span> Entreprises</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="es-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/entreprise">
              <i class="bi bi-circle"></i><span> Ajouter Entreprise</span>
            </a>
          </li>
          <li>
            <a href="/entreprises">
              <i class="bi bi-circle"></i><span >Consulter </span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#es-bank" data-bs-toggle="collapse" href="#">
          <i class="bi bi-building"></i><span> Banques</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="es-bank" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajouter_banque">
              <i class="bi bi-circle"></i><span>  Ajouter une banque</span>
            </a>
          </li>
          <li>
            <a href="/banques">
              <i class="bi bi-circle"></i><span >Consulter </span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#es-bord" data-bs-toggle="collapse" href="#">
          <i class="bi bi-envelope"></i><span style='font-size : 12px' >  Borderaux d'envoi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="es-bord" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/add_borderau/eng">
              <i class="bi bi-circle"></i><span> Ajouter (CB)</span>
            </a>
          </li>
          <li>
            <a href="/add_borderau/pay">
              <i class="bi bi-circle"></i><span> Ajouter (Trésor)</span>
            </a>
          </li>
          <li>
            <a href="/borderaux">
              <i class="bi bi-circle"></i><span >Consulter </span>
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
        <span>Comptes </span>
      </a>
      <a class="nav-link " href="/settings">
        <i class="bi bi-tools"></i>
        <span>Réglages </span>
      </a>
      @else
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ops-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive-fill"></i><span>Opérations</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ops-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/operations_ar/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'>Consulter les Opérations  </span>
            </a>
          </li>
          <li>
            <a href="/operations_clotures/all/">
              <i class="bi bi-circle"></i><span style='font-size : 12px'> Opérations Cloturés  </span>
            </a>
          </li>
        </ul>
      </li>
      <a class="nav-link " href="/deals/all/">
        <i class="bi bi-files"></i>
        <span>Marchés </span>
      </a>
      <a class="nav-link " href="/engagements/all/">
        <i class="bi bi-menu-button-wide"></i>
        <span>Engagements </span>
      </a>
      <a class="nav-link " href="/payments/all/">
        <i class="bi bi-currency-dollar"></i>
        <span>Paiements </span>
      </a>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ods-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clock"></i><span>ODS</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ods-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          @if($user->service =="ODS" || $user->service =="Etude" || $user->service =="Suivi" )
          <li>
            <a href="/select_ods">
              <i class="bi bi-circle"></i><span> Ajouter ODS</span>
            </a>
          </li>
          @endif
          <li>
            <a href="/odss">
              <i class="bi bi-circle"></i><span >Consulter  ODS</span>
            </a>
          </li>
          <li>
            <a href="/calcul_delai">
              <i class="bi bi-circle"></i><span>  Calculer délais </span>
            </a>
          </li>
          <li>
            <a href="/delais">
              <i class="bi bi-circle"></i><span>  Consulter délais </span>
            </a>
          </li>
        </ul>
      </li>
      @endif
      
    </ul>

  </aside><!-- End Sidebar-->