import UseApi from 'src/composables/UseApi'

export default function funcionarioVacinasService () {
  const { list, post, update, remove, getById, getByFuncionarioId } = UseApi('funcionario-vacinas')

  return {
    list,
    post,
    update,
    remove,
    getById,
    getByFuncionarioId
  }
}
