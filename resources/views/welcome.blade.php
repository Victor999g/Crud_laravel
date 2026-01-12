<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6fa63d5e18.js" crossorigin="anonymous"></script>
    <title>Cursos_CRUD</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <div>
        <h1 class="text-center p-3">Crud de cursos</h1>
    </div>

    <div class="p-5">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                    id="pills-cursos-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-cursos"
                    type="button"
                    role="tab"
                    aria-controls="pills-cursos"
                    aria-selected="true">Cursos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                    id="pills-lecciones-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-lecciones"
                    type="button" role="tab"
                    aria-controls="pills-lecciones"
                    aria-selected="false">Lecciones</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                    id="pills-estudiantes-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-estudiantes"
                    type="button"
                    role="tab"
                    aria-controls="pills-estudiantes"
                    aria-selected="false">Estudiantes</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active"
                id="pills-cursos"
                role="tabpanel"
                aria-labelledby="pills-cursos-tab"
                tabindex="0">

                <div>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-plus"></i>
                        Crear curso
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Llena los datos del formulario</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="{{ route('create_curso') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="Input_titulo_curso" class="form-label">Título</label>
                                            <input type="text"
                                                class="form-control"
                                                id="Input_titulo_curso"
                                                name="input_cursos_titulo"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_area_des_curso"
                                                class="form-label">Descripción</label>
                                            <textarea
                                                class="form-control"
                                                id="input_area_des_curso"
                                                name="input_cursos_descripcion"
                                                rows="3"
                                                required></textarea>
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

                </div>
                <br />
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Título</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cursos->count() > 0)
                            @foreach($cursos as $ittem)
                            <tr>
                                <td>{{ $ittem->id }}</td>
                                <td>{{ $ittem->titulo }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('get_curso_by_id', $ittem->id) }}"><i class="fa-solid fa-eye"></i></a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_curso_Modal{{ $ittem->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete_curso_Modal{{ $ittem->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    ¿Estás seguro de eliminar este curso, recuerda que puede tener lecciones asociadas?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>

                                                    <form method="POST" action="{{ route('delete_curso_by_id', $ittem->id) }}">
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
                                <td colspan="3" class="text-center">No hay cursos registrados</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade"
                id="pills-lecciones"
                role="tabpanel"
                aria-labelledby="pills-lecciones-tab"
                tabindex="0">
                <div>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_leccion_modal">
                        <i class="fa-solid fa-plus"></i>
                        Crear lección
                    </button>
                    <div class="modal fade" id="create_leccion_modal" tabindex="-1" aria-labelledby="CreateLeccionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="CreateLeccionModalLabel">Llena los datos del formulario</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form method="POST" action="{{ route('create_leccion')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="Input_titulo_leccion" class="form-label">Título</label>
                                            <input type="text" class="form-control" id="Input_titulo_leccion" name="input_cursos_leccion" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_area_contenido_leccion" class="form-label">Contenido</label>
                                            <textarea class="form-control" id="input_area_contenido_leccion" name="input_contenido_leccion" rows="3" required></textarea>
                                        </div>
                                        <select class="form-select" aria-label="Default select example" name="select_lecciones" required>
                                            <option selected>Selecciona una opcion</option>
                                            @if($cursos->count() >0)
                                            @foreach($cursos as $ittem)
                                            <option value="{{$ittem->id}}">{{$ittem->titulo}}</option>
                                            @endforeach
                                            @else
                                            <option selected>No hay cursos creados</option>
                                            @endif
                                        </select>
                                        <br />
                                        <br />
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Título</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($lecciones->count() > 0)
                            @foreach ($lecciones as $ittem)
                            <tr>
                                <td>{{ $ittem->id }}</td>
                                <td>{{ $ittem->titulo }}</td>
                                <td>{{ $ittem->cursos_belongsTo->titulo}}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('get_leccion_by_id', $ittem->id) }}"><i class="fa-solid fa-eye"></i></a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $ittem->id }}">
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
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3" class="text-center">No hay lecciones registradas</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade"
                id="pills-estudiantes"
                role="tabpanel"
                aria-labelledby="pills-estudiantes-tab"
                tabindex="0">

                <div>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modal_estudiante">
                        <i class="fa-solid fa-plus"></i> Crear estudiante
                    </button>

                    <div class="modal fade" id="Modal_estudiante" tabindex="-1" aria-labelledby="ModalLabel_estudiante" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalLabel_estudiante">Llena los datos del formulario</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('create_estudiante') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="input_name_estudiante" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="input_name_estudiante" name="input_name_estudiante" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_phone_estudiante" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" id="input_phone_estudiante" name="input_phone_estudiante" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_email_estudiante" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="input_email_estudiante" name="input_email_estudiante" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input_password_estudiante" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="input_password_estudiante" name="input_password_estudiante" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa-solid fa-floppy-disk"></i> Guardar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($estudiantes->count() > 0)
                            @foreach($estudiantes as $ittem)
                            <tr>
                                <td>{{ $ittem->id }}</td>
                                <td>{{ $ittem->nombre }}</td>
                                <td>{{ $ittem->phone }}</td>
                                <td>{{ $ittem->correo }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('get_estudiante_by_id', $ittem->id) }}"><i class="fa-solid fa-eye"></i></a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_estudiante_Modal{{ $ittem->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete_estudiante_Modal{{ $ittem->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    ¿Estás seguro de eliminar al estudiante, podria tener suscripciones a los cursos?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>

                                                    <form method="POST" action="{{ route('delete_estudiante_by_id', $ittem->id) }}">
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
                                <td colspan="3" class="text-center">No hay cursos registrados</td>
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