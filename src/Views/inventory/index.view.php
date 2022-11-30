<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="row g-2">
            <div class="col-xl-3 col-lg-6">
                <div class="input-group">
                    <label class="input-group-text" for="kezdo_datum">Kezdő dátum</label>
                    <input type="date" class="form-control" id="kezdo_datum" name="kezdo_datum" value="<?= $start_date ?>">
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="input-group">
                    <label class="input-group-text" for="vegdatum">Végdátum</label>
                    <input type="date" class="form-control" id="vegdatum" name="vegdatum" value="<?= $end_date ?>">
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="input-group">
                    <label class="input-group-text" for="kategoria">Kategória</label>
                    <select class="form-select" id="kategoria" name="kategoria">
                        <option selected>Válasszon egyet...</option>
                        <?php foreach($software_categories as $categoryArray): ?>
                            <?php $category = $categoryArray['kategoria']; ?>
                            <option value="<?= $category ?>"><?= $category ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="d-flex">
                    <button id="query" class="btn btn-primary me-2">
                        Lekérdezés
                    </button>
                    <a id="download" class="btn btn-secondary" target="_blank" href="">
                        PDF letöltése
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="result" class="row mt-5">
    <div class="col-md-5 offset-md-1 table-wrapper d-none">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Szoftver</th>
                    <th scope="col">Telepítések száma</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="col-md-5">
        <canvas id="chart" class="d-none"></canvas>
    </div>
</div>

<script>
    class Table {
        constructor(wrapper_selector) {
            this.wrapper = $(wrapper_selector);
        }
        display(data) {
            this.wrapper.addClass('d-none');
            const table = this.wrapper.find('table');
            const table_rows = data.map(row => {
                return `<tr><td>${row.nev}</td><td>${row.telepitesek}</td></tr>`;
            });
            table.find('tbody').html(table_rows.join(''));
            this.wrapper.removeClass('d-none');
        }
    }

    $(function() {
        new Button('#query', getList);
        new Button('#download', createPDF);
    });

    function getParams() {
        return {
            start_date: $('#kezdo_datum').val(),
            end_date: $('#vegdatum').val(),
            category: $('#kategoria').val()
        };
    }

    let chart = null;
    function drawChart(element_id, data) {
        const ctx = document.getElementById(element_id);
        $(ctx).removeClass('d-none');
        chart?.destroy();
        chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.map(row => {const {nev} = row; return nev;}),
                datasets: [{
                    data: data.map(row => {const {telepitesek} = row; return telepitesek;}),
                }]
            }
        });
    }

    async function getList() {
        const params = getParams();
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: "/inventory/get_list",
                data: params
            })
            .done(function(data) {
                new Table('.table-wrapper').display(data);
                drawChart('chart', data);
                resolve();
            });
        });
    }

    async function createPDF(e) {
        const url_params = new URLSearchParams({...getParams(), pdf: true});
        e.originalEvent.currentTarget.href = `/inventory/get_list?${url_params.toString()}`;
    }
</script>