
window.Vue = require('vue').default;

Vue.component('Flights', require('./components/Flight.vue').default);
Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
}).$mount('#app');
