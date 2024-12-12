<div class="modal fade" id="editCouponModal" tabindex="-1" aria-labelledby="editCouponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCouponModalLabel">Edytuj kupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
            </div>
            <form id="editCouponForm">
                @csrf
                <input type="hidden" id="edit_coupon_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_step_id" class="form-label">Krok</label>
                        <select class="form-select" id="edit_step_id" name="step_id">
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}">Krok {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Typ</label>
                        <select class="form-select" id="edit_type" name="type">
                            <option value="standard">Standardowy</option>
                            <option value="extra">Nadprogramowy</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_amount" class="form-label">Stawka</label>
                        <input type="number" class="form-control" id="edit_amount" name="amount" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_odds" class="form-label">Kurs</label>
                        <input type="number" class="form-control" id="edit_odds" name="odds" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_result" class="form-label">Wynik</label>
                        <select class="form-select" id="edit_result" name="result">
                            <option value="null">Nieznany</option>
                            <option value="win">Wygrana</option>
                            <option value="lose">Przegrana</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_events_count" class="form-label">Ilość zdarzeń</label>
                        <input type="number" class="form-control" id="edit_events_count" name="events_count" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_won_events_count" class="form-label">Ilość wygranych zdarzeń</label>
                        <input type="number" class="form-control" id="edit_won_events_count" name="won_events_count" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_lost_events_count" class="form-label">Ilość przegranych zdarzeń</label>
                        <input type="number" class="form-control" id="edit_lost_events_count" name="lost_events_count" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                </div>
            </form>
        </div>
    </div>
</div>
