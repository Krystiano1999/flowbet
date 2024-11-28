document.addEventListener('DOMContentLoaded', () => {
    // pobieranie danych do selecta kroki i budżet
    const stepSelect = document.getElementById('step_id');

    fetchStepNumbersAndBudgets();

    async function fetchStepNumbersAndBudgets() {
        try {
            const response = await fetch('/steps/summary', {
                headers: {
                    'Accept': 'application/json',
                },
            });

            const result = await response.json();

            if (response.ok && result.success) {
                populateStepSelect(result.steps);
            } else {
                toastr.error('Nie udało się pobrać listy kroków.', 'Błąd');
            }
        } catch (error) {
            toastr.error('Wystąpił błąd podczas ładowania kroków.', 'Błąd serwera');
            console.error('Error:', error);
        }
    }

    function populateStepSelect(steps) {
        stepSelect.innerHTML = `<option value=""  disabled selected>wybierz krok</option>`; 

        steps.forEach(step => {
            const option = document.createElement('option');
            option.value = step.step_number; 
            option.setAttribute('data-amount', step.budget); 
            option.textContent = `Krok ${step.step_number} (Budżet: ${formatBudget(step.budget)} zł)`;

            stepSelect.appendChild(option);
        });
    }

    function formatBudget(budget) {
        return budget.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    }

    // automatyczne wypełnianie
    const amountInput = document.getElementById('amount');
    const resultSelect = document.getElementById('result');
    const eventsCountInput = document.getElementById('events_count');
    const wonEventsCountInput = document.getElementById('won_events_count');
    const lostEventsCountInput = document.getElementById('lost_events_count');

    // Automatyczna zmiana stawki na podstawie wybranego kroku
    stepSelect.addEventListener('change', () => {
        const selectedOption = stepSelect.options[stepSelect.selectedIndex];
        const amount = selectedOption.getAttribute('data-amount');
        amountInput.value = stepSelect.value ? amount : ''; 
    });

    // Automatyczne ustawianie zdarzeń wygranych/przegranych
    resultSelect.addEventListener('change', () => {
        if (resultSelect.value === 'win' && eventsCountInput.value) {
            wonEventsCountInput.value = eventsCountInput.value;
            lostEventsCountInput.value = 0;
        } else if (resultSelect.value === 'lose' && eventsCountInput.value) {
            wonEventsCountInput.value = 0;
            lostEventsCountInput.value = eventsCountInput.value;
        }
    });

    eventsCountInput.addEventListener('input', () => {
        if (resultSelect.value === 'win') {
            wonEventsCountInput.value = eventsCountInput.value;
            lostEventsCountInput.value = 0;
        } else if (resultSelect.value === 'lose') {
            wonEventsCountInput.value = 0;
            lostEventsCountInput.value = eventsCountInput.value;
        }
    });

    // dodawanie kuponu
    const couponForm = document.getElementById('couponForm');
    const addCouponModal = new bootstrap.Modal(document.getElementById('addCouponModal'));

    couponForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        try {
            const response = await fetch('/coupons', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (response.ok && result.success) {
                toastr.success(result.message, 'Sukces');
                addCouponModal.hide();
                couponForm.reset();
            } else {
                toastr.error(result.message || 'Wystąpił błąd.', 'Błąd');
            }
        } catch (error) {
            toastr.error('Wystąpił błąd podczas dodawania kuponu.', 'Błąd serwera');
            console.error('Error:', error);
        }
    });
});
