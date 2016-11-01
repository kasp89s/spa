<p class="user-es">Добро пожаловать, <?= $user->username;?></p>
<div class="middle">
    <div class="balance">
        Баланс: <strong><?= number_format($user->balance, 0, '', ' ')?></strong> <i class="rub">p</i>,
        за сегодня: <strong>500</strong> <i class="rub">p</i>
    </div>
    <div class="graphic">
        <div class="date-selection">
            <form action="#">
                Начиная с:
                <label><input type="text" value="" id="datepicker" /></label>
                заканчивая:
                <label><input type="text" value="" id="datepicker2" /></label>
                <input type="submit" value="Вывести" />
            </form>
        </div>
        <div class="diagram">
            <img src="/web/images/diagram.jpg" alt="" />
        </div>
        <table class="table">
            <tr>
                <th>Дата</th>
                <th>Регистраций</th>
                <th>Доход с пополнений</th>
                <th>Доход с рефералов</th>
                <th>Сумма</th>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
            <tr>
                <td>10.12.2015</td>
                <td>86</td>
                <td>9 384 руб</td>
                <td>3 450 руб</td>
                <td>12 834 руб</td>
            </tr>
        </table>
        <p class="shown-entries">Показаны записи: 11-20</p>
        <div class="bot-nav">
            <ul>
                <li><a href="#">Назад</a></li>
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">25</a></li>
                <li><a href="#">Далее</a></li>
            </ul>
        </div>
    </div>
</div><!--.middle-->