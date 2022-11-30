<div class="row">
    <div class="col-md-5 offset-md-1">
        <div class="card">
            <div class="card-header">
                Kérés
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><?= $endpoint ?></div>
                        </div>
                        <input type="text" class="form-control" id="resource" name="resource" placeholder="/id">
                    </div>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="json" name="json" placeholder="JSON" rows="10"></textarea>
                </div>
                <div class="d-flex justify-content-between"><div>
                    <select class="form-select" id="method" name="method">
                        <option selected>HTTP metódus</option>
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                        <option value="PUT">PUT</option>
                        <option value="DELETE">DELETE</option>
                    </select></div>
                    <button id="send" class="btn btn-primary">Küldés</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 response-wrapper">
        <div class="card">
            <div class="card-header">
                Válasz
            </div>
            <div id="response" class="card-body">
                <div id="response_code" class="mb-3">
                    HTTP állapotkód: <i></i>
                </div>
                <div>
                    HTTP body:
                    <pre class="pt-2"></pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const endpoint = '<?= $endpoint ?>';

    $(function() {
        new Button('#send', sendRequest);
    });

    $('#method').on('change', function() {
        if (['GET', 'DELETE'].includes($(this).val())) {
            $('#json').val('');
        }
    });


    async function sendRequest() {
        const displayStatus = (status) => {$('#response_code i').html(status);};
        const displayResponse = (data) => {$('#response pre').html(data ? JSON.stringify(data, null, 2) : '');};
        displayStatus('');
        displayResponse('');

        return new Promise((resolve, reject) => {
            const method = $('#method').val();
            const url = `${endpoint}${$('#resource').val()}`;
            const data = () => {
                try {
                    const json_string = $('#json').val();
                    if (json_string) {
                        return JSON.parse(json_string);
                    }
                }
                catch (e) {
                    resolve();
                    alert(e);
                }
            };

            $.ajax({
                method: method,
                url: url,
                contentType: "application/json",
                data: JSON.stringify(data())
            })
            .done(function(data, _, xhr) {
                displayResponse(data);
                displayStatus(xhr.status);
            })
            .fail(function (xhr) {
                displayStatus(xhr.status);
            })
            .always(function () {
                resolve();
            });
        });
    }
</script>