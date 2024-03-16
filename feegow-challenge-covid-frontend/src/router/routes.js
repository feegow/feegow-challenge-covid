const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', name: 'home', component: () => import('pages/IndexPage.vue') },
      { path: 'funcionario', name: 'listFuncionarios', component: () => import('pages/Funcionario/ListFuncionarioPage.vue') },
      { path: 'form-funcionario/:id?', name: 'formFuncionario', component: () => import('pages/Funcionario/FormFuncionarioPage.vue') }
    ]
  },
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
