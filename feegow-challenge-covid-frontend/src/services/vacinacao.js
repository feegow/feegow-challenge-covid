import UseApi from 'src/composables/UseApi'

export default function vacinacaoService () {
  const { list, post, update, remove, getById, getVacinacaoByFuncionarioId } = UseApi('vacinacao')

  return {
    list,
    post,
    update,
    remove,
    getById,
    getVacinacaoByFuncionarioId
  }
}
