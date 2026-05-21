<?php
 namespace Router;

 use App\App;

   class Router
   {

      private static string $route_name = "";
      private static string $uri = '';
      private static $instance ;

      public function __construct()
      {
         self::$uri = $_ENV['APP_URL'] ?? '';
      }

      public static function Instance():self
      {
         if(self::$instance == null)
         {
            self::$instance = new Router();
         }
         return self::$instance;
        
      }

      public static function name(string $name)
      {
        self::$route_name = $name;
      }

      public static function route(string $route)
      {
          return self::$uri . $route ;
      }
       public static function get(string $route,mixed $target)
       {
          App::getInstanceRouter()->map('GET',$route,$target,self::$route_name);
       }

       public static function post(string $route, mixed $target)
       {
        App::getInstanceRouter()->map('POST',$route,$target,self::$route_name);
       }

       public static function delete(string $route, mixed $target, string $name = '')
       {
        App::getInstanceRouter()->map('DELETE',$route,$target,self::$route_name);
       }

       public static function put(string $route,mixed $target)
       {
        App::getInstanceRouter()->map('PUT',$route,$target,self::$route_name);
       }
       
       public static function origin($path)
       {
        App::getInstanceRouter()->setBasePath($path);
       }

       public static function matcher()
       {
          $match =App::getInstanceRouter()->match();
   
          if($match && is_callable($match['target']))
            {
            call_user_func($match['target'],$match['params']);
          }

          elseif(is_array($match) && is_array($match['target']))
          {
            $controller = $match['target'][0];
            $method = $match['target'][1];
            $controller = new $controller();
            $controller->$method($match['params']);
          }

          else
          {
             self::respondNotFound();
          }
       }

       private static function respondNotFound()
       {
           http_response_code(404);
           echo json_encode([
               'status' => 404,
               'message' => 'Route introuvable'
           ]);
       }

   }
?>