<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Consejos Para Cuidar El Medio Ambiente</h3>
            <div class="card-tools">
                <input type="text" class="form-control" placeholder="Buscar Consejos" v-model="buscar" @keyup="buscarConsejo">
            </div>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <button type="button" class="btn btn-tool btn-outline-success" @click="nuevoConsejo">
                Agregar Nuevo Consejo
            </button>
            <h5 class="card-title">Resultados para {{ buscar }}</h5>
            <ul class="list-group list-group-flush">
                <li v-for="consejo in consejos" :key="consejo.id" class="list-group-item d-flex row align-items-center" :class="{'d-none': !consejo.mostrar}">
                    <div class="col-md-8 d-flex flex-column">
                        <span class="card-text">{{ consejo.nombre }}</span>
                        <span class="card-text">Consejo: {{ consejo.descripcion }}</span>
                        <button type="button" class="btn btn-outline-success" @click="verConsejo(consejo)">Ver mas</button>
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
           consejos: []
        }
    },
    methods: {
        nuevoConsejo() {
            abrirForm('nuevoConsejo');
        },
        obtenerEspecies() {
            axios.get('/consejos')
            .then(response => {
                this.consejos = response.data;
                this.consejos.forEach(consejo => {
                    consejo.mostrar = true;
                });
            })
            .catch(error => {
                console.log(error);
            });
        },
        verConsejo(consejo) {
            abrirForm('verConsejo', consejo);
        },
        buscarConsejo() {
            console.log(this.buscar);
            this.consejos.forEach(consejo => {
                consejo.mostrar = false;
            });
            this.consejos.forEach(consejo => {
                if (consejo.nombre.toLowerCase().includes(this.buscar.toLowerCase()) || consejo.descripcion.toLowerCase().includes(this.buscar.toLowerCase()) || this.buscar.length == 0) {
                    consejo.mostrar = true;
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
