<p class="user-es">Добро пожаловать, <?= $user->username;?></p>
<div class="middle">
    <div class="balance">
        Баланс: <strong><?= number_format($user->balance, 0, '', ' ')?></strong> <i class="rub">p</i>,
        за сегодня: <strong>500</strong> <i class="rub">p</i>
    </div>

    <div class="partner-account">
        <form action="#">
            <div class="line-block clearfix">
                <div class="l-acc">
                    <p>
                        <span>WMR кошелек:</span>
                        <input type="text" value="" placeholder="R2839450393945" />
                    </p>
                    <p>
                        <span>Новый пароль:</span>
                        <input type="password" value="" placeholder="**************" />
                    </p>
                    <p>
                        <span>Старый пароль:</span>
                        <input type="password" value="" placeholder="**************" />
                    </p>
                    <p>
                        <input type="submit" value="Сохранить" />
                    </p>
                </div>
                <div class="r-acc">
                    <p>Ваша партнерская ссылка: <a href="http://videopartner.pro/partner.php?id=532846">http://videopartner.pro/partner.php?id=532846</a></p>
                    <p>Ваша реферральная ссылка: <a href="http://videopartner.pro/ref.php?id=532846">http://videopartner.pro/ref.php?id=532846</a></p>
                </div>
            </div>
        </form>
    </div>
</div>