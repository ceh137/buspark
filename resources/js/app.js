require('./bootstrap');

// Require Vue
window.Vue = require('vue').default;
import FullpageModal from 'vue-fullpage-modal'

Vue.use(FullpageModal)
import VueQrcodeReader from "vue-qrcode-reader";
Vue.use(VueQrcodeReader);

// Register Vue Components
Vue.component('test', require('./components/Test.vue').default);
Vue.component('checklist-create', require('./components/ChecklistCreate.vue').default)
Vue.component('index-create', require('./components/IndexCreate.vue').default)

import VueSwing from 'vue-swing'
Vue.component('vue-swing', VueSwing)

import EasyCamera from 'easy-vue-camera';
Vue.component('v-easy-camera', EasyCamera)

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)

const axios = require('axios').default;


// Initialize Vue
const app = new Vue({
    el: '#app',
});

const customSelect = require("custom-select").default;

const mySelects = customSelect('.custom-selector')

import { Vue2InteractDraggable } from 'vue2-interact';

export default {
    components: {
        Vue2InteractDraggable,

    }
}


