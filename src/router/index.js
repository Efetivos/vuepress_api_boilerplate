import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Novidade from '@/components/Novidade'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/:slug',
      name: 'novidade',
      component: Novidade
    },
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '*',
      name: '404',
      component: Home
    }
  ]
})
