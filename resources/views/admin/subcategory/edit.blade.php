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
                            <h4>Editar SubCategoría</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.subcategory.update', $subcategory->slug) }}" method="POST"
                                class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Categoría</label>
                                    <select class="form-control js-example-basic custom-select2" name="category"
                                        id="category" required>
                                        <option value="" disabled selected>Escoger categoría</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $subcategory->category_id ? 'selected': ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor escoja la categoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Ej. Ropa de hombre, Electrodomésticos .." required autofocus value="{{ $subcategory->name }}">
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre de la subcategoría
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active" {{ $subcategory->status == 'active' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="inactive" {{ $subcategory->status == 'inactive' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecciona el estado de la subcategoría</div>
                                </div>


                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Actualizar</button>

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
