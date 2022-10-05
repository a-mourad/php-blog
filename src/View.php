<?php
declare(strict_types=1);
namespace MouradA\Blog;


class View{


    public function h($data) {
        return htmlspecialchars((string) $data, ENT_QUOTES, 'UTF-8');
    }


    public function render(string $viewName, array $data=[]) {
        extract($data);

        ob_start();
        include( __DIR__ . DIRECTORY_SEPARATOR .'Views'. DIRECTORY_SEPARATOR . $viewName. '.php');
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}

?>