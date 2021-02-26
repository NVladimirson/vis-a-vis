@extends('layouts.main')

@section('content')
<div id="layoutSidenav_content">
   <main>
       <div class="container-fluid">
   <div class="row">
        <div class="col-lg-12 margin-tb">
        <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('phones.index') }}" title="К списку"> <i class="fas fa-backward "></i> </a>
            </div>
            <div class="pull-left">
                <h2>Информация о контакте:</h2>
            </div>
        </div>
    </div>

        <div class="card mb-12">

                            <div class="card-header">
                                <svg class="svg-inline--fa fa-chart-area fa-w-16 mr-1" 
                                aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-area" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M500 384c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H12c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v308h436zM372.7 159.5L288 216l-85.3-113.7c-5.1-6.8-15.5-6.3-19.9 1L96 248v104h384l-89.9-187.8c-3.2-6.5-11.4-8.7-17.4-4.7z"></path></svg><!-- <i class="fas fa-chart-area mr-1"></i> Font Awesome fontawesome.com -->
                                Информация о контакте:
                             </div>
                            <div class="card-body">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID: {{$phone->id}}</strong>
                    <p></p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Телефон: {{$phone->phone}}</strong>
                    <p></p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Компания: {{$phone->firm->name}}</strong>
                    <p></p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Создан: {{$phone->created_at}}</strong>
                    <p></p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Изменен: {{$phone->updated_at}}</strong>
                    <p></p>
                </div>
            </div>
                            </div>
                            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
                        </div>



                        </div>
   </main>
</div>
@endsection