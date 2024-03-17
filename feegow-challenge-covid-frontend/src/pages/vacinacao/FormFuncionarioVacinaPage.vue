<template>
  <q-page padding>
    <q-form
      @submit="onSubmit"
      class="row q-col-gutter-sm"
    >
      <q-select
        filled
        v-model="form.nome"
        :options="vacinas.map(vacina => ({ label: vacina.nome, value: vacina.id }))"
        label="Vacinas"
        class="col-lg-3 col-xs-6"
        />
    </q-form>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import vacinasService from 'src/services/vacinas'

export default defineComponent({
  name: 'FormFuncionarioVacinasPage',
  setup () {
    const vacinas = ref([])
    const route = useRoute()
    const { list } = vacinasService()
    const form = ref({
      nome: '',
      lote: '',
      data_validade: ''
    })
    onMounted(() => {
      console.log('route.params.id', route.params.id)
      getVacinas()
    })
    const getVacinas = async () => {
      try {
        const data = await list()
        console.log('data', data)
        vacinas.value = data
      } catch (error) {
        console.log(error)
      }
    }
    return {
      form,
      vacinas
    }
  }
})
</script>
