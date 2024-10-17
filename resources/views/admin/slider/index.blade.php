@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
  <div class="section-header">
    <h1>Slider</h1>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Listado de sliders</h4>
            <a href="{{route('admin.slider.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Crear slider</a>
          </div>
          <div class="table-responsive card-body">
            {{ $dataTable->table() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush