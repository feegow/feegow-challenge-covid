<template>
  <q-page >
    <div >
      <q-table
        title="Funcionário X Vacinas"
        :rows="funcionariovacinas[0]?.vacinas"
        :columns="columns"
        row-key="id"
      >
        <template v-slot:top>
          <span class="text-h5">Funcionário: {{ funcionariovacinas[0]?.nome_completo }}</span><q-space/><span>Portador Comorbidade: {{ funcionariovacinas[0]?.portador_comorbidade ? 'Sim' : 'Não' }}</span>
          <q-space />
          <q-btn color="primary" label="Novo" />
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
      </q-table>
    </div>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue'
import funcionarioVacinasService from 'src/services/funcionariovacinas'
import { useQuasar } from 'quasar'
import { useRouter, useRoute } from 'vue-router'

export default defineComponent({
  name: 'ListFuncionarioVacinas',
  setup () {
    const funcionariovacinas = ref([])
    const { list, remove } = funcionarioVacinasService()
    const columns = [
      { name: 'id', label: 'ID', field: 'id', sortable: true, align: 'left' },
      { name: 'nome', label: 'Nome', field: 'nome', sortable: true, align: 'left' },
      { name: 'lote', label: 'Lote', field: 'lote', sortable: true, align: 'left' },
      { name: 'data_validade', label: 'Data de Validade', field: 'data_validade', sortable: true, align: 'left' },
      { name: 'dose', label: 'Dose', field: 'dose', sortable: true, align: 'left' },
      { name: 'data_dose', label: 'Data da Dose', field: 'data_dose', sortable: true, align: 'left' },
      { name: 'actions', label: 'Ações', field: 'actions', align: 'right' }
    ]
    const $q = useQuasar()
    const router = useRouter()
    const route = useRoute()

    onMounted(() => {
      getFuncionarioVacinas(route.params.id)
    })

    const getFuncionarioVacinas = async (id) => {
      try {
        const data = await list(id)
        funcionariovacinas.value = data
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
          getFuncionarioVacinas()
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

    return {
      funcionariovacinas,
      columns,
      handleDelete,
      handleEdit
    }
  }
})
</script>
