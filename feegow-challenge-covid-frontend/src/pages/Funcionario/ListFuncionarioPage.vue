<template>
  <q-page class="flex flex-center">
   <div class="q-pa-md">
    <q-table
      title="Funcionários"
      :rows="funcionarios"
      :columns="columns"
      row-key="name"
    >
    <template v-slot:top>
        <span class="text-h5">Funcionarios</span>
        <q-space />
        <q-btn color="primary" label="Novo" :to="{ name: 'formFuncionario' }" />
    </template>
    <template v-slot:body-cell-actions="props">
      <q-td :props="props" class="q-gutter-sm">
        <q-btn
          color="info"
          icon="edit" dense size="sm"
          @click="handleEditFuncionario(props.row.id)"
        />
        <q-btn
          color="negative"
          icon="delete" dense size="sm"
          @click="handleDeleteFuncionario(props.row.id)"
        />
        <q-btn
          color="green"
          icon="local_hospital" dense size="sm"
          @click="handleFuncionarioVacinas(props.row.id)"
        />
      </q-td>
    </template>
    <template v-slot:body-cell-data_nascimento="props">
      <q-td :props="props">
        {{ formatarData(props.row.data_nascimento) }}
      </q-td>
    </template>
    <template v-slot:body-cell-portador_comorbidade="props">
      <q-td :props="props">
        {{ props.row.portador_comorbidade ? 'Sim' : 'Não' }}
      </q-td>
    </template>
  </q-table>
  </div>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue'
import funcionariosService from 'src/services/funcionarios'
import { useQuasar } from 'quasar'
import { useRouter } from 'vue-router'
export default defineComponent({
  name: 'ListFuncionario',
  setup () {
    const funcionarios = ref([])
    const { list, remove } = funcionariosService()
    const columns = [
      { name: 'id', label: 'ID', field: 'id', sortable: true, align: 'left' },
      { name: 'cpf', label: 'CPF', field: 'cpf', sortable: true, align: 'left' },
      { name: 'nome_completo', label: 'Nome Completo', field: 'nome_completo', sortable: true, align: 'left' },
      { name: 'data_nascimento', label: 'Data de Nascimento', field: 'data_nascimento', sortable: true, align: 'left' },
      { name: 'portador_comorbidade', label: 'Portador Comorbidade', field: 'portador_comorbidade', sortable: true, align: 'left' },
      { name: 'actions', label: 'Ações', field: 'actions', align: 'rigth' }
    ]
    const $q = useQuasar()
    const router = useRouter()
    onMounted(() => {
      getFuncionarios()
    })
    const getFuncionarios = async () => {
      try {
        const data = await list()
        funcionarios.value = data
      } catch (error) {
        console.log(error)
      }
    }
    const handleDeleteFuncionario = async (id) => {
      try {
        $q.dialog({
          title: 'Remover Funcionário',
          message: 'Deseja remover o funcionário?',
          cancel: true,
          persistent: true
        }).onOk(async () => {
          await remove(id)
          $q.notify({
            icon: 'check',
            color: 'positive',
            position: 'top',
            message: 'Funcionário deletado com sucesso'
          })
          getFuncionarios()
        }).onCancel(() => {
          console.log('>>>> Cancel')
        })
      } catch (error) {
        $q.notify({
          icon: 'check',
          color: 'negative',
          position: 'top',
          message: 'Erro ao deletar funcionário'
        })
      }
    }
    const handleEditFuncionario = async (id) => {
      router.push({ name: 'formFuncionario', params: { id } })
    }
    const handleFuncionarioVacinas = async (id) => {
      router.push({ name: 'listFuncionarioVacinas', params: { id } })
    }
    const formatarData = (data) => {
      if (!data) return ''
      const [ano, mes, dia] = data.split('-')
      return `${dia}/${mes}/${ano}`
    }
    const setToogle = (row) => {
      row.portador_comorbidade = !row.portador_comorbidade
    }
    return {
      funcionarios,
      columns,
      handleDeleteFuncionario,
      handleEditFuncionario,
      handleFuncionarioVacinas,
      formatarData,
      setToogle
    }
  }
})
</script>
