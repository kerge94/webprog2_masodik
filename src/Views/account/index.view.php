<div class="row">
    <div class="col-md-6 p-4">
        <div class="card">
            <div class="card-header">Belépés</div>
            <div class="card-body">
                <form action="/account/login" method="post">
                    <div class="mb-3 row">
                        <label for="login" class="col-sm-4 col-form-label">Felhasználónév</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="login" name="login">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jelszo" class="col-sm-4 col-form-label">Jelszó</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="jelszo" name="jelszo">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Belépek</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 p-4">
        <div class="card">
            <div class="card-header">Regisztráció</div>
            <div class="card-body">
                <form action="/account/register" method="post">
                    <div class="mb-3 row">
                        <label for="csaladi_nev" class="col-sm-4 col-form-label">Családi név</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="csaladi_nev" name="csaladi_nev">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="uto_nev" class="col-sm-4 col-form-label">Utónév</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="uto_nev" name="uto_nev">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="login" class="col-sm-4 col-form-label">Felhasználónév</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="login" name="login">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jelszo" class="col-sm-4 col-form-label">Jelszó</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="jelszo" name="jelszo">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jelszo" class="col-sm-4 col-form-label">Admin fiók</label>
                        <div class="col-sm-8">
                            <input class="form-check-input" type="checkbox" value="1" id="admin" name="admin">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Regisztrálok</button>
                </form>
            </div>
        </div>
    </div>
</div>