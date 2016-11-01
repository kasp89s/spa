<footer>
    <div class="footer-top">
        <div class="container">
            <div class="col-md-3">
                <h3><span class="glyphicon glyphicon-home" aria-hidden="true"></span> &nbsp;&nbsp;Spa Medical travel
                </h3>
                <ul>
                    <li><a href="/<?= $this->params['pages']['company']->alias?>"><?= $this->params['pages']['company']->title?></a></li>
                    <li><a href="/<?= $this->params['pages']['contacts']->alias?>"><?= $this->params['pages']['contacts']->title?></a></li>
                    <li><a href="/<?= $this->params['pages']['travel']->alias?>"><?= $this->params['pages']['travel']->title?></a></li>
                    <li><a href="/<?= $this->params['pages']['doctors']->alias?>"><?= $this->params['pages']['doctors']->title?></a></li>
                    <li><a href="/<?= $this->params['pages']['visa']->alias?>"><?= $this->params['pages']['visa']->title?></a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;&nbsp;Партнерам
                </h3>
                <ul>
                    <?php if (!\Yii::$app->session->get('agency')):?>
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#agency-login-modal">Вход для агенств</a></li>
                    <?php endif;?>
                    <li><a href="#">Вход для отелей</a></li>
                    <li><a href="/<?= $this->params['pages']['information']->alias?>"><?= $this->params['pages']['information']->title?></a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Контакты</h3>
                <div class="text">
                    Республика Казахстан, Алматы, ул. Тимирязева 15-б, офис 17
                </div>
                <div class="number">
                    <div>Многоканальный</div>
                    +7 (727) 333-60-80
                </div>
            </div>
            <div class="col-md-3">
                <h3>Подпишись на рассылку</h3>
                <form>
                    <label>Ваш email:</label><br>
                    <input type="email" id="subscribe-email">
					<button type="button" class="subscribe"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp; Добавить</button>
                </form>
                <div class="conf">Ваша информация останется конфенденциальной
                    и будет использоватся  для рассылки спец. предложений</div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright">
                <img src="/img/fot-logo.png" /><br>
                Copyright © 2010–2016 Spa-medtravel.kz™. Все права защищены.
            </div>
                        <div class="metrica">
<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.kz/stat/?id=37771885&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/37771885/3_0_FFFFFFFF_EFEFEFFF_0_visits"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:37771885,lang:'ru'});return false}catch(e){}" /></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script src="https://mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<script type="text/javascript">
try {
    var yaCounter37771885 = new Ya.Metrika({
        id:37771885,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
} catch(e) { }
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/37771885" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
            </div>
            <div class="creative">
                <img src="/img/creative.png" /><br>
                За сайтом приглядывает Creative team. <a href="http://c-tm.kz/" target="_blank">Создание сайтов в Алматы</a>
            </div>
        </div>
    </div>
</footer>
