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
use Carbon\Carbon;
use middlewares;
class Site
{
    public function index(Request $request): string
    {
        $employees = Employee::all(); // Получаем всех пользователей
        $posts = Post::all();
        $compositions = Composition::all();

        // Проверяем, было ли отправлено значение подразделения
        if (!empty($_POST['check_unit'])) {
            $selectedUnit = $_POST['check_unit'];

            $employees = Employee::where('id_unit', $selectedUnit)->get();
        }

        if (!empty($_POST['check_unit']) && is_array($_POST['check_unit'])) {
            $selectedUnits = $_POST['check_unit'];

            $employees = Employee::whereIn('id_unit', $selectedUnits)->get();

            // Расчет среднего возраста
            $totalAge = 0;
            $count = 0;

            foreach ($employees as $employee) {
                $dob = Carbon::parse($employee->dob);
                $totalAge += $dob->age;
                $count++;
            }

            $averageAge = 'Средний возраст: ' . ($count > 0 ? $totalAge / $count : 0);
        } else {
            $averageAge = ''; // Сбросить средний возраст, если подразделения не выбраны
        }

        if (!empty($_POST['id_composition'])) {
            $selectedComposition = $_POST['id_composition'];
            $employees = Employee::whereIn('id_composition', $selectedComposition)->get();
        }

        $units = Unit::all();

        return new View('site.index', ['employees' => $employees, 'posts' => $posts, 'units' => $units, 'compositions' => $compositions, 'selectedUnit' => $selectedUnit, 'selectedUnits' => $selectedUnits, 'averageAge' => $averageAge, 'title' => 'Главная']);
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

            $employees = $request->all();

            $employees['check_unit'] = isset($_POST['check_unit']) ? 1 : 0;

            if ($_FILES['img']) {
                $img = $_FILES['img'];
                $root = app()->settings->getRootPath();
                $path_img = $_SERVER['DOCUMENT_ROOT'] . $root . '/public/images/';
                $name_img = $img['name'];

                // Переместим загруженный файл в папку с изображениями
                move_uploaded_file($img['tmp_name'], $path_img . $name_img);

                $employees['img'] = $name_img;

                if (Employee::create($employees)) {
                    app()->route->redirect('/');
                }
            } else {
                // Обработка ошибки загрузки файла
                echo "Ошибка при загрузке файла";
            }

        }

        $posts = Post::all();
        $units = Unit::all();
        $compositions = Composition::all();

        return new View('site.employee', ['title' => 'Новый сотрудник', 'genders' => $genders, 'posts' => $posts, 'units' => $units, 'compositions' => $compositions]);
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

    public function search(Request $request): string
    {
        $query = $_GET['query'];

        $parts = explode(' ', $query);
        $surname = $parts[0] ?? ''; // Фамилия
        $name = $parts[1] ?? ''; // Имя
        $patronymic = $parts[2] ?? ''; // Отчество

        $filteredEmployees = Employee::where(function($query) use ($surname, $name, $patronymic) {
            $query->where('surname', 'like', '%'.$surname.'%')
                ->where('name', 'like', '%'.$name.'%')
                ->where('patronymic', 'like', '%'.$patronymic.'%');
        })->get(); // Фильтрация сотрудников по ФИО

        return new View('site.search', ['filteredEmployees' => $filteredEmployees]);
    }
    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/login');
    }
}
