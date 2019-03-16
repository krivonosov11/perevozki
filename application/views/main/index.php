<?php
?>

<div class="main_content">
    <div class="news_content">
        <div class="header_block">
            <i class="far fa-newspaper"></i>
            <span><?= Lang::_('NEWS_EVENTS') ?></span>
        </div>
        <?php if (\core\User::isAdmin()) { ?>
            <div class="add_new_post">
                <i class="fas fa-plus-circle"></i>
                <span><?= Lang::_('ADD_NEW_NEWS') ?></span>
                <hr>
            </div>
            <div class="add_post">
                <form action="/news/add-news" method="post" enctype="multipart/form-data">
                    <div style="display: inline-block;" class="image_info">
                        <img src="/public/images/image.jpg" alt="" class="img_to_public">
                        <label class="fileContainer">ВЫБРАТЬ ФАЙЛ
                            <input type="file" name="image_url" onchange="previewFile()">
                        </label>
                    </div>
                    <div style="display: inline-block;" class="text_info">
                        <select name="grou_id">
                            <option value="1"><?= Lang::_('NEWS_ARCHDIOCESE') ?></option>
                            <option value="2"><?= Lang::_('NEWS_PARISHES') ?></option>
                            <option value="3"><?= Lang::_('CULTURE') ?></option>
                            <option value="4"><?= Lang::_('UPCOMING_EVENTS') ?></option>
                        </select>
                        <input type="text" required name="header" placeholder="Заголовок">
                        <textarea name="text" required id="" cols="30" rows="10"></textarea>
                        <input type="submit" value="<?= Lang::_('PUPLICATING') ?>">
                    </div>
                </form>
            </div>
        <?php } ?>
        <!--List NEWS-->
        <?php foreach ($news as $val) { ?>
            <div class="item_news">
                <div class="img_blick">
                    <img src="/uploads/news/<?= $val['image'] ?>" alt="">
                </div>
                <div class="info_news">
                    <div class="head_news">
                        <a href="/news/main?id=<?= $val['id'] ?>"><?= $val['title'] ?></a>
                    </div>
                    <br>
                    <div class="data_news">
                        <a href="/news/<?= $val['link'] ?>"><?= $val['name'] ?></a>
                    </div>
                    <br>
                    <div class="description_news">
                        <?= mb_substr($val['description'], 0, 200, 'UTF-8') . '...' ?>
                    </div>
                    <br>
                    <div class="data_news">
                        <i class="far fa-calendar-alt"></i> <?= $val['date_created'] ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--End List       -->
        <div class="paggination">
            <span><a href="/main/page?list=1"><?= Lang::_('TO_FRONT') ?></a></span>
            <span><a href="/main/page?list=1">1</a></span><?= ($j - 3) < 1 ? '' : '...' ?>
            <?php for ($i = 2; $i < $count_page; $i++) {
                if ($i >= $j - 1 && $i <= $j + 1) {
                    echo '<span ' . ($i == $j ? 'class="now_i"' : '') . '><a href="/main/page?list=' . $i . '">' . $i . '</a></span>';
                }
            } ?>
            <?= (($j + 3) > $count_page ? '' : '...') ?>
            <?php if ($count_page > 1) { ?>
                <span><a href="/main/page?list=<?= $count_page ?>"><?= $count_page ?></a></span>
            <?php } ?>
            <span><a href="/main/page?list=<?= $count_page ?>"><?= Lang::_('TO_BACK') ?></a></span>
        </div>
    </div>
    <div class="options_contnent">
        <div class="header_block">
            <i class="fas fa-info-circle"></i>
            <span><?= Lang::_('INFORMATION') ?></span>
        </div>
        <div class="item_option">
            <div class="map_block">
                <img src="/public/images/mymaps-desktop-16x9.png" alt="">
            </div>
        </div>
    </div>
</div>
