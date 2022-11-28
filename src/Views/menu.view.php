<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php foreach ($menu_items as $menuItem): ?>
            <?php
                $url = $menuItem->url;
                $nev = $menuItem->nev;
                $id = 'nav-' . $menuItem->id;
                $hasChildren = isset($menuItem->children);
            ?>
            <li class="nav-item <?= $hasChildren ? 'dropdown' : '' ?>">
                <?php if ($hasChildren): ?>
                    <a class="nav-link dropdown-toggle" href="<?= $url ?>" id="<?= $id ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $nev ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="<?= $id ?>">
                        <?php foreach ($menuItem->children as $childItem): ?>
                            <li><a class="dropdown-item" href="<?= $childItem->url ?>"><?= $childItem->nev ?></a></li>
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
