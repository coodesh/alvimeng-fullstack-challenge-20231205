<script setup>
import GuestLayout from '@/Layouts/AuthLayout.vue';
import ExpenseService from '@/services/expenseService'
</script>

<template>
  <GuestLayout>
    <q-card class="q-ma-xl">
      <q-btn color="primary" class="q-ma-sm" label="Register new Expense" @click="createExpense" />
      <q-table
        :rows="dados"
        :columns="colunas"
        row-key="id"
      >
        <template v-slot:body-cell-actions="props">
          <q-td :props="props">
            <q-btn flat icon="edit" color="primary" @click="edit(props.row)" />
            <q-btn flat icon="delete" color="negative" @click="destroy(props.row)" />
          </q-td>
        </template>
      </q-table>
    </q-card>
  </GuestLayout>
</template>

<script>
export default {
  data() {
    return {
      dados: [],
      colunas: [
        { name: 'id', required: true, label: 'Id', align: 'left', field: row => row.id, sortable: true },
        { name: 'description', required: true, label: 'Description', align: 'left', field: row => row.description, sortable: true },
        { name: 'value', required: true, label: 'Value', align: 'left', field: row => row.value, sortable: true },
        { name: 'actions', required: true, label: 'Actions', align: 'center', sortable: false },
      ]
    };
  },
  methods: {
    createExpense() {
      this.$inertia.visit('/expenses/create');
    },
    edit(row) {
      this.$inertia.visit('/expenses/edit/'+ row.id);
    },
    destroy(row) {
      ExpenseService.destroyExpense(row.id)
        .then(() => {
          this.getAll()
        })
    },
    getAll() {
      ExpenseService.getAll()
      .then(response => {
        this.dados = response.data;
      });
    }
  },
  mounted() {
    this.getAll()
  }
};
</script>