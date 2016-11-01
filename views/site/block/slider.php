<?php if(!empty($this->params['slider'])):?>
<div class="slide">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
			<?php foreach ($this->params['slider'] as $key => $slide):?>
            <div class="item <?= ($key == 0) ? 'active' : ''?>">
                <img src="/uploads/slider/<?= $slide->image?>" alt="">
                <div class="container">
                    <div class="carousel-caption">
                        <p>Как выбрать правильный курорт в Чехии?</p>
                        <h3>Мы поможем!<span> Более 200 санаториев</span></h3>
                    </div> 
                </div>
            </div>
			<?php endforeach;?>
        </div>
    </div>
</div>
<?endif;?>
