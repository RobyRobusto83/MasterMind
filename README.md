# MasterMind
# Api juego Mastermind

La API permite gestionar las partidas realizadas y los movimientos de MasterMind.

# PASOS A SEGUIR PARA INICIARLO
Una vez que tenemos los archivos de la api, lo primero que tenemos que hacer es un "docker compose up -d" para que se 
instale.

Despues hay que entrar en la imagen php con el comando "docker compose exec php bash" e instalar el composer para crear
las carpetas var y vendor con el comando "composer install".

Una vez hecho estos pasos nos salimos de la imagen php y entramos en la imagen frontend e instalamos el npm con el 
comando "npm install". Ya instalado ponemos "npm run serve" para iniciar la parte frontend y poder jugar con la 
aplicacin.