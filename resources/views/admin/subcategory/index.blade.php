@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>SubCategoría</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Listado de subcategorías</h4>
                            <a href="{{ route('admin.subcategory.create') }}" class="btn btn-primary"><i
                                    class="fas fa-plus"></i>
                                Crear subcategoría</a>
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

@push('css')
    <style>
        /* Altura ajustada para todos los selects */
        .custom-select2 .select2-selection--single {
            height: 45px;
            /* Altura deseada */
            display: flex;
            align-items: center;
        }

        /* Ancho completo del contenedor para select2 */
        .select2-container {
            width: 100% !important;
        }

        /* Ajuste de altura para dispositivos pequeños */
        @media (max-width: 768px) {
            .custom-select2 .select2-selection--single {
                height: 50px;
                /* Altura para dispositivos pequeños */
            }
        }
    </style>
@endpush

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            $('.js-example-basic').select2();
        });
    </script>
@endpush