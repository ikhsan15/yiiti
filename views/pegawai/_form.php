<?php

use yii\helpers\ArrayHelper; // ditambahkan, utk memanggil ArrayHelper
use app\models\Jabatan;   // panggil master table jabatan
use app\models\Divisi;  // panggil master table divisi
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-form">

    
    <?php $form = ActiveForm::begin( ['options'=>['enctype'=>'multipart/form-data']] ); ?>
    
    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    
    <?php //= $form->field($model, 'idjabatan')->textInput() 
     // ambil data dari model masternya
    // ini menggunakan PHP murni
        $dataList = ArrayHelper::map(Jabatan::find()->asArray()->all(),'id','nama');

    ?>      
    <?= $form->field($model, 'idjabatan')->dropDownList($dataList,['prompt'=>'-----------Pilih Jabatan--------------'])

    ?>
    <?php //= $form->field($model, 'iddivisi')->textInput() 
     // ambil data dari model masternya
    // ini menggunakan PHP murni
        $dataList = ArrayHelper::map(Divisi::find()->asArray()->all(),'id','nama');

    ?>      
    <?= $form->field($model, 'iddivisi')->dropDownList($dataList,['prompt'=>'-----------Pilih Divisi--------------'])

    ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'fotoFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
