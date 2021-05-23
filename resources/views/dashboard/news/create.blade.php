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

                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                  </div>
                </form>
        </div>
    </div>
</section>

@endsection
