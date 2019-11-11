<?php

namespace App\Core;

class Model

{

    private $table;

    public function __construct($table)
    {
        $this->table = $table;
    }


    public function select()
    {
        return  App::get('database')->sellectAll($this->table);
    }

    public function save($parameters)
    {
        return  App::get('database')->insert($this->table, $parameters);
    }

    public function update($parameters, $where)
    {
        return  App::get('database')->update($this->table, $parameters, $where);
    }

    public function existEmail($email)
    {
        $email = App::get('database')->selectFrom($this->table, 'email', $email);
        if ($email) {
            return 1;
        } else {
            return 0;
        }
    }

    public function savePhoto($filePath, $errorCode, $where) {

        $result = [
            'code' => 0,
            'detail' => ''
        ];

        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
            // Массив с названиями ошибок
            $result['code'] = 1;
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];
            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            $result['detail'] = $outputMessage;
        } else {

            $image = getimagesize($filePath);
            // Зададим ограничения для картинок
            $limitBytes  = 1024 * 1024 * 5;
            // Проверим нужные параметры
            if (filesize($filePath) > $limitBytes) {

                $result['code'] = 1;
                $result['detail'] = "Размер изображения не должен превышать 2 Мбайт.";

            } else {

                $image = getimagesize($filePath);

                // Сгенерируем новое имя файла на основе MD5-хеша
                $name = md5(microtime() . rand(0, 9999));
                //$name = md5_file($filePath);
                // Сгенерируем расширение файла на основе типа картинки
                $extension = image_type_to_extension($image[2]);
                // Сократим .jpeg до .jpg
                $format = str_replace('jpeg', 'jpg', $extension);
                // Переместим картинку с новым именем и расширением в папку /pics
                $rootDir = dirname(__DIR__,1);
                $fullPath = $rootDir."/public/images/";

                if (!move_uploaded_file($filePath, $fullPath . $name . $format)) {
                    $result['code'] = 1;
                    $result['detail'] = "При записи изображения на диск произошла ошибка";
                    die('При записи изображения на диск произошла ошибка.');
                } else {
                    $fileName = $name.$format;

                    if (App::get('database')->update($this->table, ['photo' => $fileName], $where)) {
                        $result['detail'] = "Records UPDATED (photo) successfully";
                    } else {
                        $result['code'] = 1;
                        $result['detail'] = "Whoops, something went wrong.";
                    }
                }

            }

        }

        return $result;

    }
}