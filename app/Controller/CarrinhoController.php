<?php
namespace App\Controller;

use App\Core\Controller;
use App\Model\Carrinho;

class CarrinhoController extends Controller
{
    public function index()
    {
        // Futuramente: 
        // $carrinhoModel = new Carrinho();
        // $itens = $carrinhoModel->getItensUsuario($_SESSION['usuario_id']);
        
        require __DIR__ . '/../View/Carrinho/index.php';
    }
}