<?php

namespace App\Controllers;

use App\Models\Participaint;
use App\Core\Controller as Controller;

class AjaxParticipaintController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Participaint('participaints');
    }

    public function index()
    {
        return viewAjax('index');
    }

    public function additional()
    {
        return viewAjax('additional');
    }

    public function share()
    {
        $participaints = $this->model->select();
        return viewAjax('share', ['num'=> count($participaints)]);
    }

    public function store()
    {
        $indexForm = $_POST['indexForm'];
        $this->model->save( $indexForm);

        session_start();
        $_SESSION['email']=$indexForm['email'];

        return showResult(['code' => 0]);

    }

    public function checkSessionEmail()
    {
        session_start();

        if ($_SESSION['email']) {
            $code = 0;
            $email = $_SESSION['email'];
        } else {
            $code = 1;
            $email = 'unknown email';
        }

        return showResult(['code' => $code, 'email'=> $email]);
    }

    public function additSave()
    {
        $result = [
            'code' => 0,
            'detail' => ''
        ];

        session_start();
        if ($_SESSION['email']) {

            $email = $_SESSION['email'];
            $additionalForm = $_POST["additionalForm"];

            $result['dbDetail'] = $this->model->update($additionalForm, ['email' => $email]);

            if($_FILES['photo']['tmp_name']) {
                $photoPath = $_FILES['photo']['tmp_name'];
                $errorCode = $_FILES['photo']['error'];
                $resultPhoto =  $this->model->savePhoto($photoPath, $errorCode, ['email' => $email]) ;
                $result['photoDetail'] = $resultPhoto['detail'];
                $result['photoCode'] = $resultPhoto['code'];
            } else {
                if($_FILES['photo']['error'] == 1 || $_FILES['photo']['error'] == 2) {
                    $result['photoDetail'] = 'Photo did\' t save. Photo size is too big.';
                    $result['photoCode'] = 1;
                } else {
                    if($_FILES['photo']['error'] == 4) {
                        $result['photoDetail'] = 'No photo';
                        $result['photoCode'] = 0;
                    }
                }

            }

        } else {
            $result['code'] = 1;
            $result['detail'] = "Incorrect input data or email unknown email.";
        }

        return showResult($result);
    }

    public function existEmail()
    {
        $result = [
            'code' => 0,
            'detail' => ''
        ];

        if (isset($_POST["email"])) {
            $email = $_POST["email"];
            $result['data'] = $this->model->existEmail($email);
            $result['detail'] = "I check an email.";
        } else {
            $result['code'] = 1;
            $result['detail'] = "Incorrect input data.";
        }
        return showResult($result);
    }
}