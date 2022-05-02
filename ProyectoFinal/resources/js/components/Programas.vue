<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Buscar Programas</h3>
            <div class="card-tools">
                <input type="text" class="form-control" placeholder="Buscar" v-model="buscar" @keyup="buscarPrograma">
            </div>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <button type="button" class="btn btn-tool btn-outline-success" @click="nuevoPrograma">
                Agregar Nueva Especie En Peligro
            </button>
            <h5 class="card-title">Resultados para {{ buscar }}</h5>
            <ul class="list-group list-group-flush">
                <li v-for="programa in programas" :key="programa.id" class="list-group-item d-flex row align-items-center" :class="{'d-none': !programa.mostrar}">
                    <div class="col-md-4">
                        <img :src="programa.imagen" style="max-height: 100px;" class="img-fluid rounded">
                    </div>
                    <div class="col-md-8 d-flex flex-column">
                        <span class="card-text">Nombre: {{ programa.nombre }}</span>
                        <span class="card-text">Organización: {{ programa.organizacion }}</span>
                        <span class="card-text">Información: {{ programa.descripcion.substring(0, 100) }}...</span>
                        <span class="card-text">Objetivo: {{ programa.objetivo }}.</span>
                        <button type="button" class="btn btn-outline-success" @click="verPrograma(programa)">Ver mas</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default ({
    data() {
        return {
           buscar: '',
           programas: []
        }
    },
    methods: {
        nuevoPrograma() {
            abrirForm('nuevoPrograma');
        },
        obtenerEspecies() {
            axios.get('/programas')
            .then(response => {
                this.programas = response.data;
                this.programas.forEach(programa => {
                    programa.mostrar = true;
                });
            })
            .catch(error => {
                console.log(error);
            });
        },
        verPrograma(programa) {
            abrirForm('verPrograma', programa);
        },
        buscarPrograma() {
            console.log(this.buscar);
            this.programas.forEach(programa => {
                programa.mostrar = false;
            });
            this.programas.forEach(programa => {
                if (programa.nombre.toLowerCase().includes(this.buscar.toLowerCase()) || programa.organizacion.toLowerCase().includes(this.buscar.toLowerCase()) || this.buscar.length == 0) {
                    programa.mostrar = true;
                }
            });
            this.$forceUpdate();
        }
    },
    mounted() {
        this.obtenerEspecies();
    }
})
</script>
