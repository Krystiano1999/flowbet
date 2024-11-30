export async function fetchBudget(budgetElementId = 'user-budget') {
    const budgetElement = document.getElementById(budgetElementId);

    try {
        const response = await fetch('/budget', {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
        });

        const result = await response.json();

        if (response.ok && result.success) {
            budgetElement.textContent = `${result.budget.toFixed(2)} zł`;
        } else {
            budgetElement.textContent = 'Błąd';
            console.error('Nie udało się pobrać budżetu:', result.message);
        }
    } catch (error) {
        budgetElement.textContent = 'Błąd';
        console.error('Wystąpił błąd podczas ładowania budżetu:', error);
    }
}