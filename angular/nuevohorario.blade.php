@extends('layouts.horario')

@section('title','Añadir Horario')


@section('content')

<h1 class="page-header">Añadir Horario</h1>


<ul class="nav nav-tabs" role="tablist">
    
    <li role="presentation" class="active"><a href="#dia" aria-controls="dia" role="tab" data-toggle="tab">Por día</a></li>
    <li role="presentation"><a href="#semestral" aria-controls="semestral" role="tab" data-toggle="tab">Semestral</a></li>
    <li role="presentation"><a href="#periodo" aria-controls="periodo" role="tab" data-toggle="tab">Por Periodo</a></li>
    
</ul>

  <!-- Tab panes -->
  <style type="text/css">
   .tab-content td {
    text-align:center; 
    vertical-align:middle;
}
     </style>
<div class="tab-content" ng-app="app" >
    <div role="tabpanel" class="tab-pane active" id="dia" ng-controller="myCtrl">
    <br>       
    {!! Form::open(['route' => ['apoyo.storepeticionone',$apoyo],'method' => 'POST']) !!}
        {!! Form::hidden('tipo', 'diario') !!}
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {!!FORM::label('fechai','Fecha: ')!!}
                    {!!FORM::date('fechai',\Carbon\Carbon::now(),['class'=>'form-control','required']) !!}
                </div>
                <div class="form-group">
                    
                    <label> {!! Form::checkbox('amplificacion', 1, 0, ['class' => 'field']) !!} Parlantes</label>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!!FORM::label('implemento','Implemento : ')!!}
                    {!!FORM::select('implemento',[null=>'Seleccione un Implemento',0=>'Ninguno',1=>'Conexión VGA + Control',2=>'Conexión HDMI + Control',3=>'Conexión VGA + HDMI + Control',4=>'Solo Control'],null,['class'=>'form-control','required']) !!}
                </div>
                
                <div class="form-group">
                    <p>Tipo de Horario </p>
                    <label class="radio-inline"> {!! Form::radio('personalizado', 'true', true ,['ng-model'=>'bloque']) !!} Bloques</label>
                    
                    <label class="radio-inline"> {!! Form::radio('personalizado', 'false', false,['ng-model'=>'bloque']) !!} Personalizado</label> 
                </div>
                
            </div>
        
        
        
        
        <div class="col-md-7">
        
            <div ng-show="bloque == 'true'">
            <label>Seleccione bloques correspondientes</label>
            <div class="row" >
                <div class="col-md-4">
                    <table class="table table-bordered table-position" >
                        <tr>
                            <td></td>
                            <td>Día</td>
                        </tr>
                        <tr ng-repeat="i in bloques">
                            <td class="col-md-8">@{{ i }}</td>
                            <td ng-repeat="e in [1]" ng-click="selectPosition($parent.$index,$index)"
                                ng-class="{active: (selectedPosition($parent.$index,$index) )}">
                                
                                
                                
                            </td>
                        </tr>
                    </table>
                </div>
            
        
                <div class="col-md-8" ng-repeat="f in todo">
                <div class="panel panel-info">
                          <div class="panel-heading">
                            <h3 class="panel-title"> Seleccionar Sala para @{{ bloques[f[0]]}}</h3>
                          </div>
                          <div class="panel-body">
                                <div class="col-md-4">
                                
                                {!!FORM::select('bloques[@{{f[2]}}][@{{bloques[f[0]]}}]', [null=>'Seleccione una sala']+$selectedSalas[0],null,['class'=>'form-control','required','ng-model'=>'sala']) !!}
                               
                                </div>  
                              
                            <div class="col-md-8">
                            <strong>Sala: </strong> @{{identificacion[sala]}}
                            <br>
                            <strong>Tipo: </strong> @{{tipo[sala]}}
                            <br>
                            <strong>Tipo de Silla: </strong> @{{silla[sala]}}
                            <br>
                
                            <strong>Capacidad:</strong> @{{capacidad[sala]}}
                
                            <br>
                            <strong>Implementos:</strong> @{{implementos[sala]}}
                            
                            
                            <br> 
                            </div>
                          </div>
                </div>
                </div>
            </div>
        </div> 
    
        
        <div class="row" ng-show="bloque == 'false'">
            <div class="row"> <div class="col-md-12">{!!FORM::label('otro','Debe cumplir con el formato: HH:MM-HH:MM Ejemplo: 07:50-20:00 ')!!}</div></div>
            <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    
                    {!!FORM::text('otro[1]',null,['class'=>'form-control','placeholder'=>'07:50-20:00']) !!}
                </div>
            </div>
            
            <div class="col-md-8">
            
                <div class="row" ng-repeat="h in seleccionado(bloque)" >
                    
                    <div class="panel panel-info">
                              <div class="panel-heading">
                                <h3 class="panel-title"> Seleccionar Sala </h3>
                                
                              </div>
                              <div class="panel-body">
                                    <div class="col-md-4">
                                    
                                    {!!FORM::select('otro[2]', [null=>'']+$selectedSalas[0] ,null,['class'=>'form-control','required' ,'ng-model'=>'sala']) !!}
                                   
                                    </div>  
                                  
                                <div class="col-md-8">
                                <strong>Sala: </strong> @{{identificacion[sala]}}
                                <br>
                                <strong>Tipo: </strong> @{{tipo[sala]}}
                                <br>
                                <strong>Tipo de Silla: </strong> @{{silla[sala]}}
                                <br>
                    
                                <strong>Capacidad:</strong> @{{capacidad[sala]}}
                    
                                <br>
                                <strong>Implementos:</strong> @{{implementos[sala]}}
                                
                                
                                <br> 
                                </div>
                              </div>
                    </div>
                    
                </div>
            </div>
            </div>
            
        </div>
    </div>
