<div class="btn-toolbar container" role="toolbar" aria-label="Toolbar with button groups">
{% if pathIndex|default(null) %}
  <div class="btn-group  mr-2 btn-group-sm" role="group" title="Regresar a listado">
    <form>
      <button type="button" class="btn boton  mr-2 btn-group-sm" role="button" onclick="location.href='{{ pathIndex }}'"><i class="fa fa-backward"></i> Volver</button>
    </form>
  </div>
{% endif %}
{% if pathEdit|default(null) %}
  <div class="btn-group  mr-2 btn-group-sm" role="group"  title="Editar Registro" >
    <form>
      <button type="button" class="btn boton mr-2 btn-group-sm" role="button" onclick="location.href='{{ pathEdit }}'"><i class="fa fa-edit"></i> Editar</button>
  </form>
  </div>
{% endif %}

{% if includeDelete|default(null) %}
  <div class="btn-group mr-2 btn-group-sm" role="group"  title="Borrar Registro">
     {{ include(includeDelete) }}
  </div>
</div>
{% endif %}