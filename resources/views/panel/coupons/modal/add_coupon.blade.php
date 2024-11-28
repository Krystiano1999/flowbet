<div class="modal fade" id="addCouponModal" tabindex="-1" aria-labelledby="addCouponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCouponModalLabel">Dodaj kupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
            </div>
            <form id="couponForm">
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div class="mb-3">
                        <label for="step_id" class="form-label">Krok</label>
                        <select class="form-select" id="step_id" name="step_id">
                            <option value=""  disabled selected>wybierz krok</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}">Krok {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Typ</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="standard">Standardowy</option>
                            <option value="extra">Nadprogramowy</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Stawka</label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="odds" class="form-label">Kurs</label>
                        <input type="number" class="form-control" id="odds" name="odds" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="result" class="form-label">Wynik</label>
                        <select class="form-select" id="result" name="result">
                            <option value="null">Nieznany</option>
                            <option value="win">Wygrana</option>
                            <option value="lose">Przegrana</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="events_count" class="form-label">Ilość zdarzeń</label>
                        <input type="number" class="form-control" id="events_count" name="events_count" required>
                    </div>

                    <div class="mb-3">
                        <label for="won_events_count" class="form-label">Ilość wygranych zdarzeń</label>
                        <input type="number" class="form-control" id="won_events_count" name="won_events_count" required>
                    </div>

                    <div class="mb-3">
                        <label for="lost_events_count" class="form-label">Ilość przegranych zdarzeń</label>
                        <input type="number" class="form-control" id="lost_events_count" name="lost_events_count" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-primary">Dodaj kupon</button>
                </div>
            </form>
        </div>
    </div>
</div>
