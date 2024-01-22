<script setup>
import { Link } from '@inertiajs/vue3'

import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthService from '@/services/authService'
</script>

<template>
  <GuestLayout>
    <q-card-section>
      <q-form @submit.prevent="onRegister" style="width: 500px;">
        <q-input filled v-model="registerData.name" label="Name" :rules="[isFieldNotEmpty('Name')]" />
        <q-input filled v-model="registerData.email" label="E-mail" type="email" :rules="[isFieldNotEmpty('E-mail'), isValidEmail]" />
        <q-input filled v-model="registerData.password" label="Password" type="password" :rules="[isFieldNotEmpty('Password'), isPasswordLongEnough]" />
        <q-btn label="Create Account" type="submit" color="primary" class="q-mt-xs" />
      </q-form>
      <q-card-section class="q-mt-xs">
        <Link href="/">Have account? Sing In</Link>
      </q-card-section>
    </q-card-section>
  </GuestLayout>
</template>

<script>
export default {
  data() {
    return {
      registerData: {
        name: '',
        email: '',
        password: '',
      }
    };
  },
  methods: {
    isFieldNotEmpty(fieldName) {
      return val => !!val || `${fieldName} is required`;
    },
    isValidEmail(val) {
      return val.includes('@') || 'invalid E-mail';
    },
    isPasswordLongEnough(val) {
      return val.length > 7 || 'Password must be more than 7 characters long';
    },
    async onRegister() {
      try {
        await AuthService.register(this.registerData);
        this.$inertia.visit('/');
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>