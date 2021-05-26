@extends('layouts.app')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">اضافة خبر</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="saveShift" >
                @csrf
                    <div class="alert alert-success" id="alert" style="display: none">
                    </div>
                  <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الخبر</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="enter name" value="{{ isset($user)? old('name', $user->name) : old('name') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">تفاصيل الخبر</label>
                    <input type="text" name="description" class="form-control @error('name') is-invalid @enderror" id="description" placeholder="enter name" value="{{ isset($user)? old('description', $user->description) : old('description') }}">
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">التصنيف</label>
                      <select name="shift_id" class="form-control @error('shift_id') is-invalid @enderror" id="shift_id" placeholder="choose" >
                      <option value=""></option>
                        @foreach($shifts as $shift)
                        <option value="{{ $shift->id }}" @if(isset($user) && $user->shift_id==$shift->id) selected @endif>{{ $shift->name }}</option>
                        @endforeach
                      </select>
                      @error('shift_id')
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
