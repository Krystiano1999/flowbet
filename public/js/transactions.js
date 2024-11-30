document.addEventListener('DOMContentLoaded', () => {
    const transactionsContainer = document.querySelector('.transactions-list');
    const addTransactionForm = document.getElementById('addTransactionForm');
    const addTransactionModal = new bootstrap.Modal(document.getElementById('addTransactionModal'));

    // Funkcja ładowania danych
    async function fetchTransactions() {
        try {
            const response = await fetch('/transactions', {
                headers: { 'Accept': 'application/json' },
            });

            const result = await response.json();

            if (response.ok && result.success) {
                renderTransactions(result.transactions);
            } else {
                toastr.error('Nie udało się załadować listy transakcji.', 'Błąd');
            }
        } catch (error) {
            toastr.error('Wystąpił błąd podczas ładowania danych.', 'Błąd serwera');
            console.error('Error:', error);
        }
    }

    // Renderowanie danych
    function renderTransactions(transactions) {
        transactionsContainer.innerHTML = ''; 

        transactions.forEach(transaction => {
            const transactionRow = document.createElement('tr');
            transactionRow.innerHTML = `
                <td>${transaction.type === 'deposit' ? 'Wpłata' : 'Wypłata'}</td>
                <td>${parseFloat(transaction.amount).toFixed(2)} zł</td>
            `;
            transactionsContainer.appendChild(transactionRow);
        });
    }

    // Obsługa formularza dodawania transakcji
    addTransactionForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        try {
            const response = await fetch('/transactions', {
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
                addTransactionModal.hide();
                addTransactionForm.reset();
                appendTransaction(result.transaction);
            } else if (response.status === 422) {
                displayValidationErrors(result.errors);
            } else {
                toastr.error(result.message || 'Wystąpił błąd', 'Błąd');
            }
        } catch (error) {
            toastr.error('Nie udało się dodać transakcji. Spróbuj ponownie później.', 'Błąd serwera');
            console.error('Error:', error);
        }
    });

    // Wyświetlanie błędów walidacji
    function displayValidationErrors(errors) {
        Object.values(errors).forEach(errorArray => {
            errorArray.forEach(error => toastr.warning(error, 'Walidacja'));
        });
    }

    // Dodawanie nowej transakcji
    function appendTransaction(transaction) {
        const transactionRow = document.createElement('tr');
        transactionRow.innerHTML = `
            <td>${transaction.type === 'deposit' ? 'Wpłata' : 'Wypłata'}</td>
            <td>${parseFloat(transaction.amount).toFixed(2)} zł</td>
        `;
        transactionsContainer.appendChild(transactionRow);
    }

    fetchTransactions();
});
