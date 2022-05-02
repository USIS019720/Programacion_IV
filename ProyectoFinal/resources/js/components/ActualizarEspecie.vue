<template>
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Agregar Una Especie Amenazada</h3>
        </div>
        <div class="card-body" style="background-color: #baefd6;">
            <form @submit.prevent="guardarEspecie" @reset.prevent="resetForm">
                <div class="row mb-3">
                    <div class="col-md-6">              
                        <div class="col-md-12">
                            <img alt="imagen" :src="guardar.imagen" ref="imagen" style="max-width: 100%;" class="img-fluid rounded mx-auto d-block">
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
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la Especie" v-model="guardar.nombre">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="habitad">Habitad</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="habitad" id="habitad" placeholder="Habitad de la especie" v-model="guardar.habitad">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="informacion">Información</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="informacion" id="informacion" placeholder="Información de la Especie" v-model="guardar.informacion"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 offset-md-3">
                        <button type="button" class="btn btn-danger" @click="salir">Regresar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <button type="reset" class="btn btn-warning">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default ({
    props: {
        especie: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            guardar: {
                imagen: '',
                nombre: '',
                habitad: '',
                informacion: ''
            },
        }
    },
    methods: {
        guardarEspecie() {
            axios.put('animales/' + this.especie.id, this.guardar)
                .then(response => {
                    console.log(response);
                    abrirForm('enpeligro')
                })
                .catch(error => {
                    console.log(error);
                });
        },
        resetForm() {
            this.guardar = {
                imagen: '',
                nombre: '',
                habitad: '',
                informacion: ''
            }
        },
        cargarImagen(e) {
            var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = (e) => {
                this.guardar.imagen = e.target.result;
            }
        },
        salir() {
            abrirForm('enpeligro');
        }
    },
    mounted() {
        this.guardar = this.especie;
        this.$refs.imagen.onload = () => {
            this.guardar.imagen = this.$refs.imagen.src;
            var canvas = document.createElement("canvas");
            var ctx = canvas.getContext("2d");
            canvas.width = this.$refs.imagen.width;
            canvas.height = this.$refs.imagen.height;
            ctx.drawImage(this.$refs.imagen, 0, 0, canvas.width, canvas.height);
            this.guardar.imagen = canvas.toDataURL("image/png");
        }
    }
})
</script>
