

require('./bootstrap');

window.Vue = require('vue');


// Vue.component('Bodyvue', require('./components/Body.vue'));
// Vue.component('navbarvue', require('./components/navbar.vue'));
Vue.component('testcom',require('./components/test-com.vue'));

const app = new Vue({
    el: '#app',

    data:{
        message:''
    },

    methods:{
        send(){
            if (this.message.length!=0) {
                console.log(this.message);
            }
        }
    }
});
