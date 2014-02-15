<?php
/**
 * GroupController
 *
 * @author Dmytro Karpovych <ZAYEC77@gmail.com>
 */

class GroupController extends Controller
{
    public $name = "Groups";
    /**
     *
     */
    public function actionIndex()
    {
        $provider = Group::model()->getProvider();
        $this->render(
            'index',
            array(
                'provider' => $provider,
            )
        );
    }

    /**
     *
     */
    public function actionCreate()
    {
        $model = new Group();

        $this->ajaxValidation('group-form', $model);

        if (isset($_POST['Group'])) {
            $model->attributes = $_POST['Group'];
            if ($model->save()) {
                $this->redirect(array('group/index'));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Group::model()->loadContent($id);

        $this->ajaxValidation('group-form', $model);

        $this->render(
          'update',
            array(
                'model'=>$model,
            )
        );
    }
    /**
     * @param $id
     */
    public function actionView($id)
    {
        $model = Group::model()->loadContent($id);
        $this->render(
            'view',
            array(
                'model' => $model,
            )
        );
    }

    public function actionDelete($id)
    {
        $model = Group::model()->loadContent($id);
        $model->delete();
    }
}