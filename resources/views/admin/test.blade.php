@extends('master')


@section('form_area')

<style type="text/css">

/*.match_prof_box{
  position:relative;
  float:left;
  width:46%;
  margin:10px;
  }*/
.match_prof_box {
    position: relative;
    float: left;
    width: 29%;
    height: 185px;
    margin: 10px;
    padding: 5px;
  border: 1px solid #ddd;
    border-radius: 4px;
}
.match_prof_box img {
    width: 100%;
    height: 100%;
}
@media (min-width:320px) and (max-width: 680px){
  .match_prof_box {
    position: relative;
    float: left;
    width: 95%;
    margin: 10px;
}
.match_prof_box img {
    width: 95%;
}
  }
</style>

</header>

  <div class="inner-contendbg" ng-app="seriousDatingApp" ng-controller="profileCtrl">

  </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="{{ url() }}/public/css/custom/rotating/js/jquery.circular-carousel.js"></script> 
<script src="{{ url() }}/public/css/custom/rotating/js/script.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

@endsection


