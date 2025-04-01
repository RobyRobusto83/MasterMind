<template>
<div id="attempts">
    <h1> Intento </h1>
        <hr/>
    <div v-for="(attempt, index) in attempts" :key="attempt" class="attempt-row">
        {{index + 1}}.
      <div v-for="color in attempt[0]" :key="color">
            <div class="mini-button" :style="{'background-color': color}"> </div>
        </div>
      <div class="status-container">
        <div class="status" v-for="status in attempt[1]" :key="status">
          <span v-if="status === 1" class="check"> &check; </span>
          <span v-else-if="status === 0"> &harr; </span>
          <span v-else> X </span>
        </div>
      </div>
    </div>
</div>
</template>

<script>
    export default {
        name: 'UserGuesses',
        props: ['attempts']
    }
</script>

<style>

    #attempts {
        position: relative;
        bottom: 10%;
    }

    .mini-button {
        height: 25px;
        width: 25px;
        border-radius: 50%;
        border: 3px dotted black;
        margin-left: 10px;
    }

    .attempt-row {
        display: flex;
        justify-content: center;
        margin-top: 10px;
        width: 100%;
    }

    @media screen and (max-width: 900px) {
        .mini-button {
            width: 50px;
            height: 50px;
        }
    }
</style>