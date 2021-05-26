@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                @if(isset($shifts))
                  <h3 class="box-title">تعديل تصنيف</h3>
                  @else
                  <h3 class="box-title">اضافة تصنيف</h3>
                  @endif
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" @if(isset($shifts)) action="/dashboard/shifts/update/{{ $shifts->id }}"  @else id="saveShift" @endif >
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @csrf
                        <div class="alert alert-success" id="alert" style="display: none">
                        </div>

                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">اسم التصنيف</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="enter name" value="{{ isset($shifts)? old('name', $shifts->name) : old('name') }}">
                      @error('name')
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

                },
                messages: {
                    name: {required: 'هذا الحقل مطلوب'},

                },

                submitHandler: function (form) {
                    var shifts = new FormData();
                    shifts.append('_token', '{{ csrf_token() }}');
                    shifts.append('name', $('#name').val());

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
                            setTimeout(() => {
                                window.location="{{ url('dashboard/shifts') }}"
                            }, 3000);
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
