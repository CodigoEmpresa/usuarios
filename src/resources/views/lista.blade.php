<div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">
	<div class="col-xs-12">
		<h4>Personas</h4>
	</div>
	<div id="alerta" class="col-xs-12" style="display:none;">
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Datos actualizados satisfactoriamente.
		</div>
	</div>
	<div class="col-xs-12">
		<div class="input-group">
      		<input name="buscador" type="text" class="form-control" placeholder="Buscar">
      		<span class="input-group-btn">
        		<button id="buscar" data-role="buscar" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        		<button id="crear" data-role="crear" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
      		</span>
    	</div>
	</div>
	<div class="col-xs-12">
		<br>
	</div>
	<div class="col-xs-12">
		<ul class="list-group" id="personas">
			@foreach($personas as $persona)
				<li class="list-group-item">
	                <h5 class="list-group-item-heading">
	                    {{ strtoupper($persona['Primer_Apellido'].' '.$persona['Segundo_Apellido'].' '.$persona['Primer_Nombre'].' '.$persona['Segundo_Nombre']) }}
	                    <a data-role="eliminar" data-rel="{{ $persona['Id_Persona'] }}" class="pull-right btn btn-danger btn-xs" style="margin: -7px -12px 0px 3px">
	                    	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	                    </a>
	                    <a data-role="editar" data-rel="{{ $persona['Id_Persona'] }}" class="pull-right btn btn-primary btn-xs" style="margin: -7px 0px 0px 0px">
	                    	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
	                    </a>
	                </h5>
	                <p class="list-group-item-text">
	                    <div class="row">
	                        <div class="col-xs-12">
	                            <div class="row">
	                                <div class="col-xs-12 col-sm-6 col-md-3"><small>Identificación: {{ $persona->tipoDocumento['Nombre_TipoDocumento'].' '.$persona['Cedula'] }}</small></div>
	                            </div>
	                        </div>
	                    </div>
	                </p>
	            </li>
			@endforeach
		</ul>
	</div>
	<div id="paginador" class="col-xs-12">
		{!! $personas->render() !!}
	</div>
</div>
<!-- Modal formulario  persona -->
<div class="modal fade" id="modal_form_persona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<form action="" id="form_persona">
			<div class="modal-content">
				<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    			<h4 class="modal-title" id="myModalLabel">Crear o editar persona.</h4>
	  			</div>
	      		<div class="modal-body">
		      		<fieldset>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Tipo documento </label>
		        				<select name="Id_TipoDocumento" id="" class="form-control">
		        					<option value="">Seleccionar</option>
		        					@foreach($documentos as $documento)
		        						<option value="{{ $documento['Id_TipoDocumento'] }}">{{ $documento['Descripcion_TipoDocumento'] }}</option>
		        					@endforeach
		        				</select>
		        			</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Cedula">* Documento </label>
		        				<input type="text" name="Cedula" class="form-control">
		        			</div>
		        		</div>
		        		<div class="col-xs-12">
		        			<div class="form-group">
		        				<label class="control-label" for="Primer_Apellido">* Primer apellido </label>
		        				<input type="text" name="Primer_Apellido" class="form-control">
		        			</div>
		        		</div>
		        		<div class="col-xs-12">
		        			<div class="form-group">
		        				<label class="control-label" for="Segundo_Apellido">Segundo apellido </label>
		        				<input type="text" name="Segundo_Apellido" class="form-control">
		        			</div>
		        		</div>
		        		<div class="col-xs-12">
		        			<div class="form-group">
		        				<label class="control-label" for="Primer_Nombre">* Primer nombre </label>
		        				<input type="text" name="Primer_Nombre" class="form-control">
		        			</div>
		        		</div>
		        		<div class="col-xs-12">
		        			<div class="form-group">
		        				<label class="control-label" for="Segundo_Nombre">Segundo nombre </label>
		        				<input type="text" name="Segundo_Nombre" class="form-control">
		        			</div>
		        		</div>
		        		<div class="col-xs-12">
		        			<hr>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
			        			<label class="control-label" for="Fecha_Nacimiento">* Fecha de nacimiento</label>
		        				<input type="text" name="Fecha_Nacimiento" data-role="datepicker" class="form-control">
							</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
			        			<label class="control-label" for="Id_Genero">* Genero</label><br>
				        		<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default">
										<input type="radio" name="Id_Genero" value="1" autocomplete="off"> <span class="text-success">M</span>
									</label>
									<label class="btn btn-default">
										<input type="radio" name="Id_Genero" value="2" autocomplete="off"> <span class="text-danger">F</span>
									</label>
								</div>
							</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_Etnia">* Etnia </label>
		        				<select name="Id_Etnia" id="" class="form-control">
		        					<option value="">Seleccionar</option>
		        					@foreach($etnias as $etnia)
		        						<option value="{{ $etnia['Id_Etnia'] }}">{{ $etnia['Nombre_Etnia'] }}</option>
		        					@endforeach
		        				</select>
		        			</div>
		        		</div>
		        		<div class="col-xs-12">
		        			<hr>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_Pais">* Pais </label>
		        				<select name="Id_Pais" id="" class="form-control">
		        					<option value="">Seleccionar</option>
		        					@foreach($paises as $pais)
		        						<option value="{{ $pais['Id_Pais'] }}">{{ $pais['Nombre_Pais'] }}</option>
		        					@endforeach
		        				</select>
		        			</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Nombre_Ciudad">Ciudad </label>
		        				<select name="Nombre_Ciudad" id="" class="form-control" data-value="">
		        					<option value="">Seleccionar</option>
		        				</select>
		        			</div>
		        		</div>
		        	</fieldset>
	      		</div>
	      		<div class="modal-footer">
	      			<input type="hidden" name="Id_Persona" value="0">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        		<button type="submit" class="btn btn-primary">Guardar</button>
	      		</div>
	    	</div>
    	</form>
  	</div>