</div>
        <div class="form-group pull-right">
             <a href="{{route('apoyo.show',$apoyo->id)}}"><button type="button" class="btn btn-default" >volver</button></a>

            {!! Form::submit('Ingresar',['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    
    </div>
    <div role="tabpanel" class="tab-pane" id="semestral" ng-controller="myCtrl"> 
        {!! Form::open(['route' => ['apoyo.storepeticionone',$apoyo],'method' => 'POST']) !!}
           {!! FORM::hidden('tipo', 'semestral') !!}
        <br>
        <div class="row"><div class="col-md-3">
            <div class="form-group">
            {!!FORM::label('implemento','Implemento : ')!!}
            {!!FORM::select('implemento',[null=>'Seleccione un Implemento',0=>'Ninguno',1=>'Conexión VGA + Control',2=>'Conexión HDMI + Control',3=>'Conexión VGA + HDMI + Control',4=>'Solo Control'],null,['class'=>'form-control','required']) !!}
        </div>
            
            
        </div></div>
        
        <div class="form-group">
            {!!FORM::label('amplificacion','Parlantes : ')!!}
            {!! Form::checkbox('amplificacion', 1, null, ['class' => 'field']) !!}
        </div>  
          <div class="form-group">
                    <p>Tipo de Horario </p>
                    <label class="radio-inline"> {!! Form::radio('personalizado', 'true', true ,['ng-model'=>'bloque1']) !!} Bloques</label>
                    
                    <label class="radio-inline"> {!! Form::radio('personalizado', 'false', false,['ng-model'=>'bloque1']) !!} Personalizado</label> 
                </div>
        <div ng-show="bloque1 == 'true'">        
       <label >Seleccione bloques correspondientes</label>
        <div class="row" >
            <div class="col-md-9">
                <table class="table table-bordered table-position" >
                    <tr>
                        <td></td>
                        <td ng-repeat="e in semana"> @{{ e }}</td>
                    </tr>
                    <tr ng-repeat="i in bloques">
                        <td class="col-md-3">@{{ i }}</td>
                        <td ng-repeat="e in [1,2,3,4,5,6]"  ng-click="selectPosition($parent.$index,$index)"
                            ng-class="{active: (selectedPosition($parent.$index,$index) )}"></td>
                    </tr>
                </table>
               </div>
        </div>
        
         <div class="row" ng-repeat="f in todo" >
                <div class="col-md-9">
                <div class="panel panel-info">
                          <div class="panel-heading">
                            <h3 class="panel-title"> Seleccionar Sala para @{{semana[f[2]]}} @{{ bloques[f[0]]}}</h3>
                          </div>
                          <div class="panel-body">
                                <div class="col-md-4">
                                
                                {!!FORM::select('bloques[@{{f[2]}}][@{{bloques[f[0]]}}]', [null=>'Seleccione una sala']+$selectedSalas[0] ,null,['class'=>'form-control','ng-model'=>'sala']) !!}
                               
                                </div>  
                              
                            <div class="col-md-8">
                            <strong>Sala: </strong> @{{identificacion[sala]}}
                            <br>
                            <strong>Tipo: </strong> @{{tipo[sala]}}
                            <br>
                            <strong>Tipo de Silla: </strong> @{{silla[sala]}}
                            <br>
                
                            <strong>Capacidad:</strong> @{{capacidad[sala]}}
                
                            <br>
                            <strong>Implementos:</strong> @{{implementos[sala]}}
                            
                            
                            <br> 
                            </div>
                          </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row" ng-show="bloque1 == 'false'">
            <div class="row"> <div class="col-md-12">{!!FORM::label('otro','Debe cumplir con el formato: HH:MM-HH:MM Ejemplo: 07:50-20:00 ')!!}</div></div>
            
            <div class="row">
                <div class="form-group">
                
            {!!FORM::label('dia','Día : ')!!}
            {!!FORM::select('bloques2',[null=>'Seleccione día',0=>'Lunes',1=>'Martes',2=>'Miercoles',3=>'Jueves',4=>'Viernes'],null,['class'=>'form-control', 'ng-model'=>'dia']) !!}
            
                </div>
            <div class="col-md-3">
                <div class="form-group">
                    
                    {!!FORM::text('horari',null,['class'=>'form-control','placeholder'=>'07:50-20:00','ng-model'=>'horario']) !!}
                </div>
            </div>
            
            <div class="col-md-8">
            
                <div class="row" ng-repeat="h in seleccionado(bloque)" >
                    
                    <div class="panel panel-info">
                              <div class="panel-heading">
                                <h3 class="panel-title"> Seleccionar Sala </h3>
                                
                              </div>
                              <div class="panel-body">
                                    <div class="col-md-4">
                                    
                                    {!!FORM::select('bloques2[@{{dia}}][@{{horario}}]', [null=>'']+$selectedSalas[0] ,null,['class'=>'form-control' ,'ng-model'=>'sala']) !!}
                                   
                                    </div>  
                                  
                                <div class="col-md-8">
                                <strong>Sala: </strong> @{{identificacion[sala]}}
                                <br>
                                <strong>Tipo: </strong> @{{tipo[sala]}}
                                <br>
                                <strong>Tipo de Silla: </strong> @{{silla[sala]}}
                                <br>
                    
                                <strong>Capacidad:</strong> @{{capacidad[sala]}}
                    
                                <br>
                                <strong>Implementos:</strong> @{{implementos[sala]}}
                                
                                
                                <br> 
                                </div>
                              </div>
                    </div>
                    
                </div>
            </div>
            </div>
        </div>                

        <div class="form-group pull-right">
             <a href="{{route('apoyo.show',$apoyo->id)}}"><button type="button" class="btn btn-default" >volver</button></a>

            {!! Form::submit('Ingresar',['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    
    </div>
    <div role="tabpanel" class="tab-pane" id="periodo" ng-controller="myCtrl"> 
    <br>   
    
        {!! Form::open(['route' => ['apoyo.storepeticionone',$apoyo],'method' => 'POST']) !!}
           {!! FORM::hidden('tipo', 'periodo') !!}
           <div class="row">
               <div class="col-md-4">
                    <div class="form-group" >
                        {!!FORM::label('fechai','Fecha Inicio: ')!!}
                        
                        {!!FORM::date('fechai', \Carbon\Carbon::now(),['id'=>'fechai','class'=>'form-control','placeholder'=>'dd-mm-aaaa','required','ng-model'=>'fechai']) !!}
                    </div>
                    <div ng-show="(fechai | date:'EEEE') != 'Monday'">
                        <div class="alert alert-danger"  role="alert"> El Día de la fecha inicial debe ser <strong>Lunes</strong> </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!!FORM::label('fechat','Fecha Termino: ')!!}
                        {!!FORM::date('fechat', \Carbon\Carbon::now(),['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!!FORM::label('amplificacion','Parlantes : ')!!}
                        {!! Form::checkbox('amplificacion', 1, null, ['class' => 'field']) !!}
                    </div>  
                    <div class="form-group">
                        {!!FORM::label('implemento','Implemento : ')!!}
                        {!!FORM::select('implemento',[null=>'Seleccione un Implemento',0=>'Ninguno',1=>'Conexión VGA + Control',2=>'Conexión HDMI + Control',3=>'Conexión VGA + HDMI + Control',4=>'Solo Control'],null,['class'=>'form-control','required']) !!}
                    </div>
           
               </div>  
               <br>
                <div class="col-md-4 bg-info">
                    <h4>Restricciones de fecha por periodo</h4>
                    <ul >
                        
                        <li> Se debe ingresar como fecha de <strong>inicio el día lunes de la semana correspondiente. </strong></li>
                    </ul>
                    
               </div> 
           </div>  


        
       <label >Seleccione bloques correspondientes</label>
        <div class="row" >
            <div class="col-md-9">
                <table class="table table-bordered table-position" >
                    <tr>
                        <td></td>
                        <td ng-repeat="e in ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado']"> @{{ e }}</td>
                    </tr>
                    <tr ng-repeat="i in bloques">
                        <td class="col-md-3">@{{ i }}</td>
                        <td ng-repeat="e in [1,2,3,4,5,6]"  ng-click="selectPosition($parent.$index,$index)"
                            ng-class="{active: (selectedPosition($parent.$index,$index) )}"></td>
                            
                    </tr>
                </table>
               </div>
        </div>
        
        <div class="row" ng-repeat="f in todo" >
                <div class="col-md-9">
                <div class="panel panel-info">
                          <div class="panel-heading">
                            <h3 class="panel-title"> Seleccionar Sala para @{{semana[f[2]]}} @{{ bloques[f[0]]}}</h3>
                          </div>
                          <div class="panel-body">
                                <div class="col-md-4">
                                
                                {!!FORM::select('bloques[@{{f[2]}}][@{{bloques[f[0]]}}]',[null=>'Seleccione una sala']+$selectedSalas[0] ,null,['class'=>'form-control','required','ng-model'=>'sala']) !!}
                               
                                </div>  
                              
                            <div class="col-md-8">
                            <strong>Sala: </strong> @{{identificacion[sala]}}
                            <br>
                            <strong>Tipo: </strong> @{{tipo[sala]}}
                            <br>
                            <strong>Tipo de Silla: </strong> @{{silla[sala]}}
                            <br>
                
                            <strong>Capacidad:</strong> @{{capacidad[sala]}}
                
                            <br>
                            <strong>Implementos:</strong> @{{implementos[sala]}}
                            
                            
                            <br> 
                            </div>
                          </div>
                </div>
                </div>
            </div>  
        
        
        
        

        <div class="form-group pull-right">
             <a href="{{route('apoyo.show',$apoyo->id)}}"><button type="button" class="btn btn-default" >volver</button></a>

            {!! Form::submit('Ingresar',['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    @{{sala}}
    </div>
    

</div>

@endsection
