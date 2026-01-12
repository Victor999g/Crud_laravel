<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6fa63d5e18.js" crossorigin="anonymous"></script>
    <title>Curso</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <div>
        <h1 class="text-center p-2">Información del curso</h1>
    </div>
    <br />

    <div class="card m-3 p-3 shadow-sm">

        <button type="button"
            class="btn btn-primary position-absolute top-0 end-0 m-3"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            <i class="fa-solid fa-pen"></i>
            Actulizar
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualiza la información que creas necesaria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('update_curso_by_id', $curso->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="Input_titulo_curso" class="form-label">Título</label>
                                <input type="text"
                                    class="form-control"
                                    id="Input_titulo_curso"
                                    name="input_cursos_titulo"
                                    required
                                    value="{{ old('input_cursos_leccion', $curso->titulo) }}">
                            </div>
                            <div class="mb-3">
                                <label for="input_area_des_curso"
                                    class="form-label">Descripción</label>
                                <textarea
                                    class="form-control"
                                    id="input_area_des_curso"
                                    name="input_cursos_descripcion"
                                    rows="3"
                                    required>{{ old('input_cursos_descripcion', $curso->descripcion) }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <h5 class="fw-bold mb-2">Titulo:</h5>
        <p class="mb-3">{{ $curso->titulo }}</p>
        <h5 class="fw-bold mb-2">Descripción:</h5>
        <p style="white-space: pre-wrap;">{{ $curso->descripcion }}</p>
    </div>


    <div class="p-5">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                    id="pills-lecciones-curso-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-lecciones-curso"
                    type="button" role="tab"
                    aria-controls="pills-lecciones-curso"
                    aria-selected="false">Mis lecciones</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                    id="pills-estudiantes-curso-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-estudiantes-curso"
                    type="button"
                    role="tab"
                    aria-controls="pills-estudiantes-curso"
                    aria-selected="false">Suscripciones</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active"
                id="pills-lecciones-curso"
                role="tabpanel"
                aria-labelledby="pills-lecciones-curso-tab"
                tabindex="0">

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($curso->lecciones_hasMany as $ittem)
                            <tr>
                                <td>{{ $ittem->id }}</td>
                                <td>{{ $ittem->titulo }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('get_leccion_by_id', $ittem->id) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $ittem->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <div class="modal fade" id="deleteModal{{ $ittem->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    ¿Estás seguro de eliminar esta lección?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>

                                                    <form method="POST" action="{{ route('delete_leccion_by_id', $ittem->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            Sí, eliminar
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    No hay lecciones registradas
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="tab-pane fade"
                id="pills-estudiantes-curso"
                role="tabpanel"
                aria-labelledby="pills-estudiantes-curso-tab"
                tabindex="0">
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($curso->estudiantes_belongsToMany->count() > 0)
                            @foreach($curso->estudiantes_belongsToMany as $ittem)
                            <tr>
                                <td>{{ $ittem->pivot->id }}</td>
                                <td>{{ $ittem->nombre }}</td>
                                <td>{{ $ittem->correo }}</td>
                                <td>{{ $ittem->phone }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_estudiante_Modal{{ $ittem->pivot->id }}">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                    <div class="modal fade" id="delete_estudiante_Modal{{ $ittem->pivot->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    ¿Estás seguro de cancelarle la suscripción a <strong>{{ $ittem->nombre }}</strong> ?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>

                                                    <form method="POST" action="{{ route('delete_relacion_by_id',$ittem->pivot->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            Sí, eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center">No hay cursos registrados</td>
                            </tr>
                            @endif
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>



</body>

</html>