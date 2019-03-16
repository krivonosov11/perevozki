<?php

?>
<div class="content">
    <div class="header">
        <span><?= Lang::_('PLEASE_SELECT_PARAMETRS') ?></span>
    </div>
    <div class="parametrs">
        <div class="item-parametrs">
            <label for="">
                <span><?= Lang::_('COUNTRY') ?></span>
                <select name="" id="">
                    <option value="">Украина</option>
                </select>
            </label>
            <label for="">
                <span><?= Lang::_('AREA') ?></span>
                <select name="" id="areas">
                    <?php foreach ($areas as $val) { ?>
                        <option value="<?= $val['id'] ?>"><?= $val['title'] ?></option>
                    <?php } ?>
                </select>
            </label>
            <label for="">
                <span><?= Lang::_('CITY') ?></span>
                <select name="" id="citys">
                    <?php foreach ($city as $val) { ?>
                        <option value="<?= $val['id'] ?>"><?= $val['title'] ?></option>
                    <?php } ?>
                </select>
            </label>
        </div>
    </div>
</div>
