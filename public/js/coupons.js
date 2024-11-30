import { fetchBudget } from './budget.js';

document.addEventListener('DOMContentLoaded', () => {
    //pobieranie kuponów według kroków
    const couponsContainer = document.getElementById('coupons-container');

    // Pobieranie danych kuponów
    fetchCoupons();

    async function fetchCoupons() {
        try {
            const response = await fetch('/coupons/data', {
                headers: { 'Accept': 'application/json' },
            });

            const result = await response.json();

            if (response.ok && result.success) {
                renderCoupons(result.coupons);
            } else {
                toastr.error('Nie udało się pobrać listy kuponów.', 'Błąd');
            }
        } catch (error) {
            toastr.error('Wystąpił błąd podczas ładowania kuponów.', 'Błąd serwera');
            console.error('Error:', error);
        }
    }

    // Renderowanie Accordion z kuponami
    function renderCoupons(coupons) {
        couponsContainer.innerHTML = '';

        Object.keys(coupons).forEach(stepNumber => {
            const stepData = coupons[stepNumber]; // Dane dla konkretnego kroku
            const accordionItem = renderAccordionItem(stepNumber, stepData);
            couponsContainer.appendChild(accordionItem);
        });
    }

    // Tworzenie elementu Accordion
    function renderAccordionItem(stepNumber, data) {console.log(data);
        const coupons = data.coupons || [];
        const activeCount = coupons.filter(coupon => coupon.status === 'active').length;
        const winCount = coupons.filter(coupon =>coupon.result === 'win').length;
        const lostCount = coupons.filter(coupon =>coupon.result === 'lose').length;

        const accordionItem = document.createElement('div');
        accordionItem.classList.add('accordion-item');

        accordionItem.innerHTML = `
            <h2 class="accordion-header" id="headingStep${stepNumber}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStep${stepNumber}" aria-expanded="true" aria-controls="collapseStep${stepNumber}">
                    Krok ${stepNumber}
                    <span class="ms-4">
                        <span class="badge text-info fw-bold">Aktywne: ${activeCount}</span>
                    </span>
                    <span class="ms-4">
                        <span class="badge text-primary fw-bold">Wygrane: ${winCount}</span>
                        <span class="badge text-secondary ms-2 fw-bold">Przegrane: ${lostCount}</span>
                    </span>
                </button>
            </h2>
            <div id="collapseStep${stepNumber}" class="accordion-collapse collapse" aria-labelledby="headingStep${stepNumber}" data-bs-parent="#coupons-container">
                <div class="accordion-body">
                    ${renderCouponsTable(data)}
                </div>
            </div>
        `;

        return accordionItem;
    }

    // Tworzenie tabeli z kuponami
    function renderCouponsTable(data) {
        const coupons = data.coupons;
        const summary = data.summary;

        let table = `
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Typ</th>
                        <th>Stawka</th>
                        <th>Kurs</th>
                        <th>Wynik</th>
                        <th>Wygrana</th>
                        <th>Przegrana</th>
                        <th>Bilans</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
        `;

        coupons.forEach((coupon, index) => {
            const resultClass =
                coupon.result === 'win' ? 'text-success fw-bold' : coupon.result === 'lose' ? 'text-danger' : '';

            table += `
                <tr>
                    <td>${coupon.type}</td>
                    <td>${coupon.amount.toFixed(2)} zł</td>
                    <td>${coupon.odds.toFixed(2)}</td>
                    <td class="${resultClass}">${coupon.result || 'Nieznany'}</td>
                    <td>${coupon.win_amount ? coupon.win_amount.toFixed(2) + ' zł' : '-'}</td>
                    <td>${coupon.loss_amount ? coupon.loss_amount.toFixed(2) + ' zł' : '-'}</td>
                    <td>${coupon.balance.toFixed(2)} zł</td>
                    <td>
                        <button class="btn btn-sm btn-warning mb-1"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            `;
        });

        // Podsumowanie
        table += `
            <tr class="fw-bold">
                <td>Podsumowanie</td>
                <td>${summary.total_amount.toFixed(2)} zł</td>
                <td></td>
                <td></td>
                <td>${summary.total_win.toFixed(2)} zł</td>
                <td>${summary.total_loss.toFixed(2)} zł</td>
                <td>${summary.total_balance.toFixed(2)} zł</td>
                <td></td>
            </tr>
        `;

        table += `
                </tbody>
            </table>
        `;

        return table;
    }


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
                fetchBudget();
            } else {
                toastr.error(result.message || 'Wystąpił błąd.', 'Błąd');
            }
        } catch (error) {
            toastr.error('Wystąpił błąd podczas dodawania kuponu.', 'Błąd serwera');
            console.error('Error:', error);
        }
    });
});
