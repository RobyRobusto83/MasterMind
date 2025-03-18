# MasterMind
# Api juego Mastermind

La API permite gestionar las partidas realizadas y los movimientos de MasterMind.

# PASOS A SEGUIR PARA INICIARLO
Una vez que tenemos los archivos de la api, lo primero que tenemos que hacer es un "docker compose up" para que se instale. Una vez que se el proceso se haya detenido, lo paramos y lo volvemos a lanzar con el comando o alias "dkrup".

Despues hay que entrar en la imagen php con el comando "docker compose exec php bash" e instalar el composer para crear las carpetas var y vendor con el comando "composer install".

Una vez hecho estos pasos para comprobar que todo funcione y este todo en orden, nos vamos a una ventana nueva en nuestro navegador y ponemos la siguiente url: localhost:9980.

Si todo ha sido instalado correctamente, en el navegador deberia salir la pagina de Symfony.