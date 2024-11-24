<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { useContribuyentesStore } from '../stores/contribuyentesStore.js';
import Swal from 'sweetalert2';
import Modal from '@/Components/ModalContribuyente.vue';

const contribuyentesStore = useContribuyentesStore();

const modalVisible = ref(false);
const isEditing = ref(false);

onMounted(() => {
    contribuyentesStore.fetchContribuyentes();
});

const openCreateModal = () => {
    contribuyentesStore.currentContribuyente = {
        tipo_documento: '',
        documento: '',
        nombres: '',
        apellidos: '',
        telefono: '',
        celular: '',
        email: '',
        direccion: '',
    };
    isEditing.value = false;
    modalVisible.value = true;
};

const openEditModal = (contribuyente) => {
    contribuyentesStore.currentContribuyente = { ...contribuyente };
    isEditing.value = true;
    modalVisible.value = true;
};

const closeModal = () => {
    modalVisible.value = false;
    contribuyentesStore.isDocumentoTaken = false
};


const saveOrEditContribuyente = async () => {
    try {
        if (!contribuyentesStore.isDocumentoTaken) {
            await contribuyentesStore.saveOrEditContribuyente(isEditing.value);
            closeModal();
            Swal.fire({
                icon: 'success',
                title: isEditing.value ? 'Contribuyente actualizado' : 'Contribuyente creado',
                text: 'El contribuyente ha sido guardado exitosamente.',
            });
        }
    } catch (error) {
        const validationErrors = contribuyentesStore.errors;
        if (validationErrors) {
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                html: Object.values(validationErrors)
                    .map((err) => `<li>${err.join('<br>')}</li>`)
                    .join(''),
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al guardar los datos.',
            });
        }
    }
};

const deleteContribuyente = async (id) => {
    try {
        await contribuyentesStore.deleteContribuyente(id);
        Swal.fire({
            icon: 'success',
            title: 'Contribuyente eliminado',
            text: 'El contribuyente ha sido eliminado exitosamente.',
        });
    } catch (error) {
        const validationErrors = contribuyentesStore.errors;
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: validationErrors ? validationErrors[0] : 'Hubo un error al eliminar el contribuyente.',
        });
    }
};

</script>

<template>

    <Head title="Gestión" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Gestión de contribuyentes
            </h2>
        </template>

        <div class="w-full flex justify-center my-4">
            <button @click="openCreateModal" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                Crear contribuyente
            </button>
        </div>

        <div class="w-full flex justify-center items-center">
            <div class="overflow-auto w-full max-w-4xl mt-4">
                <table class="table-auto border-collapse border border-gray-300 w-full border-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Tipo Documento</th>
                            <th class="border border-gray-300 px-4 py-2">Documento</th>
                            <th class="border border-gray-300 px-4 py-2">Nombres</th>
                            <th class="border border-gray-300 px-4 py-2">Apellidos</th>
                            <th class="border border-gray-300 px-4 py-2">Teléfono</th>
                            <th class="border border-gray-300 px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="contribuyentesStore.contribuyentes.length > 0">
                            <tr v-for="contribuyente in contribuyentesStore.contribuyentes" :key="contribuyente.id"
                                class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.tipo_documento }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.documento }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.nombres }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.apellidos }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ contribuyente.telefono }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex justify-between">
                                        <button @click="openEditModal(contribuyente)"
                                            class="text-blue-600 hover:underline">Editar</button>
                                        <button @click="deleteContribuyente(contribuyente.id)"
                                            class="text-red-600 hover:underline">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">No hay registros de
                                    contribuyentes</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <Modal v-if="modalVisible" :isEditing="isEditing" @close="closeModal" @save="saveOrEditContribuyente" />
    </AuthenticatedLayout>
</template>
