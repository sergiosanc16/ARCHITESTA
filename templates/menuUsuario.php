<nav class="navbar navbar-expand-lg   navbar-light bg-warning">
<a class="navbar-brand" href="{{ path('app_homepage')}}">
    <img src={{ asset('img/testahorizontal.png') }}  height="50" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Mantenimientos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{path('app_testa_timagen_index')}}">Imágenes</a>
          <a class="dropdown-item" href="{{path('app_testa_tnotario_index')}}">Notario</a>
          <a class="dropdown-item" href="{{path('app_testa_toficio_index')}}">Oficio</a>
          <a class="dropdown-item" href="{{path('app_testa_totorgante_index')}}">Otorgante</a>
          <a class="dropdown-item" href="{{path('app_testa_tparentesco_index')}}">Parentesco</a>
          <a class="dropdown-item" href="{{path('app_testa_tpoblacion_index')}}">Poblacion</a>
          <a class="dropdown-item" href="{{path('app_testa_ttestamento_index')}}">Testamento</a>
          <a class="dropdown-item" href="{{path('app_testa_ttestaotorgante_index')}}">Otorgantes de un testamento</a>
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Utilidades
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{path('app_csv_upload')}}">Carga de ficheros csv</a>
        </div>
      </li>




      <li class="nav-item">
        <a class="nav-link" href="https://www.zooniverse.org/projects/agrmzooniverse/testamentos-de-murcia?language=es" target="_blank">zooniverse.org</a>
      </li>
      {% if is_granted('ROLE_ADMIN') %}
      <li class="nav-item">
        <a class="nav-link" href="{{ path('app_user_index')}}">Gestión de usuarios</a>
      </li>

      {% endif %}
    </ul>
    <ul class="navbar-nav ml-auto">

        {% if user|default(true) %}
            {% if is_granted('ROLE_ADMIN') %}
                <li><a href="{{path('app_user_index')}}"> Lista de usuarios</a></li>
            {% endif %}
        {% endif %}





      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span><img src={{ asset('img/avatar/avatar01.png') }} width="40px"></span>  {{app.user.email|default('No registrado')}}
        </a>
        {% if user|default(false) %}
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="">Mi perfil</a>
          <a class="dropdown-item" href="">Cambiar clave</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{path('app_logout')}}">Cerrar sesión</a>

        </div>
        {% endif %}
        {% if not user|default(false) %}
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{path('app_login')}}">Regístrate</a>
        </div>
        {% endif %}

      </li>
    </ul>

  </div>
</nav>