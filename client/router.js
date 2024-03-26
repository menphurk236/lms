import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  // { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: page('admin/dashboard/index.vue'),
    children: [
      { path: '', redirect: { name: 'dashboard.index' } },
      { path: 'index', name: 'dashboard.index', component: page('admin/dashboard/index.vue') }
    ]
  },
  {
    path: '/users',
    component: page('admin/user/index.vue'),
    children: [
      { path: '', redirect: { name: 'users.list' } },
      { path: 'list', name: 'users.list', component: page('admin/user/list.vue') },
      { path: 'create', name: 'users.create', component: page('admin/user/create.vue') },
      { path: ':id', name: 'users.view', component: page('admin/user/view.vue') }
    ]
  },
  {
    path: '/category',
    component: page('admin/category/index.vue'),
    children: [
      { path: '', redirect: { name: 'category.list' } },
      { path: 'list', name: 'category.list', component: page('admin/category/list.vue') },
      { path: 'create', name: 'category.create', component: page('admin/category/create.vue') },
      { path: ':id', name: 'category.view', component: page('admin/category/view.vue') }
    ]
  },
  {
    path: '/employee',
    component: page('admin/employee/index.vue'),
    children: [
      { path: '', redirect: { name: 'employee.list' } },
      { path: 'list', name: 'employee.list', component: page('admin/employee/list.vue') },
      { path: 'create', name: 'employee.create', component: page('admin/employee/create.vue') },
      { path: ':id', name: 'employee.view', component: page('admin/employee/view.vue') }
    ]
  },
  {
    path: '/video',
    component: page('admin/video/index.vue'),
    children: [
      { path: '', redirect: { name: 'video.list' } },
      { path: 'list', name: 'video.list', component: page('admin/video/list.vue') },
      { path: 'create', name: 'video.create', component: page('admin/video/create.vue') },
      { path: ':id', name: 'video.view', component: page('admin/video/view.vue') }
    ]
  },
  {
    path: '/department',
    component: page('admin/department/index.vue'),
    children: [
      { path: '', redirect: { name: 'department.list' } },
      { path: 'list', name: 'department.list', component: page('admin/department/list.vue') },
      { path: 'create', name: 'department.create', component: page('admin/department/create.vue') },
      { path: ':id', name: 'department.view', component: page('admin/department/view.vue') }
    ]
  }
]

export function createRouter() {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
