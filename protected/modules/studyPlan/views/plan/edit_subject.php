<?php
/**
 * @var PlanController $this
 * @var StudySubject $model
 * @var TbActiveForm $form
 */
?>
    <style>
        .input,
        .options {
            float: left;
        }

        .options input {
            float: left;
        }

        .options {
            margin: 15px 0 0 15px;
        }

        .options:after {
            content: '';
            display: block;
            clear: both;
        }

        .options .item {
            float: left;
            width: 125px;
        }

        .span5 input[type="number"] {
            width: 170px;
        }

        #StudySubject_subject_id {
            width: 100%;
        }
    </style>
<?php $form = $this->beginWidget(Booster::FORM, array(
    'htmlOptions' => array(
        'class' => 'well row',
    )
)); ?>
    <h3>Редагування предмету у навчальному плані</h3>
<?php echo $form->errorSummary($model); ?>
    <div class="span3">
        <?php echo $form->dropDownListRow($model, 'subject_id',
            Subject::getListForSpeciality($model->plan->speciality_id)); ?>
        <?php echo $form->numberFieldRow($model, 'total'); ?>
        <?php echo $form->numberFieldRow($model, 'lectures'); ?>
        <?php echo $form->numberFieldRow($model, 'labs'); ?>
        <?php echo $form->numberFieldRow($model, 'practs'); ?>
    </div>
    <div class="span5">
        <?php foreach ($model->plan->semesters as $semester => $weeks): ?>
            <div class="input">
                <?php echo CHtml::label($semester + 1 . '-й семестр: ' . $weeks . ' тижнів', 'StudySubject_weeks_' . $semester); ?>
                <?php echo $form->numberField($model, "weeks[$semester]", array('placeholder' => 'годин на тиждень')); ?>
            </div>
            <div class="options">
                <div class="item">
                    <?php echo $form->radioButtonList($model, "control[$semester][0]",
                        PlanHelper::getControlTypes(), array('template' => '{input}{label}', 'separator' => ' ')); ?>
                </div>
                <div class="item">
                    <?php echo $form->checkBox($model, "control[$semester][1]"); ?>
                    <?php echo CHtml::label(Yii::t('terms', 'Course work'), "StudySubject_control_{$semester}_1"); ?>
                    <?php echo $form->checkBox($model, "control[$semester][2]"); ?>
                    <?php echo CHtml::label(Yii::t('terms', 'Course project'), "StudySubject_control_{$semester}_2"); ?>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php endforeach; ?>
    </div>
    <div style="clear: both"></div>
    <div class="form-actions" style="width: 300px; margin: 0 auto">
        <?php echo CHtml::submitButton('Зберегти', array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::link('Повернутись', $this->createUrl('subjects', array('id' => $model->plan_id)), array('class' => 'btn btn-info')); ?>
    </div>
<?php $this->endWidget(); ?>