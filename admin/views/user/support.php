<p class="user-es">Добро пожаловать, <?= $user->username;?></p>
<div class="middle">
    <div class="balance">
        Баланс: <strong><?= number_format($user->balance, 0, '', ' ')?></strong> <i class="rub">p</i>,
        за сегодня: <strong>500</strong> <i class="rub">p</i>
    </div>
    <p>По всем вопросам пишите на почту:</p>
    <p>E-mail: <a href="mailto:dev.null@mail.com" class="link-mail"><span>dev.null@mail.com</span></a></p>
    <p>Мы с удовольствием предложим вам помощь по любому вопросу.</p>
</div>