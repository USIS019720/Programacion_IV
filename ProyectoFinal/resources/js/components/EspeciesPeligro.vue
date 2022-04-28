<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Especies Amenazadas</h3>
            <div class="card-tools">
                <input type="text" class="form-control" placeholder="Buscar" v-model="buscar" @keyup="buscarEspecie">
            </div>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <button type="button" class="btn btn-tool btn-outline-success" @click="nuevaEspecie">
                Agregar Nueva Especie En Peligro
            </button>
            <h5 class="card-title">Resultados para {{ buscar }}</h5>
            <ul class="list-group list-group-flush">
                <li v-for="especie in especies" :key="especie.id" class="list-group-item d-flex row align-items-center" :class="{'d-none': !especie.mostrar}">
                    <div class="col-md-4">
                        <img :src="especie.imagen" style="max-height: 100px;" class="img-fluid rounded">
                    </div>
                    <div class="col-md-8 d-flex flex-column">
                        <span class="card-text">Nombre Común: {{ especie.nombre }}</span>
                        <span class="card-text">Habitad: {{ especie.habitad }}</span>
                        <span class="card-text">{{ especie.informacion.substring(0, 100) }}...</span>
                        <button type="button" class="btn btn-outline-success" @click="verEspecie(especie)">Ver mas</button>
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
           especies: []
        }
    },
    methods: {
        nuevaEspecie() {
            abrirForm('nuevaPeligro');
        },
        obtenerEspecies() {
            axios.get('/animales')
            .then(response => {
                this.especies = response.data;
                this.especies.forEach(especie => {
                    especie.mostrar = true;
                });
            })
            .catch(error => {
                console.log(error);
            });
        },
        verEspecie(especie) {
            abrirForm('verEspecie', especie);
        },
        buscarEspecie() {
            console.log(this.buscar);
            this.especies.forEach(especie => {
                especie.mostrar = false;
            });
            this.especies.forEach(especie => {
                if (especie.nombre.toLowerCase().includes(this.buscar.toLowerCase()) || especie.habitad.toLowerCase().includes(this.buscar.toLowerCase()) || especie.informacion.toLowerCase().includes(this.buscar.toLowerCase()) || this.buscar.length == 0) {
                    especie.mostrar = true;
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
