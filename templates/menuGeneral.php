<nav class="navbar navbar-expand-lg   navbar-light bg-light">
<a class="navbar-brand" href="">
    <img src={{ asset('img/bklhorizontal.png') }}  height="50" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="">Quienes Sómos <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Contacto</a>
      </li>
    </ul>
     

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ path('app_login')}}"><i class="fa fa-user" aria-hidden="true"></i> Usuario Registrado <span class="sr-only">(current)</span></a>
      </li>
    </ul>

  </div>
</nav>