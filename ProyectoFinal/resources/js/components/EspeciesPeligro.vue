<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Especies En Peligro</h3>
            <div class="card-tools">
                <input type="text" class="form-control" placeholder="Buscar Especie" v-model="buscar" @keyup="buscarEspecie">
            </div>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <button type="button" class="btn btn-tool btn-outline-success" @click="nuevaEspecie">
                Agregar Nueva Especie En Peligro
            </button>
            <h5 class="card-title">Resultados para {{ buscar }}</h5>
            <ul class="list-group list-group-flush">
                <li v-for="especie in especies" :key="especie.id" class="list-group-item d-flex row align-items-center container-hover" :class="{'d-none': !especie.mostrar}">
                    <div class="col-md-4">
                        <img :src="especie.imagen" style="max-height: 100px;" class="img-fluid rounded">
                    </div>
                    <div class="col-md-8 d-flex flex-column">
                        <span class="card-text">Nombre Común: {{ especie.nombre }}</span>
                        <span class="card-text">Habitad: {{ especie.habitad }}</span>
                        <span class="card-text">{{ especie.informacion.substring(0, 100) }}{{ especie.informacion.length > 100 ? '...' : '' }}</span>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-tool btn-outline-success m-1" v-if="especie.autor_id == user.id" @click="editarEspecie(especie)">
                                Editar
                            </button>
                            <button type="button" class="btn btn-tool btn-outline-danger m-1" v-if="especie.autor_id == user.id" @click="eliminarEspecie(especie)">
                                Eliminar
                            </button>
                            <button type="button" class="btn btn-tool btn-outline-info m-1" @click="verEspecie(especie)">
                                ver más
                            </button>
                        </div>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default ({
    props: {
        user: {
            type: Object,
            required: true
        }
    },
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
        editarEspecie(especie) {
            this.$root.$emit('editarEspecie', especie);
        },
        eliminarEspecie(especie) {
            if (confirm('¿Está seguro de eliminar esta especie?')) {
                axios.delete('/animales/' + especie.id)
                .then(response => {
                    this.obtenerEspecies();
                })
                .catch(error => {
                    console.log(error);
                });
            }
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
