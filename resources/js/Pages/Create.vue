<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import ExpenseService from '@/services/expenseService'
</script>

<template>
  <AuthLayout>
    <q-card class="q-ma-xl q-pa-md">
      <q-form @submit.prevent="onCreate">
        <q-input
          v-model="registerData.description"
          filled
          :rules="[
            val => !!val || 'This field is required.',
            val => (val && val.length <= 191) || 'The description may not be greater than 191 characters.'
          ]"
          label="Description"
          type="textarea"
        />
        <q-input
          filled
          v-model="registerData.value"
          :rules="[
            val => !!val || 'This field is required.',
            val => (!val || val >= 0) || 'The value must not be negative.'
          ]"
          label="Value"
          mask="#.##"
          fill-mask="#"
          reverse-fill-mask
          input-class="text-right"
        />
        <q-input
          v-model="registerData.date"
          :rules="[
            val => !!val || 'This field is required.',
            val => (!val || new Date(val) <= new Date()) || 'The date may not be in the future.'
          ]"
          filled
          type="date"
          hint="Date"
        />
        <q-btn label="Register Expense" type="submit" color="primary" class="q-mt-xs" />
      </q-form>
    </q-card>
  </AuthLayout>
</template>

<script>
export default {
  data() {
    return {
      registerData: {
        description: '',
        value: '',
        date: '',
      }
    };
  },
  methods: {
    async onCreate() {
      try {
        await ExpenseService.createExpense(this.registerData);
        this.$inertia.visit('/expenses');
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>