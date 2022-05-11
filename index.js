console.log('Hola mundo');

var num1 = 10,
    num2 = 20,
    resp = num1 * num2;
console.log("La suma es: ", resp);

var ntable = 7;
for (var i = 1; i<=10; i++){
    console.log(ntable + " x " + i + " = " + ntable * i);
}

//server node ***
var http = require('http').createServer(function(req, resp){
    resp.writeHead(200, {'Content-Type': 'text/html'});
    resp.write('<h1>Ella no te ama :v</h1>');
    resp.end();
});
http.listen(3001,function(){
    console.log("Servidor corriendo en el puerto 3001");
});