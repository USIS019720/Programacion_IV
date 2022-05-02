/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue').default;
 
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
 
 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('animales-peligro', require('./components/EspeciesPeligro.vue').default);
 Vue.component('nueva-especie-peligro', require('./components/NuevaEspecieAmanezada.vue').default);
 Vue.component('programas', require('./components/Programas.vue').default);
 Vue.component('nuevo-programa', require('./components/NuevoPrograma.vue').default);
 Vue.component('consejos',  require('./components/Consejos.vue').default);
 Vue.component('nuevo-consejo',  require('./components/NuevoConsejo.vue').default);
 Vue.component('actualizar-especie', require('./components/ActualizarEspecie.vue').default);
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 window.abrirForm = (form) => {
     for (let i in app.forms) {
         console.log(i);
         if (i == form) {
             app.forms[i].mostrar = true;
         } else {
             app.forms[i].mostrar = false;
         }
     }
 }
 
 const app = new Vue({
     el: '#app',
     data: {
         buscar: '',
         forms: {
            enpeligro: {mostrar: false},
            nuevaPeligro: {mostrar: false},
            programas: {mostrar: false},
            nuevoPrograma: {mostrar: false},
            consejos: {mostrar: false},
            nuevoConsejo: {mostrar: false},
            actualizarEspecie: {mostrar: false}
         },
         especie: {},
     },
     methods: {
     },
    beforeMount() {
        this.$on('editarEspecie', (data) => {
            this.especie = data;
            abrirForm('actualizarEspecie');
        });
    }
 });
