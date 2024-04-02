<?php

namespace Controller;

use Model\Address;
use Illuminate\Database\Capsule\Manager as DB;
use Model\Composition;
use Model\Employee;
use Model\Post;
use Model\Unit;
use Model\User;
use Src\View;
use Src\Request;
use Src\Validator\Validator;
use Src\Auth\Auth;
use Illuminate\Http\UploadedFile;
class Site
{
    public function index(Request $request): string
    {
        $employees = Employee::all(); // Получаем всех пользователей

        $units = Unit::all();

        $compositions = Composition::all();

        return new View('site.index', ['employees' => $employees, 'units' => $units, 'compositions' => $compositions, 'title' => 'Главная']);
    }
    public function post(Request $request): string
    {

        if ($request->method === 'POST' && Post::create($request->all())) {
            app()->route->redirect('/post');
        }

        $posts = Post::all();

        return new View('site.post' , ['title' => 'Должность', 'posts' => $posts]);

    }
    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        // Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login', ['title' => 'Вход']);
        }

        // Если удалось аутентифицировать пользователя
        if (Auth::attempt($request->all())) {
            $user = Auth::user();

            // Проверяем id_role пользователя и делаем редирект
            if ($user->id_role === 1) {
                app()->route->redirect('/signup');
            } elseif ($user->id_role === 2) {
                app()->route->redirect('/');
            }
        }

        // Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }
    public function employee(Request $request): string
    {
        $genders = ['Мужской', 'Женский']; // Массив с вариантами пола

        if ($request->method === 'POST') {
            $data = $request->all();

            $image = $request->all()['img'];
            $image_name = $image['name'];
            $tmp_image = $image['tmp_name'];
            $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);

            $new_path = __DIR__ . '/images/';
            if (!file_exists($new_path)) {
                mkdir($new_path, 0777, true);
            }
            $new_image_name = uniqid("IMG-", true) . '.' . $img_ex;
            $file_path = $new_path . $new_image_name; // Полный путь к файлу

            move_uploaded_file($tmp_image, $file_path);

            // Проверяем наличие обязательных полей
            if (!isset($data['id_post']) || !isset($data['id_unit']) || !isset($data['id_composition'])) {
                // Возвращаем ошибку или выполняем необходимые действия
                return 'Необходимые поля не заполнены';
            }

            // Создаем массив данных для сохранения
            $employeeData = [
                'id_post' => $data['id_post'],
                'id_unit' => $data['id_unit'],
                'id_composition' => $data['id_composition'],
                'surname' => $data['surname'],
                'name' => $data['name'],
                'patronymic' => $data['patronymic'],
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'address' => $data['address'],
                'img' => $file_path // Используем полный путь к файлу
            ];

            // Сохраняем данные в БД
            Employee::create($employeeData);

            app()->route->redirect('/');
        } else {
            $posts = Post::all();
            $units = Unit::all();
            $compositions = Composition::all();

            return new View('site.employee', ['title' => 'Новый сотрудник', 'genders' => $genders, 'posts' => $posts, 'units' => $units, 'compositions' => $compositions]);
        }
    }
    public function composition(Request $request): string
    {
        if ($request->method === 'POST' && Composition::create($request->all())) {
            app()->route->redirect('/composition');
        }

        $compositions = Composition::all();

        return new View('site.composition' , ['title' => 'Состав', 'compositions' => $compositions]);
    }
    public function unit(Request $request): string
    {
        if ($request->method === 'POST' && Unit::create($request->all())) {
            app()->route->redirect('/unit');
        }

        $views = \Model\View::all();

        return new View('site.unit' , ['title' => 'Подразделение', 'views' => $views]);
    }

    public function view(Request $request): string
    {
        if ($request->method === 'POST' && \Model\View::create($request->all())) {
            app()->route->redirect('/view');
        }
        return new View('site.view' , ['title' => 'Вид подразделения']);
    }

    public function search(Request $request)
    {
        $cooperator = Employee::all();

        if ($request->method === 'GET') {
            $var = $request->all();
            if (isset($var['query']) && !empty($var['query'])) {
                $employeeID = $var['query'];
                $filtereEmployee = Employee::whereRaw("LOWER(surname) LIKE ?", ["%{$employeeID}%"])->get();
                return new View('site.search', ['filteredEmployers' => $filtereEmployee]);
            }
        }
        return new View('site.search', ['cooperator' => $cooperator]);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/login');
    }
}
