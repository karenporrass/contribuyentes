<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const contribuyentes = ref([
    {
        tipo_documento: 'CC',
        documento: 'CC',
        nombres: 'CC',
        apellidos: 'CC'
    }
]);


</script>

<template>

    <Head title="Gestión" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Gestión de contribuyentes
            </h2>
        </template>

        <div class="w-full flex justify-center items-center">
            <!-- Botón para crear contribuyentes -->
            <!-- <button @click="createContribuyente">Crear Contribuyente</button> -->
            <div class="overflow-auto w-full max-w-4xl mt-4">
                <table class="table-auto border-collapse border border-gray-300 w-full border-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Tipo Documento</th>
                            <th class="border border-gray-300 px-4 py-2">Documento</th>
                            <th class="border border-gray-300 px-4 py-2">Nombres</th>
                            <th class="border border-gray-300 px-4 py-2">Apellidos</th>
                            <th class="border border-gray-300 px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mostrar contribuyentes si hay registros -->
                        <template v-if="contribuyentes.length > 0">
                            <tr v-for="contribuyente in contribuyentes" :key="contribuyente.id"
                                class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.tipo_documento }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.documento }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.nombres }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.apellidos }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex justify-between">

                                        <button class="text-blue-600 hover:underline">Editar</button>
                                        <button class="text-red-600 hover:underline">Eliminar</button>
                                    </div>
                                    <!-- Botones de acción -->
                                </td>
                            </tr>
                        </template>

                        <!-- Mostrar mensaje si no hay registros -->
                        <template v-else>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">No hay registros de
                                    contribuyentes</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
