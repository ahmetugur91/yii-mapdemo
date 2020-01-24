<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lokasyonlar</div>
                <div class="card-body">
                    <div class="form-group">
                        <a href="/?r=location/create" class="btn btn-primary">Yeni Lokasyon</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-condensed">
                            <thead>
                            <tr class="bg-light">
                                <th>Üye</th>
                                <th>Lokasyon Adı</th>
                                <th>Şehir</th>
                                <th>İlçe</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($locations as $location): ?>
                                <tr>
                                    <td><?php echo $location->user->username; ?></td>
                                    <td><?php echo $location->name; ?></td>
                                    <td><?php echo $location->city; ?></td>
                                    <td><?php echo $location->district; ?></td>
                                    <td>
                                        <div class="btn-group">


                                            <a href="" class="btn btn-info btn-sm text-white"><i
                                                        class="icon icon-map-marker"></i> İncele</a>


                                            <a href="" class="btn btn-primary btn-sm text-white"><i
                                                        class="icon icon-edit"></i> Düzenle</a>


                                            <button class="btn btn-danger btn-sm text-white"
                                                    onclick="if(confirm('Emin misiniz?')) { event.preventDefault();document.getElementById('delete_location_<?php echo $location->id; ?>').submit();} else return false;">
                                                <i class="icon icon-trash"></i> Sil
                                            </button>


                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php $this->widget('CLinkPager', array(

                            'currentPage' => $pages->getCurrentPage(),

                            'itemCount' => $item_count,

                            'pageSize' => $page_size,

                            'maxButtonCount' => 5,

                            //'nextPageLabel'=>'My text >',

                            'header' => '',
                            'internalPageCssClass' => 'page-item',

                            'htmlOptions' => array('class' => 'pagination pg-blue'),


                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>