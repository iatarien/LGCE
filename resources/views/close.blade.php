<script type="text/javascript">
var av = "{{ Session::get('id_av')}}";
var bord = "{{ Session::get('id_bord')}}";
window.avenant = av;
window.id_bord = bord;
window.close();
document.location.href="/entreprises";

</script>