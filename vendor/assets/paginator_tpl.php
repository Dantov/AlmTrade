<nav aria-label="Page navigation">
    <ul class="pagination <?= $this->size ?> <?= $this->class ?>">
        <?php
        if ($this->pagination->currentPage > $this->squaresPerPage) { ?>
            <li>
                <a href="<?= \dtw\HtmlHelper::URL('/base/page/' . $this->backToPage ) ?>" aria-label="Prev" title="Назад на пред. <?= $this->backToPage ?>">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
    <?php
        }
    ?>
    <?php for( $i = $this->startFromPage; $i <= $this->pagination->countPages; $i++ ) {
        $active = '';
        $disabled ='';
        $link = \dtw\HtmlHelper::URL('/base/page/'.$i);
        if ( $this->pagination->currentPage == $i )
        {
            $active = 'class="active"';
            $disabled = '<span class="sr-only">(current)</span>';
            $link = "#";
        }
    ?>
        <li <?=$active ?> >
            <a href="<?= $link ?>" aria-label="" title=""><?= $i . $disabled?></a>
        </li>
    <?php
            if ( $i != 0 )	$nn = $i / $this->squaresPerPage;
            if ( is_int($nn) && ( $i < $this->pagination->countPages ) ) {
                $nextI = $i + 1; // определяем след. страницу на которую перейдем после клика
    ?>
        <li>
            <a href="<?= \dtw\HtmlHelper::URL('/base/page/'.$nextI) ?>" aria-label="Next" title="Вперед на след. <?= $this->squaresPerPage ?>">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    <?php
                break;
            }
        }
    ?>
    </ul>
</nav>