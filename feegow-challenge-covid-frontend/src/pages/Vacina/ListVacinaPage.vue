<template>
  <q-page class="flex flex-center">
   <div class="q-pa-md">
    <q-table
      title="Vacinas"
      :rows="vacinas"
      :columns="columns"
      row-key="name"
    >
    <template v-slot:top>
        <span class="text-h5">Vacinas</span>
        <q-space />
        <q-btn color="primary" label="Novo" :to="{ name: 'formVacina' }" />
    </template>
    <template v-slot:body-cell-actions="props">
      <q-td :props="props" class="q-gutter-sm">
        <q-btn
          color="info"
          icon="edit" dense size="sm"
          @click="handleEdit(props.row.id)"
        />
        <q-btn
          color="negative"
          icon="delete" dense size="sm"
          @click="handleDelete(props.row.id)"
        />
      </q-td>
    </template>
    <template v-slot:body-cell-data_validade="props">
      <q-td :props="props">
        {{ formatarData(props.row.data_validade) }}
      </q-td>
    </template>
  </q-table>
  </div>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue'
import vacinasService from 'src/services/vacinas'
import { useQuasar } from 'quasar'
import { useRouter } from 'vue-router'
export default defineComponent({
  name: 'ListFuncionario',
  setup () {
    const vacinas = ref([])
    const { list, remove } = vacinasService()
    const columns = [
      { name: 'id', label: 'ID', field: 'id', sortable: true, align: 'left' },
      { name: 'nome', label: 'Nome', field: 'nome', sortable: true, align: 'left' },
      { name: 'lote', label: 'Lote', field: 'lote', sortable: true, align: 'left' },
      { name: 'data_validade', label: 'Data de Validade', field: 'data_validade', sortable: true, align: 'left' },
      { name: 'actions', label: 'Ações', field: 'actions', align: 'rigth' }
    ]
    const $q = useQuasar()
    const router = useRouter()
    onMounted(() => {
      getVacinas()
    })
    const getVacinas = async () => {
      try {
        const data = await list()
        vacinas.value = data
      } catch (error) {
        console.log(error)
      }
    }
    const handleDelete = async (id) => {
      try {
        $q.dialog({
          title: 'Remover Vacina',
          message: 'Deseja remover a vacina?',
          cancel: true,
          persistent: true
        }).onOk(async () => {
          await remove(id)
          $q.notify({
            icon: 'check',
            color: 'positive',
            position: 'top',
            message: 'Vacina deletada com sucesso'
          })
          getVacinas()
        }).onCancel(() => {
          console.log('>>>> Cancel')
        })
      } catch (error) {
        $q.notify({
          icon: 'check',
          color: 'negative',
          position: 'top',
          message: 'Erro ao deletar vacina'
        })
      }
    }
    const handleEdit = async (id) => {
      router.push({ name: 'formVacina', params: { id } })
    }
    const formatarData = (data) => {
      if (!data) return ''
      const [ano, mes, dia] = data.split('-')
      return `${dia}/${mes}/${ano}`
    }
    return {
      vacinas,
      columns,
      handleDelete,
      handleEdit,
      formatarData
    }
  }
})
</script>
