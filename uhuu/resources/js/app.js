
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'Vuex';
Vue.use(Vuex);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vuex

const store = new Vuex.Store({
    state:{
        item:{teste:"opa funcionou"}
    },
    mutations:{
        setItem(state, obj){
            state.item = obj;
        }
    }
});

Vue.component('box-component', require('./components/BoxComponent.vue').default);
Vue.component('crumbs-component', require('./components/CrumbsComponent.vue').default);
Vue.component('details-component', require('./components/DetailsComponent.vue').default);
Vue.component('event-card-component', require('./components/EventCardComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('modal-component', require('./components/modal/ModalComponent.vue').default);
Vue.component('modal-link-component', require('./components/modal/ModalLinkComponent.vue').default);
Vue.component('page-component', require('./components/PageComponent.vue').default);
Vue.component('panel-component', require('./components/PanelComponent.vue').default);
Vue.component('table-list-component', require('./components/TableListComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    mounted: function(){
        document.getElementById('app').style.display = "block";
    }
});
