@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Sub SubCategoría</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Editar Sub SubCategoría</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.childcategory.update', $childcategory->id) }}" method="POST"
                                class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Categoría</label>
                                    <select class="form-control main-category" name="category" id="category" required>
                                        <option value="" disabled selected>Escoger categoría</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $childcategory->category_id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor escoja la categoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Sub Categoría</label>
                                    <select id="subcategory" class="form-control subcategory" name="subcategory">
                                        <option value="" disabled selected>Escoger subcategoría</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option
                                                {{ $subcategory->id == $childcategory->sub_category_id ? 'selected' : '' }}
                                                value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>

                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor escoja la subcategoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Ej. Vestidos, Accesorios para teléfonos .." required autofocus
                                        value="{{ $childcategory->name }}">
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre de la categoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active" {{ $childcategory->status == 'active' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="inactive" {{ $childcategory->status == 'inactive' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecciona el estado de la sub subcategoría</div>
                                </div>


                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Actualizar</button>

                                    <a href="{{ route('admin.childcategory.index') }}" class="btn btn-primary">Regresar</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.subcategory').html(
                            '<option value="" disabled selected>Escoger subcategoría</option>'
                            )

                        $.each(data, function(i, item) {
                            $('.subcategory').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
