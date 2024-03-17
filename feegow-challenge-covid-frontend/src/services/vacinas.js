import UseApi from 'src/composables/UseApi'

export default function vacinasService () {
  const { list, post, update, remove, getById } = UseApi('vacinas')

  return {
    list,
    post,
    update,
    remove,
    getById
  }
}