</div>

<script type="text/javascript">
	/*Esto hay que separarlo a los assets y luego agregarlo a la publicación del archivo*/
	$(function(e)
	{
		var URL = $('#main_persona').data('url');
		var $personas_actuales = $('#personas').html();

		var reset = function(e)
		{
			$('input[name="buscador"]').val('');
			$('#buscar span').removeClass('glyphicon-remove').addClass('glyphicon-search');
			$('#personas').html($personas_actuales);
			$('#paginador').fadeIn();
		};

		var buscar = function(e)
		{
			var key = $('input[name="buscador"]').val();
			if (key.length > 2)
			{
				$('#buscar span').removeClass('glyphicon-search').addClass('glyphicon-remove');
				$('#buscar').data('role', 'reset');

				$.get(
					URL+'/service/buscar/'+key,
					{}, 
					function(data)
					{
						if(data.length > 0)
						{
							var html = '';
							$.each(data, function(i, e){
								html += '<li class="list-group-item">'+
							                '<h5 class="list-group-item-heading">'+
							                    ''+e['Primer_Apellido'].toUpperCase()+' '+e['Segundo_Apellido'].toUpperCase()+' '+e['Primer_Nombre'].toUpperCase()+' '+e['Segundo_Nombre'].toUpperCase()+''+
							                    '<a data-role="eliminar" data-rel="'+e['Id_Persona']+'" class="pull-right btn btn-danger btn-xs" style="margin: -7px -12px 0px 3px">'+
							                    	'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+
							                    '</a>'+
							                    '<a data-role="editar" data-rel="'+e['Id_Persona']+'" class="pull-right btn btn-primary btn-xs" style="margin: -7px 0px 0px 0px">'+
							                    	'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'+
							                    '</a>'+
							                '</h5>'+
							                '<p class="list-group-item-text">'+
							                    '<div class="row">'+
							                        '<div class="col-xs-12">'+
							                            '<div class="row">'+
							                                '<div class="col-xs-12 col-sm-6 col-md-3"><small>Identificación: '+e.tipo_documento['Nombre_TipoDocumento']+' '+e['Cedula']+'</small></div>'+
							                            '</div>'+
							                        '</div>'+
							                    '</div>'+
							                '</p>'+
							            '</li>';
							});
							$('#personas').html(html);
							$('#paginador').fadeOut();
						}
					},
					'json'
				)
			} else if(key.length == 0){
				reset(e);
			}
		};

		var popular_ciudades = function(id)
		{
			$.ajax({
				url: URL+'/service/ciudad/'+id,
				data: {},
				dataType: 'json',
				success: function(data)
				{
					var html = '<option value="">Seleccionar</option>';
					if(data.length > 0)
					{
						$.each(data, function(i, e){
							html += '<option value="'+e['Nombre_Ciudad']+'">'+e['Nombre_Ciudad']+'</option>';
						});
					}
					$('select[name="Nombre_Ciudad"]').html(html).val($('select[name="Nombre_Ciudad"]').data('value'));
				}
			});
		};

		var popular_modal_persona = function(persona)
		{
			$('select[name="Id_TipoDocumento"]').val(persona['Id_TipoDocumento']);
			$('input[name="Cedula"]').val($.trim(persona['Cedula']));
			$('input[name="Primer_Apellido"]').val($.trim(persona['Primer_Apellido']));
			$('input[name="Segundo_Apellido"]').val(persona['Segundo_Apellido']);
			$('input[name="Primer_Nombre"]').val($.trim(persona['Primer_Nombre']));
			$('input[name="Segundo_Nombre"]').val($.trim(persona['Segundo_Nombre']));
			$('input[name="Fecha_Nacimiento"]').val($.trim(persona['Fecha_Nacimiento']));
			$('select[name="Id_Etnia"]').val(persona['Id_Etnia']);
			$('select[name="Nombre_Ciudad"]').data('value', persona['Nombre_Ciudad']);
			$('select[name="Id_Pais"]').val(persona['Id_Pais']).trigger('change');
			$('input[name="Id_Persona"]').val(persona['Id_Persona']);

			$('input[name="Id_Genero"]').removeAttr('checked').parent('.btn').removeClass('active');
			$('input[name="Id_Genero"][value="'+persona['Id_Genero']+'"]').trigger('click');

			$('#modal_form_persona').modal('show');
		};

		var popular_errores_modal = function(data)
		{
			$('#form_persona .form-group').removeClass('has-error');
			var selector = '';
			for (var error in data){
			    if (typeof data[error] !== 'function') {
			        switch(error)
			        {
			        	case 'tipoDocumento':
			        	case 'Id_Etnia':
			        	case 'Id_Pais':
			        		selector = 'select';
			        	break;

			        	case 'Cedula':
			        	case 'Primer_Apellido':
			        	case 'Primer_Nombre':
			        	case 'Fecha_Nacimiento':
			        	case 'Id_Genero':
			        		selector = 'input';
			        	break;
			        }
			        $('#form_persona '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');
			    }
			}
		}

		//Eventos
		$('input[name="buscador"]').on('keyup', buscar);
		$('#buscar').on('click', function(e)
		{
			var role = $(this).data('role');
			switch(role)
			{
				case 'buscar':
					$(this).data('role', 'reset');
					buscar(e);
				break;

				case 'reset':
					$(this).data('role', 'buscar');
					reset(e);
				break;
			}
		});

		$('#crear').on('click', function(e)
		{
			var persona = {
				Id_TipoDocumento: '',
				Cedula: '',
				Primer_Apellido: '',
				Segundo_Apellido: '',
				Primer_Nombre: '',
				Segundo_Nombre: '',
				Fecha_Nacimiento: '',
				Id_Etnia: '',
				Id_Pais: 41,
				Nombre_Ciudad: '',
				Id_Persona: 0,
				Id_Genero: 0
			}

			popular_modal_persona(persona);
		});

		$('#personas').delegate('a[data-role="editar"]', 'click', function(e){
			var id = $(this).data('rel');
			$.get(
				URL+'/service/obtener/'+id,
				{},
				function(data)
				{	
					if(data)
					{
						popular_modal_persona(data);
					}
				},
				'json'
			);
		});

		$('#personas').delegate('a[data-role="remover"]', 'click', function(e){
			var id = $(this).data('rel');
		});

		$('select[name="Id_Pais"]').on('change', function(e){
			popular_ciudades($(this).val());
		});

		//Submit formulario único de personas
		$('#form_persona input[name="Cedula"]').on('blur', function(e){
			var key = $(this).val();
			$.get(
				URL+'/service/buscar/'+key,
				{}, 
				function(data)
				{
					if(data.length == 1)
					{
						popular_modal_persona(data[0]);
					}
				}
			);
		});

		$('#form_persona').on('submit', function(e){
			$.post(
				URL+'/service/procesar',
				$(this).serialize(),
				function(data){
					if(data.status == 'error')
					{
						popular_errores_modal(data.errors);
					} else {
						$('#alerta').show();
						$('#modal_form_persona').modal('hide');

						setTimeout(function(){
							$('#alerta').hide();
						}, 4000)
					}
				},
				'json'
			);

			e.preventDefault();
		});
	});
</script>