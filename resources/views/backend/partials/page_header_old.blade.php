<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-24">{{ isset($page_title) ? $page_title : "Please set page_title variable"; }}</h4>

            <div class="page-title-right">
                <?php if (isset($breadcums)): ?>
                    <ol class="breadcrumb m-0">
                        <?php foreach($breadcums as $breadcum): ?>
                            <li class="breadcrumb-item">
                                <?= $breadcum['title']; ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>

                <?php if (isset($breadcums) && isset($page_header_links)): ?>
                    <hr style="margin: 5px;"/>
                <?php endif; ?>

                <?php if (isset($page_header_links) && is_array($page_header_links)) : ?>
                    <div style="text-align:right; padding:5px;">
                        <?php 
                            foreach($page_header_links as $k => $link): 
                                if (!is_array($link))
                                {
                                    die("page_header_links variable inner value should be array");
                                }

                                if (!isset($link['title']))
                                {
                                    die("page_header_links -> $k title should be set");
                                }

                                if (!isset($link['url']))
                                {
                                    die("page_header_links -> $k url should be set");
                                }

                                $css_class = isset($link['class']) ? $link['class'] : 'btn btn-soft-primary waves-effect waves-light btn-sm';
                        ?>
                            <a class="<?= $css_class ?>" href="<?= $link['url'] ?>">
                                <?= $link['title']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>