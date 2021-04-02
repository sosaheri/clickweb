

require('./bootstrap');

window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('mods-component', require('./components/ModComponent.vue').default);



const app = new Vue({
    el: '#app',
  
});
