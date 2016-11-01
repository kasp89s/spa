<div class="slide1">
    <div class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="/img/slide1.jpg" alt="...">
                <div class="container">
                    <div class="carousel-caption">
                        <? if(!empty($this->params['currentAlias'])):?>
                        <h3><?= $this->params['pages'][$this->params['currentAlias']]->title?></h3>
                        <p><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Домашняя станица</a> > <a href="/<?= $this->params['pages'][$this->params['currentAlias']]->alias?>"><?= $this->params['pages'][$this->params['currentAlias']]->title?></a></p>
                        <? elseif(empty($this->params['brecrumbs']['notFound'])):?>
                            <h3>
                                <?= !empty($this->params['brecrumbs']['title']) ? $this->params['brecrumbs']['title'] : '' ?>
                                <span>
                              <?php if (!empty($this->params['brecrumbs']['searchText'])):?>
                              <span class="glyphicon glyphicon glyphicon-tag" aria-hidden="true"></span><?= $this->params['brecrumbs']['searchText']?> &nbsp;&nbsp;&nbsp;&nbsp;
                              <?php endif;?>
                              <?php if (!empty($this->params['brecrumbs']['period_from']) && !empty($this->params['brecrumbs']['period_to'])):?>
                              <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?= $this->params['brecrumbs']['period_from']?> - <?= $this->params['brecrumbs']['period_to']?> &nbsp;&nbsp;&nbsp;&nbsp;
                              <?php endif;?>
                              <?php if (!empty($this->params['brecrumbs']['quantityType'])):?>
                              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>	<?= $this->params['brecrumbs']['quantityType']?></span>
                              <?php endif;?>
                            </h3>

                              <p>
                                  <a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Домашняя станица</a>
                                  <?php if (!empty($this->params['brecrumbs']['pageName'])):?>
                                  <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> <a href="<?= $this->params['brecrumbs']['pageUrl']?>"><?= $this->params['brecrumbs']['pageName']?></a>
                                  <?php endif;?>
                                  <?php if (
                                      !empty($this->params['brecrumbs']['period_from']) &&
                                      !empty($this->params['brecrumbs']['period_to']) &&
                                      \Yii::$app->controller->action->id == 'search'
                                  ):?>
                                  <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Доступно <?= $this->params['totalCount']?> cанаториев c наличием свободных номеров в дате от <?= $this->params['brecrumbs']['period_from']?> до <?= $this->params['brecrumbs']['period_to']?>
                                  <?php endif;?>
                                  <?php if (
                                      !empty($this->params['brecrumbs']['period_from']) &&
                                      !empty($this->params['brecrumbs']['period_to']) &&
                                      \Yii::$app->controller->action->id == 'hotel'
                                  ):?>
                                  <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Доступно <?= $this->params['totalCount']?> свободных номеров в дате от <?= $this->params['brecrumbs']['period_from']?> до <?= $this->params['brecrumbs']['period_to']?>
                                  <?php endif;?>
                                  <?php if (\Yii::$app->controller->action->id == 'request'):?>
                                      <?php if (!empty($this->params['brecrumbs']['town'])):?>
                                          <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> <a href="<?= $this->params['brecrumbs']['townUrl']?>"><?= $this->params['brecrumbs']['town']?></a>
                                      <?php endif;?>
                                      <?php if (!empty($this->params['brecrumbs']['hotel'])):?>
                                          <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> <a href="<?= $this->params['brecrumbs']['hotelUrl']?>"><?= $this->params['brecrumbs']['hotel']?></a>
                                      <?php endif;?>
                                      <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Бронирование
                                  <?php endif;?>
                              </p>
                        <? endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<div class="top">
    <div class="nav-top">
        <div class="container">
            <div class="col-md-4">
                <div class="logo">
                    <a href="/"><img src="/img/logo.png" alt="..."></a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="contacts">
                    <div class="col-md-4">
                        <div class="canal">
                            многоканальный
                        </div>
                        <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>+7 (727) 333-60-80
                    </div>
                    <div class="col-md-4">
                        +7 701 388-83-57
                    </div>
                    <div class="col-md-4">
                        <div class="canal">
                            или напишите нам на
                        </div>
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>info@spa-medtravel.kz
                        <?//  var_dump(\Yii::$app->session->get('agency'))?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-bottom">
        <div class="container">
            <div class="col-md-6">
                <ul class="nav navbar-nav">
                    <li><a href="/<?= $this->params['pages']['doctors']->alias?>"><?= $this->params['pages']['doctors']->title?></a></li>
                    <li><a href="/<?= $this->params['pages']['visa']->alias?>"><?= $this->params['pages']['visa']->title?></a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="nav navbar-nav">
                    <li><a href="/<?= $this->params['pages']['about']->alias?>"><?= $this->params['pages']['about']->title?></a></li>
                    <li><a href="/<?= $this->params['pages']['contacts']->alias?>"><?= $this->params['pages']['contacts']->title?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
