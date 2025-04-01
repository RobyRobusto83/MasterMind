<template>
<div>
    <h1> Reglas del juego </h1>
    <hr/>
    <ul>
        <li> Debes acertar el codigo de color en menos de 10 intentos </li>
        <li> Pincha en el color que quieras para añadir la combinacion que quieras </li>
        <li> Si un color esta en la columna correcta, un check verde &check; aparecera </li>
        <li> Si un color seleccionado esta en otra columna, unas flechas &harr; apareceran </li>
        <li> Recuerda, pueden repetirse los colores </li>
    </ul>
</div>
</template>


<script>
    export default {
        name: 'UserRules'
    }
</script>


<style> 
    ul  {
        list-style-type: square;
        list-style-position: outside
    }
    
    @media screen and (max-width: 900px) {
        #rules {
            margin-top: 5%;
        }
    }
    
</style>