var db_registro = openDatabase('dbregistro', '1.0', 'Sistema de Registro', 5 * 1024 * 1024);
if(!db_registro){
    alert('Disculpa tu navegador no soporta bases de datos locales :(');
}
var app = new Vue({
    el: '#appAlumno',
    data: {
        alumno: {
            accion: '',
            msg: '',
            idAlumno: '',
            codigo: '',
            nombre: '',
            apellido: '',
            nacimiento: '',
            direccion: '',
            telefono: '',
            correo: '',
            dui: ''
        },
    },
    methods: {
        guardarAlumno(){
            db_registro.transaction(tx=>{
                tx.executeSql('INSERT INTO alumno (codigo, nombre, apellido, nacimiento, direccion, telefono, correo, dui) VALUES (?,?,?,?,?,?,?,?)',
                [this.alumno.codigo, this.alumno.nombre, this.alumno.apellido, this.alumno.nacimiento, this.alumno.direccion,
                this.alumno.telefono, this.alumno.correo, this.alumno.dui],
                (tx, results)=>{
                    this.alumno.msg = 'Alumno guardado con exito';
                    this.nuevoAlumno();
                },
                (tx, error)=>{
                    this.alumno.msg = `Error al guardar el alumno ${error.message}`;
                });
            });
        },
        nuevoAlumno(){
            this.alumno.accion = 'nuevo';
            this.alumno.idAlumno = '';
            this.alumno.codigo = '';
            this.alumno.nombre = '';
            this.alumno.apellido = '';
            this.alumno.nacimiento = '';
            this.alumno.direccion = '';
            this.alumno.telefono = '';
            this.alumno.correo = '';
            this.alumno.dui = '';
        }
    },
    created(){
        db_registro.transaction(tx=>{
            tx.executeSql('CREATE TABLE IF NOT EXISTS alumno(idAlumno INTEGER PRIMARY KEY AUTOINCREMENT, '+
            'codigo char(10), nombre char(75), apellido char(75), nacimiento char(15), direccion TEXT, telefono char(10), correo char(40), dui char(10))');
        }, err=>{
            console.log('Error al crear la tabla alumno', err);
        });
    }
})