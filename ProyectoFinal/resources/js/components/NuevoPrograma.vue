<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Agregar Un Nuevo Programa</h3>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <form @submit.prevent="guardarEspecie" @reset.prevent="resetForm">
                <div class="row mb-3">
                    <div class="col-md-6">              
                        <div class="col-md-12">
                            <img alt="imagen" :src="programa.imagen" style="max-width: 100%;" class="img-fluid rounded mx-auto d-block">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="imagen">Imagen</label>
                            <div class="col-md-12">
                                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen de la Especie" @change="cargarImagen">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nombre">Nombre</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del programa" v-model="programa.nombre">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="organizacion">Organización</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="organizacion" id="organizacion" placeholder="Nombre de la organización" v-model="programa.organizacion">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="descripcion">Descripción</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripción de la Especie" v-model="programa.descripcion"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="objetivo">Objetivo</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="objetivo" id="objetivo" placeholder="Descripción de la Especie" v-model="programa.objetivo"></textarea>
                            </div>
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
            programa: {
                imagen: '',
                nombre: '',
                organizacion: '',
                objetivo: '',
                informacion: ''
            },
        }
    },
    methods: {
        guardarEspecie() {
            axios.post('programas', this.programa)
                .then(response => {
                    console.log(response);
                    abrirForm('programas')
                })
                .catch(error => {
                    console.log(error);
                });
        },
        resetForm() {
            this.programa = {
                imagen: '',
                nombre: '',
                organizacion: '',
                objetivo: '',
                informacion: ''
            }
        },
        cargarImagen(e) {
            var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = (e) => {
                this.programa.imagen = e.target.result;
            }
        },
        salir() {
            abrirForm('programas');
        }
    },
})
</script>
