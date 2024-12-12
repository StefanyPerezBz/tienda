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
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear SubCategoría</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.subcategory.store') }}" method="POST" class="needs-validation"
                                novalidate="" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Categoría</label>
                                    <select class="form-control js-example-basic custom-select2" name="category"
                                        id="category" required>
                                        <option value="" disabled selected>Escoger categoría</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor escoja la categoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Ej. Ropa de hombre, Electrodomésticos .." required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre de la subcategoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="" disabled selected>Seleccionar estado</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el estado de la sibcategoría
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Crear</button>

                                    <a href="{{ route('admin.subcategory.index') }}" class="btn btn-primary">Regresar</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
