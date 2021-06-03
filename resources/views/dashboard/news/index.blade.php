@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">عرض الاخبار</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                @csrf
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; ">

                    @foreach($news as $new)
                    <div style="margin: 1rem 1rem; padding: 1rem 3rem; background-color: #88caf1; border-radius: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h2>{{ $new->name }}</h2>
                            <p style="font-size: 18px;">{{ $new->shift->name }}</p>
                        </div>
                        <div style="padding: .5rem; font-size: 18px;">
                            <p>{{ $new->description }}</p>
                        </div>
                        <div style="padding: .5rem; font-size: 11px;">
                            <p>{{ $new->created_at }}</p>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: .5rem;">
                        <a  href="{{ url('dashboard/news/delete/'.$new->id) }}"><i class="fa fa-fw fa-times-circle" style="font-size: 23px; color: red"></i></a>
                        <a href="{{ url('dashboard/news/'.$new->id.'/edit') }}"><i class="fa fa-fw fa-edit" style="font-size: 23px; color: green"></i></a>
                        </div>
                    </div>
                    @endforeach

                </div>
        </div>
    </div>
</section>

@endsection

@push('java_script')
    <script src="{{url('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('assets')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>

@endpush

@push('jquery')
  <!-- page script -->
  <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
@endpush
