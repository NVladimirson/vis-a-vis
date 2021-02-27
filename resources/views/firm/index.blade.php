@extends('layouts.main')
@section('content')
<div id="layoutSidenav_content">
   <main>
      <div class="container-fluid">
         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table mr-1"></i>
               DataTable Example
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
               <p>{{ $message }}</p>
            </div>
            @endif
            @if ($errors->any())
        <div class="alert alert-danger">
            <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <div class="card-body">
               <div class="row">
               @if($privilages)
                  <div class="col-xs-6 col-sm-6 col-md-6">
                     <a href="{{route('firms.create')}}" class="btn btn-primary">Создать компанию</a>
                  </div>
                  @endif
                  @if(!$privilages)
                  <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                     <!-- <a href="#" class="btn btn-primary"></a> -->
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                     <i class="fas fa-unlock" 
                        data-toggle="modal" data-target="#exampleModal"></i>
                     </button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Введите пароль</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form action="{{ route('toggle_crud') }}" method="POST" >
                                    @csrf
                              <div class="modal-body">
                                    <div class="row">
                                    </div>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-12 col-md-12">
                                          <div class="form-group">
                                             <input type="password" name="password" class="form-control" required placeholder="Пароль (12345)">
                                          </div>
                                       </div>
                                    </div>

                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                 <button type="submit" class="btn btn-primary">Применить</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  @else
                  <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                     <!-- <a href="#" class="btn btn-primary"></a> -->
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                     <i class="fas fa-lock" 
                        data-toggle="modal" data-target="#exampleModal"></i>
                     </button>
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Отключить редактирование</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form action="{{ route('toggle_crud') }}" method="POST" >
                                    @csrf
                              <input type="hidden" name="logout" value="true">
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                                 <button type="submit" class="btn btn-primary">Да</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
               </div>
               <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Навание компании</th>
                           <th>Дата создания</th>
                           <th>Дата изменения</th>
                           @if($privilages)
                           <th>Действия</th>
                           @endif
                        </tr>
                     </thead>
                     <tfoot>
                        <tr>
                           <th>ID</th>
                           <th>Навание компании</th>
                           <th>Дата создания</th>
                           <th>Дата изменения</th>
                           @if($privilages)
                           <th>Действия</th>
                           @endif
                        </tr>
                     </tfoot>
                     <tbody>
                        @foreach($firms as $firm)
                        <tr>
                           <td>{{$firm->id}}</td>
                           <td>{{$firm->name}}</td>
                           <td>{{$firm->created_at}}</td>
                           <td>{{$firm->updated_at}}</td>
                           @if($privilages)
                           <td>
                              <div class="row">
                                 <div class="col-md-4">
                                    <a href="{{ route('firms.show', ['firm' => $firm->id]) }}" placeholder="Показать">
                                    <i class="fab fa-searchengin"></i>
                                    </a>
                                 </div>
                                 <div class="col-md-4">
                                    <a href="{{ route('firms.edit', ['firm' => $firm->id]) }}" aria-placeholder="Изменить">
                                    <i class="fas fa-pen-square"></i>
                                    </a>
                                 </div>
                                 <div class="col-md-4">
                                    <a id="{{$firm->id}}" href="#" aria-placeholder="Удалить" class="delete-firm">
                                    Удалить
                                    </a>
                                 </div>
                              </div>
                           </td>
                           @endif
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <div>
                  <div class="row">
                     <div class="col-md-6">
                        {{ $firms->links() }}
                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                           <input class="form-control" type="text" placeholder="Введите '12345'"
                              aria-label="Search" aria-describedby="basic-addon2" />
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="button"><i class="fas fa-unlock"></i></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"></script>
<script>
   $(document).ready( function () {
       
    $('#dataTable').DataTable(
        {
            "paging": false,
            "searching" : false,
            "order": [ 3, 'desc' ]
        }
   
    );
   
    function delete_firm(firm){
   
    var token = $("meta[name='csrf-token']").attr("content");
    let url = "{{route('firms.index')}}"+"/"+firm;
        
    $.ajax({
        type: "POST",
        data:{
         _method:"DELETE",
         "_token": "{{ csrf_token() }}",
         "id": firm
        },
        url: url,
        success: function(response){
            alert('Компания '+response['name'] +' ( Телефоны: ' + response['phones'] +' )' + 'удалена.')
            document.location.reload();
        }
    });
    };
   
    $('.delete-firm').click(function ()  {
        delete_firm($(this).attr('id'));
   });     
   
   } );
</script>