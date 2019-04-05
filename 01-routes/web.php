<?php
// routes/web.php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 1)
Route::get('/', function () { // Podemos criar essa função anônima fora do parametro e apenas chamá-la nele se quisermos
    return view('welcome'); // return "Hello World";
});

Route::get('/ola', function () {
    return "Seja bem vindo!";
});

/* 2) Passando parâmetros para as rotas */

        // indicamos o parâmetro, recebemos ele na function
Route::get('/nome/{nome}', function($nome){
    return "Olá $nome !";
});

                        // Os parâmetros sempre virão como strings
Route::get('/repetir/{nome}/{n}', function($nome, $n){

    for($i=0;$i<=$n;$i++){
        echo "Olá $nome !"."<br/>";
    }

    // O get retorna um objeto que contém o método where(), o qual podemos definir regras para a rota.
    // Podemos fazer um encadeamento de where()
})->where('n', '[0-9]+')->where('nome', '[a-z]+');


/* Inserindo parâmetros opcionais com '?' */
Route::get('/opcional/{nome?}', function($nome = null){
    return "Nome opcional: $nome";
});

/* 3) Agrupamento de rotas */
Route::prefix('app')->group(function(){

    // http://localhost:8000/app/
    Route::get("/", function(){
        return "Página principal do APP";
    });

    // http://localhost:8000/app/profile
    Route::get("profile", function(){
        return "Página Profile";
    });

    // http://localhost:8000/app/about
    Route::get("about", function(){
        return "Página About";
    });
});

/* 4) Redirecionamento entre rotas */
// Redirecionar para a rota /ola, 301 = código http que indica ao browser que a rota /aqui foi permanentemente movida para o /ola
Route::redirect('/aqui', '/ola', 301);

/* 5) Redirecionando para uma view com parâmetros */
Route::view('/hello', 'hello', ['nome' => 'Gandalf']);


Route::get('/hello/{nome}', function($nome){
    return view('hello', ['nome' => $nome]);
});

/* 6) Nomeando rotas */

Route::get('/produtos', function(){
    echo "Listagem de produtos";

})->name('products');

Route::get('/linkprodutos', function(){
    $url = route('products');
    echo "<a href=\"". $url . "\"> Meus produtos</a>";
});

Route::get('/redirecionarprodutos', function(){
    return redirect()->route('products');
});