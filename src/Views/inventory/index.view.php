<div class="row">
    <div class="col">
        <div class="input-group mb-3">
            <label class="input-group-text" for="kezdo_datum">Kezdő dátum</label>
            <input type="date" class="form-control me-2" id="kezdo_datum" name="kezdo_datum">

            <label class="input-group-text" for="vegdatum">Végdátum</label>
            <input type="date" class="form-control me-2" id="vegdatum" name="vegdatum">

            <label class="input-group-text" for="kategoria">Kategória</label>
            <select class="form-select" id="kategoria" name="kategoria">
                <option selected>Válasszon egyet...</option>
                <?php foreach($software_categories as $categoryArray): ?>
                    <?php $category = $categoryArray['kategoria']; ?>
                    <option value="<?= $category ?>"><?= $category ?></option>
                <?php endforeach; ?>
            </select>

            <button id="query" class="mx-3 btn btn-primary">
                Lekérdezés
                <span class="spinner spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
            <button id="download" class="btn btn-secondary">
                Pdf letöltése
                <span class="spinner spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>

<script>
    class Button {
        constructor(id, onClick) {
            this.id = id;
            this.elem = $(`#${id}`);
            this.spinner = this.elem.find('.spinner');
            $(`#${id}`).on('click', async () => {
                this.elem.prop('disabled', true);
                this.spinner.removeClass('d-none');
                await onClick();
                //this.spinner.hide();
                this.spinner.addClass('d-none');
                this.elem.prop('disabled', false);
            });
        }
    }

    const fake_api = async function() {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
            console.log('lefutott');
            resolve();
            }, 1000);
        });
    };

    $(function() {
        const query = new Button('query', fake_api);
        const download = new Button('download', fake_api);
    });
</script>