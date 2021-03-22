@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                @if(isset($user))
                  <h3 class="box-title">تعديل مستخدم</h3>
                  @else
                  <h3 class="box-title">اضافة مستخدم</h3>
                  @endif
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" @if(isset($user)) action="/dashboard/users/update/{{$user->id}}" @else action="/dashboard/users/save" @endif>
                @csrf
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">الاسم</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="الاسم" value="{{ isset($user)? old('name', $user->name) : old('name') }}">
                      @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">البريد الالكتروني</label>
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="البريد الالكتروني" value="{{ isset($user)? old('email', $user->email) : old('email') }}">
                      @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">كلمة المرور</label>
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="كلمة المرور" value="{{old('password')}}">
                      @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">الوردية</label>
                      <select name="shift_id" class="form-control @error('shift_id') is-invalid @enderror" id="shift_id" placeholder="choose">
                      <option value=""></option>
                        @foreach($shifts as $shift)
                        <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                        @endforeach
                      </select>
                      @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">اعادة كلمة المرور</label>
                      <input type="password" name="conf_password" class="form-control @error('conf_password') is-invalid @enderror" id="exampleInputPassword1" placeholder="اعادة كلمة المرور" value="{{old('conf_password')}}">
                      @error('conf_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                  </div>
                </form>
        </div>
    </div>
</section>

@endsection
