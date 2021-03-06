<?php
/* @var $this ActualClassController */
/* @var $model ActualClass */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget(BoosterHelper::FORM, array(
        'id' => 'actual-class-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note"><?php echo Yii::t('base', 'Fields with <span class="required">*</span> are required.') ?></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->datePickerRow($model, 'date'); ?>

    <?php echo $form->textFieldRow($model, 'class_number'); ?>

    <?php echo $form->textFieldRow($model, 'teacher_load_id'); ?>

    <?php echo $form->textFieldRow($model, 'class_type'); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('base', 'Create') : Yii::t('base', 'Save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->