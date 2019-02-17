<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Books;
use app\models\Record;
use app\models\Borrowing;
use app\models\SearchForm;

class BooksController extends Controller
{
    public function actionIndex()
    {
        $bookName = '';

        $searchForm = Yii::$app->request->post('SearchForm');

        if ($searchForm) {
            $bookName = $searchForm['bookName'];
        }

        $subQuery = (new \yii\db\Query())
                    ->select(['id' => 'record.bookId'])
                    ->from('borrowing')
                    ->leftJoin('record', 'record.id = borrowing.recordId');

        $query = Books::find()
                ->where(['like', 'name', $bookName])
                ->andWhere(['not in', 'id', $subQuery]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    //搜索
    public function actionSearch()
    {
        $model = new SearchForm;

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(array('index', [
                'bookName' => $model->bookName
            ]));
        }

        return $this->render('search', [
            'model' => $model
        ]);
    }

    //借阅
    public function actionBorrow()
    {
        if ($bookId = Yii::$app->request->get('id')) {
            //获取用户
            $user = Yii::$app->user->identity;
            //插入借阅记录
            $record = new Record;
            $record->bookId = $bookId;
            $record->userId = $user->id;
            $record->type = 1;
            $record->time = date("Y-m-d H:i:s",time());
            $record->insert();
            
            //插入借阅关系
            $borrowing = new Borrowing;
            $borrowing->recordId = $record->id;
            $borrowing->insert();
        }
        return $this->goBack();
    }
}

?>