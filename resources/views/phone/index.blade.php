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
                            <a href="{{route('phones.create')}}" class="btn btn-primary">Создать контакт компании</a>
                <!-- <button class="btn btn-primary"></button> -->
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
                                                <th>Телефон</th>
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
                                                <th>Телефон</th>
                                                <th>Навание компании</th>
                                                <th>Дата создания</th>
                                                <th>Дата изменения</th>
                                                @if($privilages)
                                                <th>Действия</th>
                                                @endif
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($phones as $phone)
                                          <tr>
                                                <td>{{$phone->id}}</td>
                                                <td>{{$phone->phone}}</td>
                                                <td>
                                                   <a href="{{ route('firms.show', ['firm' => $phone->firm_id]) }}"
                                                       placeholder="Показать">
                                                       {{$phone->firm->name}}
                                                    </a>
                                                   </td>
                                                <td>{{$phone->created_at}}</td>
                                                <td>{{$phone->updated_at}}</td>
                                                @if($privilages)
                                                <td>
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                    <a href="{{ route('phones.show', ['phone' => $phone->id]) }}" placeholder="Создать">
                                                    <i class="fab fa-searchengin"></i>
                                                    </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <a href="{{ route('phones.edit', ['phone' => $phone->id]) }}" aria-placeholder="Изменить">
                                                    <i class="fas fa-pen-square"></i>
                                                    </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <!-- <a href="{{ route('phones.destroy', ['phone' => $phone->id]) }}" aria-placeholder="Удалить">
                                                        <i class="far fa-minus-square"></i>
                                                    </a> -->
                                                    <a id="{{$phone->id}}" href="#" aria-placeholder="Удалить" class="delete-phone">
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
                                    {{ $phones->links() }}
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

<script>
   $(document).ready( function () {
       
    $('#dataTable').DataTable(
        {
            "paging": false,
            "searching" : false,
            "order": [ 3, 'desc' ]
        }

    );

    function delete_phone(phone){

var token = $("meta[name='csrf-token']").attr("content");
let url = "{{route('phones.index')}}"+"/"+phone;
    
$.ajax({
    type: "POST",
    data:{
     _method:"DELETE",
     "_token": "{{ csrf_token() }}",
     "id": phone
    },
    url: url,
    success: function(response){
        alert('Контакт "'+response['phone']+ '" удалён из компании '+response['name'])
        document.location.reload();
    }
});
};

$('.delete-phone').click(function ()  {
    delete_phone($(this).attr('id'));
});  
} );
</script>