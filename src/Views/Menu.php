<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php foreach ($menu_items as $menu_item): ?>
            <?php
                $url = $menu_item['url'];
                $nev = $menu_item['nev'];
                $id = 'nav-' . $menu_item['id'];
                $is_sub_menu = isset($menu_item['submenu']);
            ?>
            <li class="nav-item <?= $is_sub_menu ? 'dropdown' : '' ?>">
                <?php if ($is_sub_menu): ?>
                    <a class="nav-link dropdown-toggle" href="<?= $url ?>" id="<?= $id ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $nev ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="<?= $id ?>">
                        <?php foreach ($menu_item['submenu'] as $submenu): ?>
                            <li><a class="dropdown-item" href="<?= $submenu['url'] ?>"><?= $submenu['nev'] ?></a></li>
                        <?php endforeach; ?>            
                    </ul>
                <?php else: ?>
                    <a class="nav-link" href="<?= $url ?>"><?= $nev ?></a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</nav>
<pre>
<?php
print_r($menu_items);