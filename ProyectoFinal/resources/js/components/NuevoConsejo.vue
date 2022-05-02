<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Agregar Un Consejo</h3>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <form @submit.prevent="guardarConsejo" @reset.prevent="resetForm">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="nombre">Titulo</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del programa" v-model="especie.nombre">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="descripcion">Consejo</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Nombre de la organización" v-model="especie.descripcion"></textarea>                            </div>
                            </div>
                        </div>
                    </div>
                <div class="row mb-3">
                    <div class="col-md-12 offset-md-3">
                        <button type="button" class="btn btn-alert" @click="salir">Regresar</button>
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default ({
    data() {
        return {
            especie: {
                nombre: '',
                descripcion: '',
            },
        }
    },
    methods: {
        guardarConsejo() {
            axios.post('consejos', this.especie)
                .then(response => {
                    console.log(response);
                    abrirForm('consejos')
                })
                .catch(error => {
                    console.log(error);
                });
        },
        resetForm() {
            this.especie = {
                nombre: '',
                descripcion: '',
            }
        },
        salir() {
            abrirForm('consejos');
        }
    },
})
</script>
