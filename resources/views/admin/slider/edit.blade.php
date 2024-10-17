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
                            <h4>Editar Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Visualizar</label>
                                    <br>
                                    <img id="picture" width="200" src="{{ asset($slider->banner) }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" name="banner"
                                        onchange="cambiarImagen(event)">
                                </div>

                                <div class="form-group">
                                    <label>Tipo</label>
                                    <input type="text" class="form-control" name="type" value="{{ $slider->type }}">
                                </div>
                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                                </div>
                                <div class="form-group">
                                    <label>Precio inicial</label>
                                    <input type="text" class="form-control" name="starting_price"
                                        value="{{ $slider->starting_price }}">
                                </div>
                                <div class="form-group">
                                    <label> URL del botón</label>
                                    <input type="text" class="form-control" name="btn_url"
                                        value="{{ $slider->btn_url }}">
                                </div>
                                <div class="form-group">
                                    <label>Serie</label>
                                    <input type="text" class="form-control" name="serial" value="{{ $slider->serial }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Estado</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $slider->status == 1 ? 'selected' : '' }} value="1">Activo</option>
                                        <option {{ $slider->status == 0 ? 'selected' : '' }} value="0">Inactivo
                                        </option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Actualizar</button>

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
