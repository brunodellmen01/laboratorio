@extends('layouts.app')

@section('content')
<title>Agenda</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Agenda {{Auth::user()->filial->name}}
                    <a data-toggle="modal" href="#myModalAgenda" class="pull-right">NOVO AGENDAMENTO</a>
                </div>
                <div class="panel-body">

<div class="table-responsive">
                        <div id='calendar'></div>
                    </div>
                </div>

                  
                  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.js'></script>
                  <script src="{{asset('calendar/pt-br.js')}}"></script>
                    <script>
                        $(document).ready(function() {
                            // page is now ready, initialize the calendar...
                            $('#calendar').fullCalendar({

                              header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                              },
                                // put your options and callbacks here
                                events : [
                                    @foreach($tasks as $task){
                                        title : '{{ $task->patient->name }}',
                                        id: '{{$task->id }}',
                                        task: '{{$task->name}}',
                                        start : '{{ $task->task_date }}',
                                        description: '{{$task->description}}',
                                        id_unity: '{{$task->filial->name}}',
                                        url :   '#',
                                    },
                                    @endforeach
                            ],

                          eventClick: function(calEvent, jsEvent, view) {
                            var id = calEvent.id;
                            var title = calEvent.title;
                            //var compromisso = calEvent.compromisso;
                            var task = calEvent.task;
                            var start = calEvent.start;
                            var description = calEvent.description;
                            var id_unity = calEvent.id_unity;

                            document.getElementById("id").innerHTML =id;
                            document.getElementById("title").innerHTML =title;
                            //document.getElementById("compromisso").innerHTML =compromisso;
                            document.getElementById("task").innerHTML =task;
                            document.getElementById("start").innerHTML =start;
                            document.getElementById("description").innerHTML =description;
                            document.getElementById("id_unity").innerHTML =id_unity;

                            $("input[name='id']").val(id);

                            $("input[name='name']").val(task);

                            $("input[name='patient_id']").val(title);

                            $("input[name='task_date']").val(start);

                            $("input[name='description']").val(description);

                            $("input[name='id_unity']").val(id_unity);

                            $("#myModalCompromisso").modal();
                            //alert('Compromisso: ' + calEvent.title);

                                    // change the border color just for fun
                      $(this).css('border-color', 'red');
                }
                        })
                    });
                </script>
                

            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="myModalAgenda" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Novo Agendamento</h4>
      </div>
      <div class="modal-body">
        <p>
            
            {!! Form::open(['url' => 'agenda/salvar', 'method' => 'post']) !!}
              {{ csrf_field() }}

              <br />
              <div class="form-group has-feedback">
                <input type="text" name="name" class="form-control form-group has-error has-feedback" placeholder="TITULO" />
                <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
              </div>
              <br /><br />
              <div class="form-group has-feedback">
                <select class="form-control form-group has-error has-feedback" name="patient_id">
                  <option >SELECIONE O PACIENTE</option>
                      @foreach($pacientes as $paciente)
                          <option value="{{$paciente->id}}">{{$paciente->name}}</option>
                      @endforeach
                </select>
                <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
              </div>
              <br /><br />
              <div class="form-group has-feedback">
                <input type="date" name="task_date form-group has-error has-feedback" class="form-control" placeholder="DATA" />
                <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
              </div>
              <br /><br />
              <div class="form-group has-feedback">
                <textarea name="description form-group has-error has-feedback"  class="form-control" placeholder="DESCRIÇÃO" required=""></textarea>
                <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
              </div>
              <br><br>
              OBS: Os campos com os icones <strong class="text-warning">*</strong> são de preencimento obrigatório.

        </p>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-default">AGENDAR</button>
        </form>
      </div>
    </div>

  </div>
</div>




<!-- Modal -->
<div id="myModalCompromisso" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Compromisso - <label id="start"></label> - <label id="id"></label></h4>
      </div>
      <div class="modal-body">
        
         <p class="text-left">
           Paciente: <label id="title"></label><br>
           Exame: <label id="task"></label><br>
           Observações: <label id="description"></label><br>
           Unidade: <label id="id_unity"></label>
         </p>

        
         <hr>
         {!! Form::model($task, ['url' => 'agenda/'.$task->id.'/editar', 'method' => 'PATCH']) !!}
         <div class="row">
           <div class="col-md-12">
            {!! Form::input('hidden', 'id_unity', Auth::user()->id_unity, ['class' => 'form-control'])!!}
            <input type="hidden" name="id" value="">
             <input type="text" name="name" class="form-control" placeholder="TITULO" />
           </div>

           <div class="col-md-6">
             <br>
             <select class="form-control " name="patient_id">
               
                <option >SELECIONE O PACIENTE</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{$paciente->id}}">{{$paciente->name}}</option>
                    @endforeach
              </select>
           </div>

           <div class="col-md-6">
              <br>
              <input type="date" name="task_date" class="form-control" placeholder="DATA" />
           </div>

           <div class="col-md-12">
              <br>
              <textarea name="description"  class="form-control" placeholder="OBSERVAÇÃO"></textarea>
           </div>


           

           <div class="col-md-6">
             <br>
             {!! Form::submit('EDITAR', ['class' => 'btn btn-outline btn-info pull-right'])!!}
           </div>

           {!! Form::close() !!}

           <div class="col-md-6">
             <br>
             {!! Form::model($task, ['url' => 'agenda/'.$task->id.'/excluir', 'method' => 'post']) !!}
                  {!! Form::submit('EXCLUIR', ['class' => 'btn btn-outline btn-danger pull-left'])!!}
             {!! Form::close() !!}
           </div>

         </div>
         
          
          
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>




@endsection