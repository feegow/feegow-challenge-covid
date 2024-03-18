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

  const getVacinacaoByFuncionarioId = async (id) => {
    try {
      const { data } = await api.get(`${url}/funcionarios/${id}`)
      return data
    } catch (error) {
      throw new Error(error)
    }
  }

  const getVacinacaoById = async (id) => {
    try {
      const { data } = await api.get(`${url}/${id}/funcionarios`)
      return data
    } catch (error) {
      throw new Error(error)
    }
  }

  const post = async (form) => {
    try {
      console.log('url', url)
      console.log('formComposeble', form)
      const { data } = await api.post(url, form)
      return data
    } catch (error) {
      console.log('error', error)
      const errors = error.response.data.data
      const keys = Object.keys(errors)
      const message = keys.map((key) => {
        return errors[key]
      })
      if (message.length > 0) {
        throw new Error(message.join('\n'))
      }
      throw new Error(error)
    }
  }

  const update = async (form) => {
    try {
      console.log('url completa', `${url}/${form.id}`)
      const { data } = await api.put(`${url}/${form.id}`, form)
      return data
    } catch (error) {
      const errors = error.response.data.data
      const keys = Object.keys(errors)
      const message = keys.map((key) => {
        return errors[key]
      })
      if (message.length > 0) {
        throw new Error(message.join('\n'))
      }
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

  return { list, post, update, remove, getById, getVacinacaoById, getVacinacaoByFuncionarioId }
}
