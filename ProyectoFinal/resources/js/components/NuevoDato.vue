<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Agregar Un Dato Curioso</h3>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <form @submit.prevent="guardarDato" @reset.prevent="resetForm">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="nombre">Titulo</label>
                            <div class="col-md-12">
                                <select class="form-control" name="nombre" id="nombre" placeholder="Nombre del programa" v-model="dato.nombre">
                                    <option value="">Seleccione un titulo</option>
                                    <option v-for="titulo in titulos" :value="titulo" :key="titulo">{{titulo.nombre}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="descripcion">Dato</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Nombre de la organización" v-model="dato.descripcion"></textarea>                            </div>
                            </div>
                        </div>
                    </div>
                <div class="row mb-3">
                    <div class="col-md-12 offset-md-3">
                        <button type="button" class="btn btn-warning" @click="salir">Regresar</button>
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
            dato: {
                nombre: '',
                descripcion: '',
            },
            titulos: [
                '¿Sabias qué?', 'Aunque Ud no lo crea', 'Esto te sorprendera', '¿Habías pensado?'
            ]
        }
    },
    methods: {
        guardarDato() {
            axios.post('datos', this.dato)
                .then(response => {
                    console.log(response);
                    abrirForm('curiosidades')
                })
                .catch(error => {
                    console.log(error);
                });
        },
        resetForm() {
            this.dato = {
                nombre: '',
                descripcion: '',
            }
        },
        salir() {
            abrirForm('curiosidades');
        }
    },
})
</script>
