const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', name: 'home', component: () => import('pages/IndexPage.vue') },
      { path: 'funcionarios', name: 'listFuncionarios', component: () => import('pages/funcionario/ListFuncionarioPage.vue') },
      { path: 'form-funcionarios/:id?', name: 'formFuncionario', component: () => import('pages/funcionario/FormFuncionarioPage.vue') },
      { path: 'funcionarios/:id/vacinas', name: 'listFuncionarioVacinas', component: () => import('pages/vacinacao/ListFuncionarioVacinaPage.vue') },
      { path: 'vacinacao/:id/:isNew?', name: 'formFuncionarioVacinas', component: () => import('pages/vacinacao/FormFuncionarioVacinaPage.vue') },
      { path: 'vacinacao/:id/create', name: 'formFuncionarioVacinasCreate', component: () => import('pages/vacinacao/FormFuncionarioVacinacaoCreatePage.vue') },
      { path: 'vacinas', name: 'listVacinas', component: () => import('pages/vacina/ListVacinaPage.vue') },
      { path: 'form-vacinas/:id?', name: 'formVacina', component: () => import('pages/vacina/FormVacinaPage.vue') }
    ]
  },
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
