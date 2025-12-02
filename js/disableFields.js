

function disableFieldsForTechnicians() {
    if (userType === "T") {
        // Deshabilitar campos de actividades
        document.getElementById("a-orderActiPicker").disabled = true;
        document.getElementById("a-orderActQtyPicker").disabled = true;
        document.getElementById("a-orderActPricePicker").disabled = true;
        document.getElementById("a-orderActDurationPicker").disabled = true;
        document.getElementById("a-orderActSubtotalPicker").disabled = true;
        document.getElementById("addActButton").disabled = true;

        // Ocultar o deshabilitar secciones relacionadas con precios
        const activitiesSection = document.getElementById("oActsTable");
        if (activitiesSection) {
            activitiesSection.style.display = "none"; // Ocultar la tabla de actividades
        }

        // Mostrar solo el campo de observaciones
        const observationsField = document.getElementById("a-oDetailsText");
        if (observationsField) {
            observationsField.disabled = false; // Asegurarse de que esté habilitado
        }
    }
}

// Llamar a la función al cargar la página
document.addEventListener("DOMContentLoaded", disableFieldsForTechnicians);