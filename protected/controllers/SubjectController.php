<?php
/**
 * @author Dmytro Karpovych <ZAYEC77@gmail.com>
 */

class SubjectController extends Controller
{
    public $name = 'Subjects';

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Subject;

        if (isset($_POST['Subject'])) {
            $model->attributes = $_POST['Subject'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        if (!Yii::app()->request->isAjaxRequest)
            unset(Yii::app()->session['subject']);
        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionAddRelation($id = null)
    {
        if (isset($_POST['SubjectRelation'])) {
            if (!isset(Yii::app()->session['subject'])) {
                Yii::app()->session['subject'] = array('add' => array(), 'delete' => array());
            }
            $subject = Yii::app()->session['subject'];
            $obj = new SubjectRelation();
            $obj->setAttributes(CMap::mergeArray(array('subject_id' => $id), $_POST['SubjectRelation']),false);
            $subject['add'][$obj->getId()] = $obj;
            for ($i =0; $i <count($subject['delete']);$i++) {
                if ($obj->getId() == $subject['delete'][$i]['id']) {
                    unset($subject['delete'][$i]);
                    break;
                }
            }
            Yii::app()->session['subject'] = $subject;
            $this->renderPartial('_subjectRelation', array('id' => $id));
        }
    }

    public function actionRemoveRelation($id1, $id2, $id3)
    {
        if (!isset(Yii::app()->session['subject'])) {
            Yii::app()->session['subject'] = array('add' => array(), 'delete' => array());
        }
        $subject = Yii::app()->session['subject'];
        $subject['delete'][] = array('id' => $id1 . '.' . $id2 . '.' . $id3);
        Yii::app()->session['subject'] = $subject;
        $this->renderPartial('_subjectRelation', array('id' => $id1));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = Subject::model()->loadContent($id);

        $this->ajaxValidation('subject-form', $model);

        if (isset($_POST['Subject'])) {
            $model->attributes = $_POST['Subject'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        if (!Yii::app()->request->isAjaxRequest)
            unset(Yii::app()->session['subject']);
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * @param $id
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            Subject::model()->loadContent($id)->delete();
            unset(Yii::app()->session['subject']);
            if (!isset($_GET['ajax']))
                $this->redirect(array('index'));
        } else
            throw new CHttpException(400, Yii::t('base', 'Invalid request. Please do not repeat this request again.'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Subject');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}
