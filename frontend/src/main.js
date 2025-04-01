import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import router from '@/router'

import App from './App.vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap/dist/js/bootstrap.min.js'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


Vue.config.productionTip = false


new Vue({
  el: '#app',
  router,
  template: '<App />',
  components: { App },
  render: h => h(App)
})

