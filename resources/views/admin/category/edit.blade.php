@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Categoría</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Editar Categoría</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->slug) }}" method="POST"
                                class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Ícono</label>
                                    <div>
                                        <button class="btn btn-primary" data-iconset="fontawesome5"
                                            data-icon="{{ $category->icon }}" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" role="iconpicker" name="icon"
                                            data-search-text="Buscar icono...">
                                        </button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el ícono de la categoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Ej. Moda, Electrónica.." required autofocus value="{{ $category->name }}">
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre de la categoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecciona el estado de la categoría</div>
                                </div>


                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Actualizar</button>

                                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Regresar</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
