<script setup>
import { defineProps, defineEmits } from 'vue';
import { useContribuyentesStore } from '../stores/contribuyentesStore.js';

const props = defineProps({
    isEditing: Boolean
});

const emit = defineEmits(['close', 'save']);
const contribuyentesStore = useContribuyentesStore();

const save = () => {
    emit('save');
};

</script>

<template>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-md shadow-lg w-full max-w-md sm:max-w-lg max-h-screen h-4/5 p-6 overflow-auto">
            <h3 class="text-lg font-semibold mb-4">{{ isEditing ? 'Editar Contribuyente' : 'Crear Contribuyente' }}</h3>

            <form @submit.prevent="save" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label for="tipo_documento" class="block font-medium">Tipo Documento</label>
                    <select v-model="contribuyentesStore.currentContribuyente.tipo_documento"
                        class="w-full border-gray-300 rounded p-2">
                        <option value="">Seleccionar</option>
                        <option value="Cédula">Cédula</option>
                        <option value="NIT">NIT</option>
                    </select>
                </div>


                <div v-if="contribuyentesStore.currentContribuyente.tipo_documento !== 'NIT'">
                    <label for="nombres" class="block font-medium">Nombres</label>
                    <input v-model="contribuyentesStore.currentContribuyente.nombres" type="text" id="nombres"
                        class="w-full border-gray-300 rounded p-2" required />
                </div>
                <div v-if="contribuyentesStore.currentContribuyente.tipo_documento !== 'NIT'">
                    <label for="apellidos" class="block font-medium">Apellidos</label>
                    <input v-model="contribuyentesStore.currentContribuyente.apellidos" type="text" id="apellidos"
                        class="w-full border-gray-300 rounded p-2" required />
                </div>

                <div v-if="contribuyentesStore.currentContribuyente.tipo_documento === 'NIT'" class="col-span-2">
                    <label for="razon_social" class="block font-medium">Razón Social</label>
                    <input v-model="contribuyentesStore.currentContribuyente.razon_social" type="text" id="razon_social"
                        class="w-full border-gray-300 rounded p-2" required />
                </div>

                <div>
                    <label for="documento" class="block font-medium">
                        {{ contribuyentesStore.currentContribuyente.tipo_documento == 'NIT' ? 'NIT' : 'N° documento'
                        }}</label>
                    <input v-model="contribuyentesStore.currentContribuyente.documento" type="text" id="documento"
                        class="w-full border-gray-300 rounded p-2" @input="contribuyentesStore.checkDocumentoExistence"
                        @blur="contribuyentesStore.checkDocumentoExistence" />
                    <div v-if="contribuyentesStore.isDocumentoTaken" class="text-red-500 text-sm">
                        El documento ya está registrado.
                    </div>
                </div>

                <div>
                    <label for="telefono" class="block font-medium">Teléfono</label>
                    <input v-model="contribuyentesStore.currentContribuyente.telefono" type="text" id="telefono"
                        class="w-full border-gray-300 rounded p-2" />
                </div>
                <div>
                    <label for="celular" class="block font-medium">Celular</label>
                    <input v-model="contribuyentesStore.currentContribuyente.celular" type="text" id="celular"
                        class="w-full border-gray-300 rounded p-2" />
                </div>

                <div>
                    <label for="direccion" class="block font-medium">Dirección</label>
                    <input v-model="contribuyentesStore.currentContribuyente.direccion" type="text" id="direccion"
                        class="w-full border-gray-300 rounded p-2" />
                </div>

                <div class="col-span-2">
                    <label for="email" class="block font-medium">Correo electrónico</label>
                    <input v-model="contribuyentesStore.currentContribuyente.email" type="email" id="email"
                        class="w-full border-gray-300 rounded p-2" />
                </div>

                <div class="flex justify-center col-span-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        {{ isEditing ? 'Guardar Cambios' : 'Guardar' }}
                    </button>
                    <button type="button" @click="$emit('close')"
                        class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style>
/* Scroll personalizado */
::-webkit-scrollbar {
    width: 8px;
    /* Ancho del scroll */
    height: 8px;
    /* Altura del scroll (en caso de scroll horizontal) */
}

::-webkit-scrollbar-thumb {
    background: #c4c4c4;
    /* Color del scroll */
    border-radius: 4px;
    /* Bordes redondeados */
}

::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
    /* Color del scroll al pasar el mouse */
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    /* Fondo del track del scroll */
    border-radius: 4px;
    /* Bordes redondeados del track */
}

::-webkit-scrollbar-track:hover {
    background: #e6e6e6;
    /* Fondo del track al pasar el mouse */
}
</style>
