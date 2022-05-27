<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Datos curiosos</h3>
            <div class="card-tools">
                <input type="text" class="form-control" placeholder="Buscar datos curiosos" v-model="buscar" @keyup="buscarDatos">
            </div>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <button type="button" class="btn btn-tool btn-outline-success" @click="nuevoDatos">
                Agregar Nuevo Dato Curioso
            </button>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Datos aleatorios</h5>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ datoAleatorio.nombre }}</h5>
                            <p class="card-text">{{ datoAleatorio.descripcion }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="card-title">Resultados para {{ buscar }}</h5>
            <ul class="list-group list-group-flush">
                <li v-for="dato in datos" :key="dato.id" class="list-group-item d-flex row align-items-center" :class="{'d-none': !dato.mostrar}">
                    <div class="col-md-8 d-flex flex-column">
                        <span class="card-text"><b>{{ dato.nombre }}</b></span>
                        <span class="card-text">{{ dato.descripcion }}</span>
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
           datos: [],
           datoAleatorio: {
               nombre: '',
               descripcion: '',
           }
        }
    },
    methods: {
        nuevoDatos() {
            abrirForm('nuevoDato');
        },
        obtenerDatos() {
            axios.get('/datos')
            .then(response => {
                this.datos = response.data;
                this.datos.forEach(dato => {
                    dato.mostrar = true;
                }); 
            })
            .catch(error => {
                console.log(error);
            });
        },
        buscarDatos() {
            console.log(this.buscar);
            this.datos.forEach(dato => {
                dato.mostrar = false;
            });
            this.datos.forEach(dato => {
                if (dato.nombre.toLowerCase().includes(this.buscar.toLowerCase()) || dato.descripcion.toLowerCase().includes(this.buscar.toLowerCase()) || this.buscar.length == 0) {
                    dato.mostrar = true;
                }
            });
            this.$forceUpdate();
        }
    },
    mounted() {
        this.obtenerDatos();
        // this.datoAleatorio = this.datos[Math.floor(Math.random() * this.datos.length)];
        setTimeout(() => {
            if (this.datos.length > 0) {
                this.datoAleatorio = this.datos[Math.floor(Math.random() * this.datos.length)];
            }
        }, 1000);
    },
})
</script>
