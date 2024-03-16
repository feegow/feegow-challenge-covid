import { api } from 'boot/axios'

export default function UseApi (url) {
  const list = async () => {
    try {
      const { data } = await api.get(url)
      return data
    } catch (error) {
      throw new Error(error)
    }
  }

  const getById = async (id) => {
    try {
      const { data } = await api.get(`${url}/${id}`)
      return data
    } catch (error) {
      throw new Error(error)
    }
  }

  const post = async (form) => {
    try {
      const { data } = await api.post(url, form)
      return data
    } catch (error) {
      throw new Error(error)
    }
  }

  const update = async (form) => {
    try {
      console.log('url', url)
      console.log('form', form)
      console.log('enviado', `${url}/${form.id}`)
      const { data } = await api.put(`${url}/${form.id}`, form)
      return data
    } catch (error) {
      throw new Error(error)
    }
  }

  const remove = async (id) => {
    try {
      console.log('url', url)
      console.log('id', id)
      const { data } = await api.delete(`${url}/${id}`)
      return data
    } catch (error) {
      throw new Error(error)
    }
  }

  return { list, post, update, remove, getById }
}
