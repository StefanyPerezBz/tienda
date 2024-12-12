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
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.store') }}" method="POST" class="needs-validation"
                                novalidate="" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Visualizar</label>
                                    <br>
                                    <img id="picture" width="200" src="{{ asset('default/image.jpg') }}"
                                        alt="">
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" name="banner"
                                        onchange="cambiarImagen(event)" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor escoja la imagen
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Tipo</label>
                                    <input type="text" class="form-control" name="type" value="{{ old('type') }}"
                                        placeholder="Ej. Edición Exclusiva, Promoción de Temporada, Últimos Lanzamientos .." required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el tipo de slider
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                        placeholder="Ej.Tendencias que Marcan Estilo, Descubre Descuentos Irresistibles .." required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el título del slider
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Precio inicial</label>
                                    <input type="number" class="form-control" name="starting_price"
                                        value="{{ old('starting_price') }}" min="1" 
                                        step="0.01" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese un precio inicial válido. Solo se permiten números con hasta dos decimales.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>
                                        URL del botón</label>
                                    <input type="text" class="form-control" name="btn_url" value="{{ old('btn_url') }}"
                                        placeholder="Dirección web (enlace)" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese la URL
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Serie</label>
                                    <input type="number" class="form-control" name="serial" value="{{ old('serial') }}"
                                        placeholder="Orden en que se muestra el slider (1,2 ..)" min="1" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese la serie del slider
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
                                        Por favor ingrese el estado del slider
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Crear</button>

                                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary">Regresar</a>
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
