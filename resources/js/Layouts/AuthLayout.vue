<script setup>
import axiosConfig from '@/services/axiosConfig';
</script>

<template>
  <q-layout view="hHh lpR fFf">

    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          Manage Expenses
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <slot />
    </q-page-container>

  </q-layout>
</template>

<script>
export default {
  mounted() {
    axiosConfig();
  }
}
  
</script>