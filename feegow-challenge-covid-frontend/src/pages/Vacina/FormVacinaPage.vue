<template>
  <q-page padding>
    <q-form
      @submit="onSubmit"
      class="row q-col-gutter-sm"
    >
      <q-input
        outlined
        v-model="form.nome"
        label="Nome *"
        lazy-rules
        class="col-lg-12 col-xs-12"
        :rules="[ val => val && val.length > 0 || 'Por favor, digite o nome completo do vacina']"
      />
      <q-input
        outlined
        v-model="form.lote"
        label="Lote *"
        lazy-rules
        class="col-lg-6 col-xs-6"
        :rules="[ val => val && val.length > 3 || 'Por favor, digite o lote do vacina']"
      />
      <q-input
      filled
      v-model="form.data_validade"
      mask="##/##/####"
      label="Data de Validade"
      :rules="[val => validarData(val) || 'Por favor, digite uma data válida']"
      >
        <template v-slot:append>
          <q-icon name="event" class="cursor-pointer">
            <q-popup-proxy cover transition-show="scale" transition-hide="scale">
              <q-date v-model="form.data_validade" mask="DD/MM/YYYY">
                <div class="row items-center justify-end">
                  <q-btn v-close-popup label="Close" color="primary" flat />
                </div>
              </q-date>
            </q-popup-proxy>
          </q-icon>
        </template>
      </q-input>
      <div class="col-12 q-gutter-sm">
        <q-btn
          type="submit"
          label="Salvar"
          color="primary"
          class="col-12"
        />
        <q-btn
          type="reset"
          label="Cancelar"
          color="white"
          text-color="primary"
          class="col-12"
          :to="{ name: 'listVacinas' }"
        />
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import vacinaService from 'src/services/vacinas'
import { useQuasar } from 'quasar'

export default defineComponent({
  name: 'FormVacina',
  setup () {
    const { post, getById, update } = vacinaService()
    const $q = useQuasar()
    const router = useRouter()
    const route = useRoute()
    const form = ref({
      nome: '',
      lote: '',
      data_validade: ''
    })

    onMounted(async () => {
      if (route.params.id) {
        const response = await getById(route.params.id)
        form.value = {
          ...response,
          data_validade: formatDatePtBr(response.data_validade)
        }
      }
    })

    const onSubmit = async () => {
      try {
        if (form.value.id) {
          await update({
            ...form.value, data_validade: formatDate(form.value.data_validade)
          })
          $q.notify({
            icon: 'check',
            color: 'positive',
            position: 'top',
            message: 'Vacina atualizada com sucesso!'
          })
          router.push({ name: 'listVacinas' })
        } else {
          await post({
            ...form.value, data_validade: formatDate(form.value.data_validade)
          })
          $q.notify({
            icon: 'check',
            color: 'positive',
            position: 'top',
            message: 'Vacina cadastrada com sucesso!'
          })
          router.push({ name: 'listVacinas' })
        }
      } catch (error) {
        $q.notify({
          icon: 'error',
          color: 'negative',
          position: 'top',
          message: error.message
        })
      }
    }

    const formatDate = (date) => {
      if (!date) return ''
      const [day, month, year] = date.split('/')
      return `${year}-${month}-${day}`
    }

    const formatDatePtBr = (date) => {
      if (!date) return ''
      const [year, month, day] = date.split('-')
      return `${day}/${month}/${year}`
    }

    const validarData = (date) => {
      const regex = /^(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/]\d{4}$/
      return regex.test(date)
    }

    return {
      form,
      onSubmit,
      validarData
    }
  }
})
</script>
