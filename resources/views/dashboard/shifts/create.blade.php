@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                @if(isset($user))
                  <h3 class="box-title">تعديل وردية</h3>
                  @else
                  <h3 class="box-title">اضافة وردية</h3>
                  @endif
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="saveShift" >
                @csrf
                        <div class="alert alert-success" id="alert" style="display: none">
                        </div>
                    
                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">اسم الوردية</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="enter name" value="{{ isset($user)? old('name', $user->name) : old('name') }}">
                      @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">ساعة بداية الدوام</label>
                      <input type="text" name="start_at" class="form-control @error('start_at') is-invalid @enderror" id="start_at" placeholder="enter start_at" value="{{ isset($user)? old('start_at', $user->email) : old('start_at') }}">
                      @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">ساعة نهاية الدوام</label>
                      <input type="text" name="end_at" class="form-control @error('end_at') is-invalid @enderror" id="end_at" placeholder="enter end_at" value="{{old('end_at')}}">
                      @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">ايام الدوام</label>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">السبت</label>
                      <input type="checkbox" name="saturday"  id="saturday" checked>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">الاحد</label>
                      <input type="checkbox" name="sunday"  id="sunday" checked>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">الاثنين</label>
                      <input type="checkbox" name="monday"  id="monday" checked>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">الثلاثاء</label>
                      <input type="checkbox" name="tuesday"  id="tuesday" checked>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">الاربعاء</label>
                      <input type="checkbox" name="wednesday"  id="wednesday" checked>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">الخميس</label>
                      <input type="checkbox" name="thursday"  id="thursday" checked>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">الجمعة</label>
                      <input type="checkbox" name="friday"  id="friday" >
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

@push('jquery')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function(){
            $.validator.setDefaults({
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlightL: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'error-block',
                errorPlacement: function (error, element) {
                    if(element.parent('.input-group').lenght) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#saveShift').validate({
                rules: {
                    name: {required: true},
                    start_at: {required: true},
                    end_at: {required: true}
                },
                messages: {
                    name: {required: 'هذا الحقل مطلوب'},
                    start_at: {required: 'هذا الحقل مطلوب'},
                    end_ar: {required: 'هذا الحفل مطلوب'},
                },

                submitHandler: function (form) {
                    var shifts = new FormData();
                    shifts.append('_token', '{{ csrf_token() }}');
                    shifts.append('name', $('#name').val());
                    shifts.append('start_at', $('#start_at').val());
                    shifts.append('end_at', $('#end_at').val());

                    shifts.append('saturday', $('#saturday').is(':checked') ? 1 : 0);
                    shifts.append('sunday', $('#sunday').is(':checked') ? 1 : 0);
                    shifts.append('monday', $('#monday').is(':checked') ? 1 : 0);
                    shifts.append('tuesday', $('#tuesday').is(':checked') ? 1 : 0);
                    shifts.append('wednesday', $('#wednesday').is(':checked') ? 1 : 0);
                    shifts.append('thursday', $('#thursday').is(':checked') ? 1 : 0);
                    shifts.append('friday', $('#friday').is(':checked') ? 1 : 0);

                    $('input').attr('disabled', 'disabled');
                    $('button').attr('disabled', 'disabled');

                    $.ajax({ 
                        url: "{{ url('dashboard/shifts/save') }}", 
                        type: 'POST',
                        dataType: 'json',
                        data: shifts,
                        async: false,
                        cache: false,

                        success: function (response) {
                            $('input').removeAttr('disabled');
                            $('button').removeAttr('disabled');
                            $('#alert').show();
                            $('#alert').html(response.message);
                            $('#alert').fadeOut(10000);

                            $('#name').val('');
                        },
                        error: function (response) {
                            $('input').removeAttr('disabled');
                            $('button').removeAttr('disabled');
                            $('#faild_send').show();
                            $('#faild_send').fadeOut(10000);
                        },
                        contentType: false,
                        processData: false,
                    });
                }
            });
        });
    </script>
@endpush