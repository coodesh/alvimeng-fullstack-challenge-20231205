<template>
  <q-layout view="hHh lpR fFf">
    <q-page-container>
      <q-page class="flex flex-center">
        <q-card class="q-pa-sm">
          <q-card-section>
            <div class="text-h6">Manage Expenses </div>
          </q-card-section>
          <slot />
        </q-card>
      </q-page>
    </q-page-container>
  </q-layout>
</template>