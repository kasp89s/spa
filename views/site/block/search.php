<?php
    use yii\helpers\Url;

    $dates = [
        '01' => 'Январь',
        '02' => 'Февраль',
        '03' => 'Март',
        '04' => 'Апрель',
        '05' => 'Май',
        '06' => 'Июнь',
        '07' => 'Июль',
        '08' => 'Август',
        '09' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'декабрь',
    ];
    $currentMonth = date('m', time());
?>
<div class="container">
    <div class="search">
        <div class="top">
            <div class="col-md-6">
                Поиск санатория
            </div>
            <div class="col-md-6 sales">
                <a href="<?= Url::to(['shares'])?>">
                    акции и скидки
                </a>
            </div>
        </div>
        <div class="bottom">
            <form action="<?= Url::to(['search'])?>">
                <div class="top-s">
                    <div class="col-md-4 input">
                        <label>Куда бы вы хотели отправится?</label><br>
                        <input name="search" placeholder="укажите страну, город или название санатория">
                    </div>
                    <div class="col-md-4 input month-selector-from">
                        <label>Дата приезда</label><br>
                        <input name="from_d" placeholder="день" class="small" type="number" min="1" max="31">
                        <div class="big">
                            <select name="from_m">
                                <optgroup>
                                    <option value="0">Месяц</option>
                                    <?php foreach ($dates as $key => $value):?>
                                        <option value="<?= $key?>"><?= $value?></option>
                                    <?php endforeach;?>
                                </optgroup>
                            </select>
                        </div>
                        <input name="from_y" class="cal" value="<?= date("Y", time())?>" readonly>
                    </div>
                    <div class="col-md-4 input month-selector-to">
                        <label>Дата отъезда</label><br>
                        <input name="to_d" placeholder="день" class="small" type="number" min="1" max="31">
                        <div class="big">
                            <select name="to_m">
                                <optgroup>
                                    <option value="0">Месяц</option>
                                    <?php foreach ($dates as $key => $value):?>
                                        <option value="<?= $key?>"><?= $value?></option>
                                    <?php endforeach;?>
                                </optgroup>
                            </select>
                        </div>
                        <input name="to_y" class="cal" value="<?= date("Y", time())?>" readonly>
                    </div>
                </div>
                <div class="bottom-s">
                    <div class="col-md-8 input">
                        <div class="col-md-6">
                            <label>Количество человек</label><br>
                            <div class="big">
                                <select name="quantityType">
                                    <optgroup>
                                        <option value="SGL">Взрослых 1</option>
                                        <option value="DBL">Взрослых 2</option>
                                        <option value="EXB">Взрослых 3</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Питание и лечение</label><br>
                            <div class="big">
                                <select name="supplyType">
                                    <optgroup>
                                        <option value="HBT">2-х разовое питание с лечением</option>
                                        <option value="FBT">3-х разовое питание с лечением</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 input">
                        <button type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> &nbsp;&nbsp; Найти
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
