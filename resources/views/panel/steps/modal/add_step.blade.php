<div class="modal fade" id="addStepModal" tabindex="-1" aria-labelledby="addStepModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStepModalLabel">Dodaj nowy krok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
            </div>
            <form id="stepForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="step_number" class="form-label">Numer kroku</label>
                        <input type="number" class="form-control" id="step_number" name="step_number" min="1" max="20" required>
                    </div>
                    <div class="mb-3">
                        <label for="budget" class="form-label">Budżet</label>
                        <input type="number" class="form-control" id="budget" name="budget" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </form>
        </div>
    </div>
</div>