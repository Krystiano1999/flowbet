document.addEventListener('DOMContentLoaded', () => {
    const transactionsContainer = document.querySelector('.transactions-list');
    const addTransactionForm = document.getElementById('addTransactionForm');
    const addTransactionModal = new bootstrap.Modal(document.getElementById('addTransactionModal'));

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

    function renderTransactions(transactions) {
        transactionsContainer.innerHTML = '';
    
        transactions.forEach(transaction => {
            const transactionRow = document.createElement('tr');
            transactionRow.dataset.id = transaction.id;
    
            transactionRow.innerHTML = `
                <td>${transaction.type === 'deposit' ? 'Wpłata' : 'Wypłata'}</td>
                <td>${parseFloat(transaction.amount).toFixed(2)} zł</td>
                <td>
                    <button class="btn btn-danger btn-sm delete-transaction"><i class="fas fa-trash-alt me-1"></i> Usuń</button>
                </td>
            `;
    
            transactionRow.querySelector('.delete-transaction').addEventListener('click', () => {
                deleteTransaction(transaction.id);
            });
    
            transactionsContainer.appendChild(transactionRow);
        });
    }    

    async function deleteTransaction(transactionId) {
        Swal.fire({
            title: 'Czy na pewno?',
            text: 'Tej operacji nie można cofnąć!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tak, usuń',
            cancelButtonText: 'Anuluj',
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/transactions/${transactionId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    });
    
                    const result = await response.json();
    
                    if (response.ok && result.success) {
                        Swal.fire('Usunięto!', result.message, 'success');
    
                        document.querySelector(`tr[data-id="${transactionId}"]`).remove();
                    } else {
                        Swal.fire('Błąd!', result.message || 'Nie udało się usunąć transakcji.', 'error');
                    }
                } catch (error) {
                    Swal.fire('Błąd serwera!', 'Wystąpił błąd podczas usuwania transakcji.', 'error');
                    console.error('Error:', error);
                }
            }
        });
    }    

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

    function appendTransaction(transaction) {
        const transactionRow = document.createElement('tr');
        transactionRow.dataset.id = transaction.id; 

        transactionRow.innerHTML = `
            <td>${transaction.type === 'deposit' ? 'Wpłata' : 'Wypłata'}</td>
            <td>${parseFloat(transaction.amount).toFixed(2)} zł</td>
            <td>
                <button class="btn btn-danger btn-sm delete-transaction"><i class="fas fa-trash-alt me-1"></i> Usuń</button>
            </td>
        `;

        transactionRow.querySelector('.delete-transaction').addEventListener('click', () => {
            deleteTransaction(transaction.id);
        });

        transactionsContainer.appendChild(transactionRow);
    }

    function displayValidationErrors(errors) {
        Object.values(errors).forEach(errorArray => {
            errorArray.forEach(error => toastr.warning(error, 'Walidacja'));
        });
    }

    fetchTransactions();
});
