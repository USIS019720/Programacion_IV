const express = require('express');
    server = express();
    port = 3001;

server.get('/alumnos', (req, resp) => {
    resp.send('Hola Mundo');
});

server.get('/usuarios', function(req, resp){
    resp.send('Bienvenido al sitio de chats');

});

server.listen(port, () => {
    console.log(`Server running on port ${port}`);
});