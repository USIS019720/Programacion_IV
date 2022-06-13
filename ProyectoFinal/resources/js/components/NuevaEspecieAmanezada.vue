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
                            <img alt="imagen" :src="especie.imagen" style="max-width: 100%;" class="img-fluid rounded mx-auto d-block">
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
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la Especie" v-model="especie.nombre">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="habitad">Habitad</label>
                            <div class="col-md-12">
                                <input type="text" class="d-none" name="habitad" id="habitad" placeholder="Habitad de la especie" v-model="especie.habitad">
                                <div id="mimapa" style="height: 200px; width: 100%;"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="informacion">Información</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="informacion" id="informacion" placeholder="Información de la Especie" v-model="especie.informacion"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 offset-md-3">
                        <button type="button" class="btn btn-danger" @click="salir">Regresar</button>
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <button type="reset" class="btn btn-warning">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script type="module">
import '../leaflet/leaflet.js';
import '../leaflet/leaflet-routing-machine.js';
export default ({
    data() {
        return {
            mymap: null,
            especie: {
                imagen: '',
                nombre: '',
                habitad: '',
                informacion: ''
            },
        }
    },
    methods: {
        guardarEspecie() {
            axios.post('animales', this.especie)
                .then(response => {
                    console.log(response);
                    abrirForm('enpeligro')
                })
                .catch(error => {
                    console.log(error);
                });
        },
        resetForm() {
            this.especie = {
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
                this.especie.imagen = e.target.result;
            }
        },
        salir() {
            abrirForm('enpeligro');
        }
    },
    mounted() {
        let mymap = L.map('mimapa').setView([13.713203957489238, -88.97277832031251], 8);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZWxpYXMtcGFyYWRhIiwiYSI6ImNsM2F0dW55YzAxNnkzanBhYmVjaXRwMzEifQ.K5uvU7eJ6RRhxaNSRsyjYg', {
            maxZoom: 25,
            attribution: 'Datos del mapa de &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' + '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' + 'Imágenes © <a href="https://www.mapbox.com/">Mapbox</a>', 
            id: 'mapbox/streets-v11'
        }).addTo(mymap);

        mymap.on('click', e => {
            console.log(e.latlng);
            var marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(mymap);
            axios.get('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + e.latlng.lat + '&lon=' + e.latlng.lng)
                .then(response => {
                    console.log(response);
                    marker.bindPopup(response.data.display_name).openPopup();
                })
                .catch(error => {
                    console.log(error);
                });
            this.especie.habitad += e.latlng.lat + ',' + e.latlng.lng + ';';
        });
    }
})
</script>

<style>
@import url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.css');
@import url('https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css');
</style>