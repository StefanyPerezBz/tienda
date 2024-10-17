@extends('vendor.dashboard.layouts.master')

@section('content')
    <!--=============================
                DASHBOARD START
              ==============================-->
              <section id="wsus__dashboard">
                <div class="container-fluid">
                    @include('vendor.dashboard.layouts.siderbar')
            
                    <div class="row">
                        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                            <div class="dashboard_content mt-2 mt-md-0">
                                <h3><i class="far fa-user"></i> Perfil</h3>
                                <div class="wsus__dashboard_profile">
                                    <div class="wsus__dash_pro_area">
                                        <h4>Información Personal</h4>
            
                                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="wsus__dash_pro_img">
                                                        <img id="picture" src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/ts-2.jpg') }}"
                                                             alt="img" class="img-fluid w-100">
                                                        <input type="file" name="image" onchange="cambiarImagen(event)">
                                                    </div>
                                                </div>
            
                                                <div class="col-md-12 mt-5">
                                                    <div class="wsus__dash_pro_single mb-3">
                                                        <i class="fas fa-user-tie"></i>
                                                        <input type="text" placeholder="Nombre" name="name" value="{{ Auth::user()->name }}">
                                                        @error('name')
                                                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
            
                                                <div class="col-md-12">
                                                    <div class="wsus__dash_pro_single mb-3">
                                                        <i class="fal fa-envelope-open"></i>
                                                        <input type="email" placeholder="Correo electrónico" name="email" value="{{ Auth::user()->email }}">
                                                        @error('email')
                                                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
            
                                                <div class="col-xl-12">
                                                    <button class="common_btn mb-4 mt-2" type="submit">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
            
                                        <div class="wsus__dash_pass_change mt-2">
                                            <form action="{{ route('user.profile.update.password') }}" method="POST">
                                                @csrf
            
                                                <div class="row">
                                                    <h4>Cambiar contraseña</h4>
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="wsus__dash_pro_single mb-3">
                                                            <i class="fas fa-unlock-alt"></i>
                                                            <input type="password" placeholder="Contraseña actual" id="current_password" name="current_password">
                                                            @error('current_password')
                                                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
            
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="wsus__dash_pro_single mb-3">
                                                            <i class="fas fa-lock-alt"></i>
                                                            <input id="password" type="password" name="password" placeholder="Nueva Contraseña">
                                                            @error('password')
                                                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
            
                                                    <div class="col-xl-4">
                                                        <div class="wsus__dash_pro_single mb-3">
                                                            <i class="fas fa-lock-alt"></i>
                                                            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirmar contraseña">
                                                            @error('password_confirmation')
                                                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
            
                                                    <div class="col-xl-12">
                                                        <button class="common_btn" type="submit">Guardar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>            
    <!--=============================
                DASHBOARD START
    ==============================-->

    <!-- Script para cambiar la imagen seleccionada -->
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
