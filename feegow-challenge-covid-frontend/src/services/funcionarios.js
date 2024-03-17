import UseApi from 'src/composables/UseApi'

export default function funcionariosService () {
  const { list, post, update, remove, getById, getVacinasByFuncionarioId } = UseApi('funcionarios')
  const { getVacinacaoById } = UseApi('vacinacao')

  return {
    list,
    post,
    update,
    remove,
    getById,
    getFuncionarioById: getById,
    getVacinasByFuncionarioId,
    getVacinacaoById
  }
}
