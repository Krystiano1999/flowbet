document.addEventListener('DOMContentLoaded', () => {
    const stepForm = document.getElementById('stepForm');
    const stepsContainer = document.getElementById('steps-container');
    const addStepModal = new bootstrap.Modal(document.getElementById('addStepModal'));

    // Pobierz wszystkie kroki na start
    fetchSteps();

    /**
     * Pobierz kroki z backendu.
     */
    async function fetchSteps() {
        try {
            const response = await fetch('/steps', {
                headers: {
                    'Accept': 'application/json',
                },
            });

            const result = await response.json();

            if (response.ok && result.success) {
                renderSteps(result.steps);
            } else {
                toastr.error('Nie udało się pobrać listy kroków.', 'Błąd');
            }
        } catch (error) {
            toastr.error('Wystąpił błąd podczas ładowania kroków.', 'Błąd serwera');
            console.error('Error:', error);
        }
    }

    /**
     * Renderuj kroki w kontenerze.
     * @param {Array} steps - Lista kroków
     */
    function renderSteps(steps) {
        stepsContainer.innerHTML = '';
        steps.forEach(step => {
            stepsContainer.appendChild(createStepElement(step));
        });
    }

    /**
     * Dodaj krok do listy.
     * @param {Object} step - Obiekt kroku
     */
    function addStepToList(step) {
        stepsContainer.appendChild(createStepElement(step));
    }

    /**
     * Utwórz element HTML dla kroku.
     * @param {Object} step - Obiekt kroku
     * @returns {HTMLElement} - Element kroku
     */
    function createStepElement(step) {
        const stepElement = document.createElement('div');
        stepElement.classList.add('list-group-item', 'd-flex', 'align-items-center', 'justify-content-between');
        stepElement.innerHTML = `
            <strong>Krok ${step.step_number}:</strong> 
            <span>Budżet: <strong>${formatBudget(step.budget)}</strong> zł</span>
        `;
        return stepElement;
    }

    /**
     * Formatowanie budżetu - przerwy co 3 znaki.
     * @param {number|string} budget - Kwota budżetu
     * @returns {string} - Sformatowany budżet
     */
    function formatBudget(budget) {
        return budget.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    }

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

    /**
     * Wyświetl błędy walidacji z Toastr.
     * @param {Object} errors - Błędy walidacji
     */
    function displayValidationErrors(errors) {
        Object.values(errors).forEach(errorArray => {
            errorArray.forEach(error => toastr.warning(error, 'Walidacja'));
        });
    }
});
