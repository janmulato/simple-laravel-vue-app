import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import comments from './modules/comments';
Vue.use(Vuex)
let plugins = [
  createPersistedState({
    storage: window.sessionStorage,
   }),
];

export default new Vuex.Store({
  modules: {
    comments
  },
  plugins: plugins,
})
