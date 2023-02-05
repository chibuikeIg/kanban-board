import vueApp  from 'vue'

import Main from "./components/MainComponent.vue"
import Board from "./components/BoardComponent.vue"

vueApp.component("main-component", Main)
vueApp.component("board", Board)

const app = new vueApp({
    el: "#app",
})