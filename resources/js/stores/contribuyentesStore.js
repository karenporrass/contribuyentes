import { defineStore } from 'pinia';
import { ref } from 'vue';
import axios from 'axios';

export const useContribuyentesStore = defineStore('contribuyentes', () => {
  const contribuyentes = ref([]);
  const currentContribuyente = ref({
    tipo_documento: '',
    documento: '',
    nombres: '',
    apellidos: '',
    razon_social: '',
    telefono: '',
    celular: '',
    email: '',
    direccion: '',
  });
  const isDocumentoTaken = ref(false);

  const errors = ref(null); // Para guardar los errores del servidor

  const fetchContribuyentes = async () => {
    try {
      const response = await axios.get(route('contribuyentes.get'));
      contribuyentes.value = response.data;
      errors.value = null;
    } catch (error) {
      handleApiError(error, 'Error al obtener los contribuyentes');
    }
  };

  const checkDocumentoExistence = async () => {
    if (currentContribuyente.value.documento) {
      try {
        const response = await axios.post(route('contribuyentes.documento'), {
          documento: currentContribuyente.value.documento,
        });
        isDocumentoTaken.value = response.data.exists;
        errors.value = null;
      } catch (error) {
        handleApiError(error, 'Error al verificar si el documento ya existe');
      }
    }
  };

  const saveOrEditContribuyente = async (isEditing) => {
    try {
      if (isEditing) {
        await axios.put(route('contribuyentes.update', currentContribuyente.value.id), currentContribuyente.value);
      } else {
        await axios.post(route('contribuyentes.store'), currentContribuyente.value);
      }
      await fetchContribuyentes();
      errors.value = null;
    } catch (error) {
      handleApiError(error, 'Error al guardar o actualizar el contribuyente');
      throw error; // Para manejarlo desde el componente
    }
  };

  const deleteContribuyente = async (id) => {
    try {
      await axios.delete(route('contribuyentes.delete', id));
      await fetchContribuyentes();
      errors.value = null;
    } catch (error) {
      handleApiError(error, 'Error al eliminar el contribuyente');
      throw error;
    }
  };

  const handleApiError = (error, defaultMessage) => {
    if (error.response) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors;
      } else {
        errors.value = [error.response.data.message || defaultMessage];
      }
    } else {
      errors.value = [defaultMessage];
    }
    console.error(defaultMessage, error);
  };

  return {
    contribuyentes,
    currentContribuyente,
    isDocumentoTaken,
    errors,
    fetchContribuyentes,
    checkDocumentoExistence,
    saveOrEditContribuyente,
    deleteContribuyente,
  };
});
