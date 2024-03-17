import UseApi from 'src/composables/UseApiFuncionarioVacinas'

export default function funcionarioVacinasService () {
  const { list, post, update, remove, getById } = UseApi('funcionario-vacinas')

  return {
    list,
    post,
    update,
    remove,
    getById
  }
}
