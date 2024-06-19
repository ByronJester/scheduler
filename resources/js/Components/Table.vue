<template>
    <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 mt-10">
      <thead>
        <tr class="bg-gray-100">
          <!-- Loop through headers -->
          <th v-for="header in headers" :key="header.key" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
            {{ header.label }}
          </th>
          <!-- Conditional actions column header -->
          <th v-if="hasActions" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
            Actions
          </th>
        </tr>
      </thead>
      <tbody>
        <!-- Loop through rows -->
        <tr v-for="row in rows" :key="row.id" class="bg-white text-center">
          <td v-for="header in headers" :key="header.key" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            {{ row[header.key] }}
          </td>
          <!-- Conditional actions column cells -->
          <td v-if="hasActions" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            <!-- Action buttons -->
            <button @click="editAction(row.id)"><i class="fa-solid fa-pen-to-square mx-2 text-blue-400"></i></button>
            <button @click="deleteAction(row.id)"><i class="fa-solid fa-trash mx-2 text-rose-500 hidden"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>

  <script>
  export default {
    name: 'Table',
    props: {
      headers: {
        type: Array,
        required: true,
      },
      rows: {
        type: Array,
        required: true,
      },
      hasActions: {
        type: Boolean,
        default: false,
      },
    },
    methods: {
      editAction(id) {
        // Emit edit event with the row id
        this.$emit('edit', id);
      },
      deleteAction(id) {
        // Emit delete event with the row id
        this.$emit('delete', id);
      }
    }
  };
  </script>

  <style scoped>
  /* Add Tailwind CSS utility classes as needed */
  </style>
