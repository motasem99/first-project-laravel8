@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">عرض المستخدمين</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                @csrf
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>اسم الموظف</th>
                        <th>البريد الالكتروني</th>
                        <th>تاريخ التفعيل</th>
                        <th>عمليات</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>
                        <a href="{{ url('dashboard/users/delete/'.$user->id) }}"><i class="fa fa-fw fa-times-circle" style="font-size: 23px; color: red"></i></a>
                        <a href="{{ url('dashboard/users/'.$user->id.'/edit') }}"><i class="fa fa-fw fa-edit" style="font-size: 23px; color: green"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>

                  </table>
                </div><!-- /.box-body -->
        </div>
    </div>
</section>

@endsection
