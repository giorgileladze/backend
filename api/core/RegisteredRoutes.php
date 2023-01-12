<?php



namespace api\core;

use api\controllers\AddProductController;
use api\controllers\DeleteProductController;
use api\controllers\HomeController;

class RegisteredRoutes {
    private static array $REGISTERED_ROUTES = [
        "/" => "home",
        "/add-product" => "add_product",
        "/delete-product" => "delete_product",
    ];

    public static function is_allowed_URI(string $uri) : bool {
        return array_key_exists($uri, self::$REGISTERED_ROUTES);
    }

    public static function call_starter_function (array $request) : array {
        $starter = self::$REGISTERED_ROUTES[$request["URI"]];
        return self::$starter($request);
    }

    private static function home(array $request) : array{
        self::request_method_validator($request["method"], "GET");

        $home_controller = new HomeController($request);

        return $home_controller->get_data();
    }

    private static function add_product(array $request) : array{
        self::request_method_validator($request["method"], "POST");
        $controller = new AddProductController($request["data"]["formData"]);

        return $controller->save_data();
    }

    private static function delete_product ($request) : array {
        self::request_method_validator($request["method"], "DELETE");
        $controller = new DeleteProductController($request["data"]);

        return $controller->delete_products();
    }

    private static function request_method_validator ( string $request_method, string $allowed_method) : void {
        if($request_method != $allowed_method){
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode(["message" => "405 Method Not Allowed"]);
            exit;
        }
    }
}