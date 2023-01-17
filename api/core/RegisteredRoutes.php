<?php



namespace api\core;

use api\controllers\AddProductController;
use api\controllers\DeleteProductController;
use api\controllers\HomeController;

class RegisteredRoutes {
    private static array $REGISTERED_ROUTES = [
        "/" => ["home", "GET"],
        "/add-product" => ["add_product", "POST"],
        "/delete-product" => ["delete_product", "DELETE"],
    ];

    public static function is_allowed_URI(string $uri) : bool {
        return array_key_exists($uri, self::$REGISTERED_ROUTES);
    }

    public static function call_starter_function (array $request) : array {
        self::request_method_validator($request["method"], $request["URI"]);
        $starter = self::$REGISTERED_ROUTES[$request["URI"]][0];
        return self::$starter($request);
    }

    private static function home(array $request) : array{
        $home_controller = new HomeController($request);

        return $home_controller->get_data();
    }

    private static function add_product(array $request) : array{
        $controller = new AddProductController($request["data"]["formData"]);

        return $controller->save_data();
    }

    private static function delete_product ($request) : array {
        $controller = new DeleteProductController($request["data"]);

        return $controller->delete_products();
    }

    private static function request_method_validator ( string $request_method, string $request_uri) : void {
        if($request_method != self::$REGISTERED_ROUTES[$request_uri][1]){
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode(["message" => "405 Method Not Allowed"]);
            exit;
        }
    }
}