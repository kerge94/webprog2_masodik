<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body>
        <?php include $menu ?>
        
        <section class="container my-5">
            <?php Models\View::renderView('alert', ['alert' => $alert ?? null]); ?>
            <?php include $content ?>
        </section>
        <footer>

        </footer>
    </body>
    <script>
        class Button {
            constructor(selector, on_click) {
                this.selector = selector;
                this.elem = $(selector);
                $(selector).on('click', async (e) => {
                    this.elem.prop('disabled', true);
                    await on_click(e);
                    this.elem.prop('disabled', false);
                });
            }
        }
    </script>
</html>
