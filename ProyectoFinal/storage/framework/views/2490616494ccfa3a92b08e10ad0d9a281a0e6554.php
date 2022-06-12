<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo e(config('app.name', 'Animalia')); ?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="bg-light">
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><?php echo e(config('app.name', 'Animalia')); ?></a>
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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Informate
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#" onclick="abrirForm('consejos')">Consejos</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="abrirForm('curiosidades')">Datos curiosos</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="abrirForm('legislacion')">Legislación</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="abrirForm('programas')">Programas</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <?php if(auth()->guard()->guest()): ?>
                                <?php if(Route::has('login')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(Route::has('register')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <?php echo e(Auth::user()->name); ?>

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <?php echo e(__('Logout')); ?>

                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <animales-peligro v-bind:form="forms" ref="enpeligro" v-if="forms['enpeligro'].mostrar" :user="<?php echo e(Auth::user()); ?>"></animales-peligro>
                        <nueva-especie-peligro v-bind:form="forms" ref="nuevaPeligro" v-if="forms['nuevaPeligro'].mostrar"></nueva-especie-peligro>
                        <actualizar-especie v-bind:form="forms" ref="actualizarEspecie" v-if="forms['actualizarEspecie'].mostrar" :especie="especie"></actualizar-especie>

                        <programas v-bind:form="forms" ref="programas" v-if="forms['programas'].mostrar"></programas>
                        <nuevo-programa v-bind:form="forms" ref="nuevoPrograma" v-if="forms['nuevoPrograma'].mostrar"></nuevo-programa>

                        <consejos v-bind:form="forms" ref="consejos" v-if="forms['consejos'].mostrar"></consejos>
                        <nuevo-consejo v-bind:form="forms" ref="nuevoConsejo" v-if="forms['nuevoConsejo'].mostrar"></nuevo-consejo>

                        <curiosidades v-bind:form="forms" ref="curiosidades" v-if="forms['curiosidades'].mostrar"></curiosidades>
                        <nuevo-dato v-bind:form="forms" ref="nuevoDato" v-if="forms['nuevoDato'].mostrar"></nuevo-dato>
                        <legislacion v-bind:form="forms" ref="legislacion" v-if="forms['legislacion'].mostrar"></legislacion>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\programacion_iv\ProyectoFinal\resources\views/welcome.blade.php ENDPATH**/ ?>