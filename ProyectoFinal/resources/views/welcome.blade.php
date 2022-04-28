<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Animalia') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="bg-light">
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ config('app.name', 'Animalia') }}</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Especies
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#" onclick="abrirForm('enpeligro')">Especies en peligo</a></li>
                                <li><a class="dropdown-item disabled" href="#">Animales extintas</a></li>
                            </ul>
                            </li>                            
                            <li class="nav-item">
                            <a class="nav-link" href="#" onclick="abrirForm('programas')">Programas</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#" onclick="abrirForm('consejos')">Consejos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <animales-peligro v-bind:form="forms" ref="enpeligro" v-if="forms['enpeligro'].mostrar"></animales-peligro>
                        <nueva-especie-peligro v-bind:form="forms" ref="nuevaPeligro" v-if="forms['nuevaPeligro'].mostrar"></nueva-especie-peligro>

                        <programas v-bind:form="forms" ref="programas" v-if="forms['programas'].mostrar"></programas>
                        <nuevo-programa v-bind:form="forms" ref="nuevoPrograma" v-if="forms['nuevoPrograma'].mostrar"></nuevo-programa>

                        <consejos v-bind:form="forms" ref="consejos" v-if="forms['consejos'].mostrar"></consejos>
                        <nuevo-consejo v-bind:form="forms" ref="nuevoConsejo" v-if="forms['nuevoConsejo'].mostrar"></nuevo-consejo>
                        <!-- <div class="card">
                            <div class="card-header bg-success text-white text-center">
                                <h3 class="card-title">Especies Amenazadas</h3>
                                <div class="card-tools">
                                    Buscar: <input type="text" class="form-control" placeholder="Buscar" v-model="buscar">
                                </div>
                            </div>
                            <div class="card-body" style="background-color: #baefd6;">
                                <button type="button" class="btn btn-tool btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-default">
                                    Agregar Nueva Especie En Peligro
                                </button>
                                <h5 class="card-title">Resultados para @{{ buscar }}</h5>
                                <ul class="list-group list-group-flush">
                                    <li style="background-color: #91eac1" class="list-group-item flex-column align-items-start justify-content-between">
                                    <img src="storage/c44c964ba33fe53c3155af3c0230fdb7.pnsg" alt="gato" width="100" height="100">
                                    <sapn class="card-text">Xxxx</sapn>
                                    <button type="button" class="btn btn-outline-success">Ver mas</button>
                                    </li>
                                </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
