<div class="row mt-5">
    <div class="col-md-6 mx-auto">
        <form action="" method="POST" class="view-div">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" id="date" required>
                    <p class="text-danger fst-italic"><?= $errors['dateError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="hour" class="form-label">Heure</label>
                    <input type="time" class="form-control" min="08:00" max="20:00" name="hour" id="hour" required>
                    <p class="text-danger fst-italic"><?= $errors['hourError'] ?? '' ?></p>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Modifier le rendez-vous</button>
                </div>

            </div>
        </form>
        
    </div>
</div>
