<?php
?>
<div class="block_body"></div>
<div class="popoup_block">
    <div class="title">
        <span></span>
        <i class="fas fa-times close_popoup"></i>
    </div>
    <div class="body"></div>
</div>
<div class="to_up">
    <img src="/public/images/up-arrow-png-12.png" alt="">
</div>
<div class="header_menu_wrapper">
    <div class="img_head">
        <img src="/public/images/1.png" alt="">
    </div>
    <div class="logo_text">
        <?= Lang::_('LOGO_TEXT') ?>
    </div>
    <div class="img_head">
        <img src="/public/images/2.png" alt="">
    </div>
    <div class="img_logo">
        <img src="/public/images/logo-var-main.png" alt="">
    </div>
    <div class="header_options">
        <div class="burger_menu">
            <i class="fas fa-bars"></i>
        </div>
        <div class="search_block">
            <input type="text" placeholder="<?= Lang::_('SEARCH') ?>">
            <i class="fas fa-search"></i>
        </div>
        <ul class="menu">
            <li>
                <a href="/"><?= Lang::_('MAIN') ?></a>
                <i class="close_menu far fa-window-close"></i>
            </li>

            <li>
                <a class="for_desktop_item" href=/archdiocese><?= Lang::_('ARCHDIOCESE') ?>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="for_mobile_item">
                    <span><?= Lang::_('ARCHDIOCESE') ?></span>
                    <i class="fas fa-angle-down"></i>

                </div>
                <ul class="submenu">
                    <li><a href=/archdiocese/archbishop><?= Lang::_('ARCHBISHOP') ?></a></li>
                    <li><a href=/archdiocese/parishes><?= Lang::_('PARISHES') ?></a></li>
                    <li><a href=/archdiocese/bishophor><?= Lang::_('BISHOP_HOR') ?></a></li>
                    <li><a href=/archdiocese/statute><?= Lang::_('STATUTE') ?></a></li>
                    <li><a href=/archdiocese/camp><?= Lang::_('CHILDREN_CAMP') ?></a></li>
                </ul>
            </li>

            <li>
                <a class="for_desktop_item" href=/news><?= Lang::_('NEWS') ?>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="for_mobile_item">
                    <span><?= Lang::_('NEWS') ?></span>
                    <i class="fas fa-angle-down"></i>

                </div>
                <ul class="submenu">
                    <li><a href=/news/archdiocese><?= Lang::_('NEWS_ARCHDIOCESE') ?></a></li>
                    <li><a href=/news/parishes><?= Lang::_('NEWS_PARISHES') ?></a></li>
                    <li><a href=/news/culture><?= Lang::_('CULTURE') ?></a></li>
                    <li><a href=/news/events><?= Lang::_('UPCOMING_EVENTS') ?></a></li>
                </ul>
            </li>
            <li>
                <a class="for_desktop_item" href=/document/><?= Lang::_('DOCUMENTS') ?>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="for_mobile_item">
                    <span><?= Lang::_('DOCUMENTS') ?></span>
                    <i class="fas fa-angle-down"></i>

                </div>
                <ul class="submenu">
                    <li><a href=/document/sermons><?= Lang::_('SERMONS_ARCHBISHOP') ?></a></li>
                    <li><a href=/document/interview><?= Lang::_('INTERVIEW') ?></a></li>
                    <li><a href=/document/performances><?= Lang::_('PERFORMANCES') ?></a></li>
                    <li><a href=/document/resolutions><?= Lang::_('RESOLUTION_CATHEDRAL') ?></a></li>
                    <li><a href=/document/councils><?= Lang::_('COUNCILS_METROPOLIS') ?></a></li>
                    <li><a href=/document/community><?= Lang::_('COMMUNITY_DOCUMENTS') ?></a></li>
                </ul>
            </li>
            <li>
                <a class="for_desktop_item" href=/books><?= Lang::_('BOOKS_BLOCK') ?>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="for_mobile_item">
                    <span><?= Lang::_('BOOKS_BLOCK') ?></span>
                    <i class="fas fa-angle-down"></i>

                </div>
                <ul class="submenu">
                    <li><a href=/books/learn><?= Lang::_('LEARN_BOOKS') ?></a></li>
                    <li><a href=/books/worship><?= Lang::_('WORSHIP_BOOKS') ?></a></li>
                    <li><a href=/books/lifesaints><?= Lang::_('LIFE_SAINTS_BOOKS') ?></a></li>
                    <li><a href=/books/studies><?= Lang::_('STUDIES_STAROOBR') ?></a></li>
                    <li><a href=/books/writer><?= Lang::_('AUTHOR_PAGE') ?></a></li>
                </ul>
            </li>
            <li>
                <a class="for_desktop_item" href=/galleries><?= Lang::_('GALLERIES') ?>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="for_mobile_item">
                    <span><?= Lang::_('GALLERIES') ?></span>
                    <i class="fas fa-angle-down"></i>

                </div>
                <ul class="submenu">
                    <li><a href=/galleries/photo><?= Lang::_('PHOTO_ALBUM') ?></a></li>
                    <li><a href=/galleries/audio><?= Lang::_('AUDIO_ALBUM') ?></a></li>
                    <li><a href=/galleries/video><?= Lang::_('VIDEO_ALBUM') ?></a></li>
                </ul>
            </li>
            <li>
                <a class="for_desktop_item" href=/store><?= Lang::_('STORE') ?>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="for_mobile_item">
                    <span><?= Lang::_('STORE') ?></span>
                    <i class="fas fa-angle-down"></i>
                </div>
                <ul class="submenu">
                    <?php if (\core\User::isAdmin()) { ?>
                        <li><a href=/store/addproduct><?= Lang::_('ADD_PRODUCT') ?></a></li>
                    <?php } ?>
                    <li><a href=/store/lithium><?= Lang::_('LITHIUM') ?></a></li>
                    <li><a href=/store/brain><?= Lang::_('CHURCH_BRAIN') ?></a></li>
                    <li><a href=/store/literature><?= Lang::_('LITERATURE') ?></a></li>
                    <li><a href=/store/candles><?= Lang::_('CANDLES') ?></a></li>
                    <li><a href=/store/incense><?= Lang::_('INCENSE') ?></a></li>
                    <li><a href=/store/setrites><?= Lang::_('SET_RITES') ?></a></li>
                    <li><a href=/store/clothes><?= Lang::_('CLOTHING_TEXTILES') ?></a></li>
                    <li><a href=/store/vestments><?= Lang::_('CHURCH_VESTMENTS') ?></a></li>
                    <li><a href=/store/trainers><?= Lang::_('TRAINERS_LADDERS') ?></a></li>
                </ul>
            </li>
            <li>
                <a class="for_desktop_item" href=/all>
                    <?= Lang::_('PUBLIC') ?>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="for_mobile_item">
                    <span><?= Lang::_('PUBLIC') ?></span>
                    <i class="fas fa-angle-down"></i>
                </div>
                <ul class="submenu">
                    <li><a href=/all/alms><?= Lang::_('ALMS') ?></a></li>
                    <li><a href=/all/forum><?= Lang::_('FORUM') ?></a></li>
                </ul>
            </li>
            <?php if (!\core\User::authorised()) { ?>
                <li class="registration"><span class="a"><?= Lang::_('REGISTRATION') ?></span></li>

            <?php } ?>

            <?php if (\core\User::authorised()) { ?>
                <li><a href="/auth/logout"><?= Lang::_('SIGNOUT') ?></a></li>
            <?php } else { ?>
                <li class="login"><span class="a"><?= Lang::_('LOGIN') ?></span></li>
            <?php } ?>

            <div class="search_block">
                <input type="text" placeholder="<?= Lang::_('SEARCH') ?>">
                <i class="fas fa-search"></i>
            </div>
        </ul>

    </div>
</div>
