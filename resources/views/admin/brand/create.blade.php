@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Marca</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear Marca</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.brand.store') }}" method="POST" class="needs-validation"
                                novalidate="" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Visualizar</label>
                                    <br>
                                    <img id="picture" width="200" src="{{ asset('default/image.jpg') }}"
                                        alt="">
                                </div>

                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="logo"
                                        onchange="cambiarImagen(event)" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor escoja la imagen
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Ej. Amazon, eBay .." required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre de la marca
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_featured">Destacar marca</label>
                                    <select id="is_featured" class="form-control" name="is_featured" required>
                                        <option value="" disabled selected>Seleccionar si se destaca</option>
                                        <option value="yes" {{ old('is_featured') == 'yes' ? 'selected' : '' }}>Si
                                        </option>
                                        <option value="no" {{ old('is_featured') == 'no' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor ingrese para destacar la marca
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
                                        Por favor ingrese el estado de la marca
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Crear</button>

                                    <a href="{{ route('admin.brand.index') }}" class="btn btn-primary">Regresar</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        // Cambiar la imagen
        document.getElementById("image").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
