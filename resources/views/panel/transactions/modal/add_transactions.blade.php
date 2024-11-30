<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTransactionModalLabel">Dodaj transakcję</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTransactionForm">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Rodzaj</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Wybierz...</option>
                            <option value="deposit">Wpłata</option>
                            <option value="withdrawal">Wypłata</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Kwota</label>
                        <input type="number" class="form-control" id="amount" name="amount" required min="0.01" step="0.01">
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </form>
            </div>
        </div>
    </div>
</div>
