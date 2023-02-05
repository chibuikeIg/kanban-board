import vueApp  from 'vue'

import Main from './components/MainComponent.vue'
import Board from './components/BoardComponent.vue'
import VModal from 'vue-js-modal'
import axios from 'axios';

vueApp.component("main-component", Main)
vueApp.component("board", Board)

vueApp.use(VModal, {componentName:"modal"})

vueApp.prototype.$http = axios;

const app = new vueApp({
    el: "#app",
})