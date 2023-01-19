<?php



namespace api\core;

use api\controllers\AddProductController;
use api\controllers\DeleteProductController;
use api\controllers\HomeController;
use api\controllers\ProductController;

class RegisteredRoutes {
    private static array $REGISTERED_ROUTES = [
        "/product" => ["get_product", "GET"],
        "/product/add" => ["add_product", "POST"],
        "/product/delete" => ["delete_product", "DELETE"],
    ];

    public static function is_allowed_URI(string $uri) : bool {
        return array_key_exists($uri, self::$REGISTERED_ROUTES);
    }

    public static function call_starter_function (array $request) {
        self::request_method_validator($request["method"], $request["URI"]);
        $starter = self::$REGISTERED_ROUTES[$request["URI"]][0];
        return self::$starter($request);
    }

    private static function get_product(array $request) : array {
        $product_controller = new ProductController($request);

        return $product_controller->get_data();
    }

    private static function add_product(array $request) : array {
        $product_controller = new ProductController($request);
        $product_controller->save_data();

        return ["message" => "products are deleted"];
    }

    private static function delete_product ($request) : array {
        $product_controller = new ProductController($request);
        $product_controller->delete_data();
        return ["message" => "products are deleted"];
    }

    private static function request_method_validator ( string $request_method, string $request_uri) {
        if($request_method != self::$REGISTERED_ROUTES[$request_uri][1]){
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode(["message" => "405 Method Not Allowed"]);
            exit;
        }
    }
}