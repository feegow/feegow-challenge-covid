import UseApi from 'src/composables/UseApi'

export default function funcionariosService () {
  const { list, post, update, remove, getById } = UseApi('funcionarios')

  return {
    list,
    post,
    update,
    remove,
    getById,
    getFuncionarioById: getById
  }
}
