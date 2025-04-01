<template>
  <div>
    <h1 id="mastermind"> Mastermind </h1>
    <div id="app">
      <div id="game">
        <GuessContainer :guesses="guesses" :clear="clear" :submit="submit" :replay="replay" :isClearing="isClearing"
                        :statuses="statuses"/>
        <div class="button-container">
          <GameButton v-for="color in colors" :key="color" :color="color" :guess="guess"/>
        </div>
      </div>
      <div id="guesses">
        <Guesses :attempts="attemptedAnswers"/>
      </div>
      <div id="rules">
        <Rules/>
      </div>
    </div>
  </div>

</template>

<script>
import GameButton from './components/GameButton'
import GuessContainer from './components/GuessContainer';
import Guesses from './components/Guesses';
import Rules from './components/Rules';
import axios from "axios";
import {v4 as uuidv4} from 'uuid';

export default {
  name: 'app',
  components: {
    GameButton,
    GuessContainer,
    Guesses,
    Rules
  },
  data: function () {
    return {
      matchId: null,
      colors: ['#FF0000', '#FF7400', '#009999', '#00CC00'],
      guesses: [],
      correctAnswer: [],
      gotAnswer: false,
      tries: 0,
      attemptedAnswers: [],
      isClearing: false,
      statuses: [-1, -1, -1, -1]
    }
  },
  methods: {
    guess: function (guess) {
      if (this.guesses.length < 4) {
        this.guesses.push(guess);
      }
    },
    submit: function (answer) {
      if (answer.length < 4) {
        alert('Necesitas los cuatro colores para continuar');
      } else {
        var local_statuses = [];
        for (let i = 0; i < answer.length; i++) {
          if (answer[i] === this.correctAnswer[i]) {
            local_statuses[i] = 1;
            this.statuses[i] = 1;
          } else if (this.correctAnswer.includes(answer[i])) {
            local_statuses[i] = 0;
            this.statuses[i] = 0;
          } else {
            local_statuses[i] = -1;
            this.statuses[i] = -1;
          }
        }

        this.addNewMoveMatch();
        var move = [answer, local_statuses];
        this.attemptedAnswers.push(move);
        this.clear();

        this.tries++;

        if (this.statuses.filter((s) => s === 1).length === 4) {
          this.endedMatch('OK');
          return alert('¡Has acertado la respuesta!¡Enhorabuena!');
        }

        if (this.tries >= 10) {
          this.endedMatch('KO');
          return alert('¡Vaya hombre!¡No has acertado en los 10 intentos!');
        }
      }
    },
    clear: function () {
      if (this.guesses.length > 0) {
        var self = this;
        this.isClearing = true;

        setTimeout(function () {
          self.isClearing = false;
          self.guesses = [];
        }, 260);
      }
    },
    generateAnswer: function () {
      this.matchId = uuidv4();
      for (let i = 0; i < 4; i++) {
        this.correctAnswer.push(this.colors[Math.floor(Math.random() * 4)]);
      }
    },
    replay: function () {
      this.statuses = [-1, -1, -1, -1];
      this.correctAnswer = [];
      this.generateAnswer();
      this.attemptedAnswers = [];
      this.gotAnswer = false;
      this.tries = 0;
    },
    addNewMatch: function () {
      const datos = {
        id: this.matchId,
        name: "",
        target: this.correctAnswer.toString()
      }
      axios.post('http://localhost:9980/api/matchs', datos)
          .then(response => {
            console.log(response);
            console.log('Partida creada:');
          })
          .catch(error => {
            console.error('Error al crear partida:', error);
          });
    },
    endedMatch: function (succsesfull) {
      const datos = {
        id: this.matchId,
        succsesfull: succsesfull
      }
      axios.post('http://localhost:9980/api/match', datos)
          .then(response => {
            console.log(response);
            console.log('Partida actualizada');
          })
          .catch(error => {
            console.error('Error al actualizar partida:', error);
          });
    },
    addNewMoveMatch: function () {
      const datos = {
        match_id: this.matchId,
        target: this.statuses.toString(),
        target_Answer: this.guesses.toString()

      }
      axios.post('http://localhost:9980/api/moves', datos)
          .then(response => {
            console.log(response);
            console.log('Movimiento creado:');
          })
          .catch(error => {
            console.error('Error al crear un movimiento:', error);
          });
    },
    async getPreviousMatch() {
        try {
          const response = await axios.get('http://localhost:9980/api/matchs');
          var matches = response.data.matches;
          if (matches.length === 0) {
            this.generateAnswer();
            this.addNewMatch();
          } else {
            var match = matches[0];
            this.matchId = match["uuid"];
            var valores = match['target'].split(',');
            valores.forEach(color => {
              this.correctAnswer.push(color);
            });

            var movimientos = match['moves'];
            movimientos.forEach(datum => {
              console.log(datum['try']);
              var move = [datum['attempt'].split(','), datum['try'].split(',').map(Number)];
              console.log(move);
              this.attemptedAnswers.push(move);
            });

            console.log(this.correctAnswer);
            console.log('El array no está vacío');
          }
        } catch (err) {
          console.error('Error al crear partida:', err);
        }
    },
  },
  created: function () {
    this.getPreviousMatch();
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Exo');

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  display: flex;
  flex-flow: row wrap;
  width: 100%;
  height: 100%;
  transform: translateY(5%);
}

#game {
  width: 75%;
  height: 100%;
}

#extra {
  width: 17.5%;
}

#rules {
  display: flex;
  justify-content: center;
  width: 100%;
}

.button-container {
  display: flex;
  justify-content: center;
  flex-direction: row norwap;
  margin-top: 3%;
  width: 100%;
}

#mastermind {
  text-align: center;
  font-size: 3em;
  font-family: 'Exo', sans-serif;
}

@media screen and (max-width: 1399px) {
  .button-container {
    width: 100%;
  }

  #extra {
    width: 10%;
  }
}

@media screen and (max-width: 900px) {
  #app {
    flex-direction: column;
    margin-top: 0;
  }

  #game {
    width: 100%;
    flex-direction: colum warp;
  }

  #guesses {
    width: 100%;
  }
}


</style>