<template>
  <q-page padding>
    <q-form
      @submit="onSubmit"
      class="row q-col-gutter-sm"
    >
      <q-input
        filled
        v-model="funcionarioNome"
        label="Funcionário"
        class="col-lg-12 col-xs-6"
        readonly
      />
      <q-select
        filled
        v-model="selectedVacinaId"
        :options="vacinas.map(vacina => ({ label: vacina.nome, value: vacina.id }))"
        label="Vacinas"
        class="col-lg-3 col-xs-6"
        emit-value
        map-options
      />
      <q-input
        filled
        v-model="form.data_dose"
        mask="##/##/####"
        label="Data da Dose"
        :rules="[val => validateDate(val) || 'Por favor, digite uma data válida']"
        class="col-lg-3 col-xs-6"
        >
        <template v-slot:append>
          <q-icon name="event" class="cursor-pointer">
            <q-popup-proxy cover transition-show="scale" transition-hide="scale">
              <q-date v-model="form.data_dose" mask="DD/MM/YYYY">
                <div class="row items-center justify-end">
                  <q-btn v-close-popup label="Close" color="primary" flat />
                </div>
              </q-date>
            </q-popup-proxy>
          </q-icon>
        </template>
      </q-input>
      <q-input
        filled
        v-model="form.dose"
        label="Número da Dose"
        class="col-lg-3 col-xs-6"
        type="number"
      />
      <div class="col-12 q-gutter-sm">
        <q-btn
          type="submit"
          label="Salvar"
          color="primary"
          class="col-12"
          @click.prevent="onSubmit"
        />
        <q-btn
          type="reset"
          label="Cancelar"
          color="white"
          text-color="primary"
          class="col-12"
          :to="{ name: 'listFuncionarios' }"
        />
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted, watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useQuasar } from 'quasar'
import { formatDateToPtBr, formatDateToEnUS } from 'boot/helpers'
import vacinasService from 'src/services/vacinas'
import funcionariosService from 'src/services/funcionarios'
import vacinacaoService from 'src/services/vacinacao'

export default defineComponent({
  name: 'FormFuncionarioVacinasPage',
  setup () {
    const vacinas = ref([])
    const route = useRoute()
    const router = useRouter()
    const { list } = vacinasService()
    const { getById: getFuncionarioById } = funcionariosService()
    const { getById, post, update } = vacinacaoService()
    const $q = useQuasar()
    const funcionarioNome = ref('')
    const selectedVacinaId = ref(null)
    const form = ref({
      vacina_id: '',
      funcionario_id: '',
      data_dose: '',
      dose: ''
    })

    onMounted(async () => {
      console.log('route.params.id', route.params.id)
      await getVacinas()
      await getVacinacao(route.params.id)
    })

    const getFuncionario = async (id) => {
      try {
        const data = await getFuncionarioById(id)
        funcionarioNome.value = data.nome_completo || ''
        console.log('funcionario', data)
      } catch (error) {
        console.log(error)
      }
    }

    const getVacinas = async () => {
      try {
        const data = await list()
        vacinas.value = data
      } catch (error) {
        console.log(error)
      }
    }

    const getVacinacao = async (id) => {
      try {
        const response = await getById(id)
        console.log('response', response)
        form.value = {
          ...response,
          data_dose: formatDateToPtBr(response.data_dose)
        }
        if (response && response.funcionario_id) {
          await getFuncionario(response.funcionario_id)
          selectedVacinaId.value = response.vacina_id
        }
      } catch (error) {
        console.log(error)
      }
    }

    watch(selectedVacinaId, (newValue) => {
      form.value.vacina_id = newValue
    })

    const onSubmit = async () => {
      try {
        if (form.value.id) {
          const response = await update({
            ...form.value, data_dose: formatDateToEnUS(form.value.data_dose)
          })
          console.log('response', response)
          $q.notify({
            icon: 'check',
            color: 'positive',
            position: 'top',
            message: 'Vacinação atualizada com sucesso!'
          })
          router.push({ name: 'listFuncionarioVacinas', params: { id: form.value.funcionario_id } })
        } else {
          await post({
            ...form.value, data_nascimento: formatDateToEnUS(form.value.data_nascimento)
          })
          $q.notify({
            icon: 'check',
            color: 'positive',
            position: 'top',
            message: 'Funcionário cadastrado com sucesso!'
          })
          router.push({ name: 'listFuncionarios' })
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

    return {
      form,
      funcionarioNome,
      selectedVacinaId,
      vacinas,
      onSubmit
    }
  }
})
</script>
