import Vue from 'vue'
import _ from 'lodash';
import moment from 'moment';
import vuelidate from 'vuelidate';

import App from './App.vue'
import router from './router'
import store from './store'
import CommentCard from './components/CommentCard'

Vue.use(vuelidate);
Vue.component(CommentCard);

Vue.filter('date', function (value, format = 'YYYY-MM-DD') {
  if (typeof value !== 'string') return ''
  return moment(value).format(format)
});

import vuetify from '@/plugins/vuetify';
Object.defineProperty(Vue.prototype, '$_', { value: _ });
new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
