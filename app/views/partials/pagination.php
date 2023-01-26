
<nav aria-label="Page navigation example">
    <a href="<?=$paginator->getPrevUrl()?>" class="pagination-previous"
       <?php if(!$paginator->getPrevUrl()):?> disabled <?php endif;?>
    >Предыдущая</a>
    <a href="<?=$paginator->getNextUrl()?>" class="pagination-next"
        <?php if(!$paginator->getNextUrl()):?> disabled <?php endif;?>
    >Следующая</a>

    <ul class="pagination">
    <?php foreach ($paginator->getPages() as $page): ?>
        <?php if ($page['url']): ?>
            <li class="page-item">
                <a class="page-link <?php echo $page['isCurrent'] ? 'is-current' : ''; ?>" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
            </li>
        <?php else: ?>
            <li class="page-link"><span><?php echo $page['num']; ?></span></li>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
</nav>