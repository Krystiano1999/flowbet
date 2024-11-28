document.addEventListener('DOMContentLoaded', () => {
    const stepForm = document.getElementById('stepForm');
    const stepsContainer = document.getElementById('steps-container');
    const addStepModal = new bootstrap.Modal(document.getElementById('addStepModal'));

    stepForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        try {
            const response = await fetch('/steps', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (response.ok && result.success) {
                addStepToList(result.step);

                addStepModal.hide();

                toastr.success(result.message, 'Sukces');
            } else if (response.status === 422) {
                displayValidationErrors(result.errors);
            } else {
                toastr.error(result.message || 'Wystąpił błąd', 'Błąd');
            }
        } catch (error) {
            toastr.error('Nie udało się dodać kroku. Spróbuj ponownie później.', 'Błąd serwera');
            console.error('Error:', error);
        }
    });

    //Dodaj krok do listy.
    function addStepToList(step) {
        const stepElement = document.createElement('div');
        stepElement.classList.add('list-group-item');
        stepElement.innerHTML = `
            <strong>Krok ${step.step_number}:</strong> Budżet: ${step.budget} zł
        `;
        stepsContainer.appendChild(stepElement);
    }

    //Wyświetl błędy walidacji z Toastr.
    function displayValidationErrors(errors) {
        Object.values(errors).forEach(errorArray => {
            errorArray.forEach(error => toastr.warning(error, 'Walidacja'));
        });
    }
});
