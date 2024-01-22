<script setup>
import { Link } from '@inertiajs/vue3'

import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthService from '@/services/authService'
import axiosConfig from '@/services/axiosConfig';

</script>

<template>
  <GuestLayout>
    <q-card-section>
      <q-form @submit.prevent="onLogin" style="width: 500px;">
        <q-input filled v-model="loginData.email" label="E-mail" type="email" />
        <q-input filled v-model="loginData.password" label="Password" type="password" class="q-mt-md" />
        <q-btn label="Sing In" type="submit" color="primary" class="q-mt-md" />
      </q-form>
    </q-card-section>

    <q-card-section class="q-mt-xs">
      <Link href="/register">Create new account</Link>
    </q-card-section>
  </GuestLayout>
</template>

<script>
export default {
  data() {
    return {
      loginData: {
        email: '',
        password: ''
      }
    };
  },
  methods: {
    async onLogin() {
      try {
        await AuthService.login(this.loginData);
        axiosConfig();
        this.$inertia.visit('/manage');

      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>